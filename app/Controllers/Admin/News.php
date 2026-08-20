<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use App\Models\NewsCategoryModel;
use CodeIgniter\I18n\Time;

class News extends BaseController
{
    protected $newsModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->newsModel     = new NewsModel();
        $this->categoryModel = new NewsCategoryModel();
    }

    public function index()
    {
        $newsList = $this->newsModel->select('news.*, news_categories.name as category_name, users.full_name as author_name')
            ->join('news_categories', 'news_categories.id = news.category_id', 'left')
            ->join('users', 'users.id = news.author_id', 'left')
            ->orderBy('news.created_at', 'DESC')
            ->findAll();

        $data = [
            'title'      => 'Manajemen Berita & Artikel',
            'profile'    => $this->schoolProfile,
            'newsList'   => $newsList,
            'categories' => $this->categoryModel->findAll(),
        ];

        return view('admin/news/index', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tambah Berita Baru',
            'profile'    => $this->schoolProfile,
            'categories' => $this->categoryModel->where('is_active', 1)->findAll(),
        ];

        return view('admin/news/create', $data);
    }

    public function store()
    {
        $rules = [
            'title'       => 'required|min_length[5]|max_length[255]',
            'category_id' => 'required|numeric',
            'content'     => 'required',
            'status'      => 'required|in_list[draft,published,archived]',
            'image'       => 'permit_empty|is_image[image]|max_size[image,3072]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        // Check unique slug
        $count = $this->newsModel->where('slug', $slug)->countAllResults();
        if ($count > 0) {
            $slug .= '-' . time();
        }

        // Handle Image
        $imageName = null;
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/news', $imageName);
        }

        $publishedAt = null;
        if ($this->request->getPost('status') === 'published') {
            $customPubDate = $this->request->getPost('published_at');
            $publishedAt = !empty($customPubDate) ? $customPubDate : Time::now()->toDateTimeString();
        }

        $this->newsModel->insert([
            'title'            => $title,
            'slug'             => $slug,
            'excerpt'          => $this->request->getPost('excerpt') ?: excerpt_words($this->request->getPost('content'), 25),
            'content'          => $this->request->getPost('content'),
            'featured_image'   => $imageName,
            'category_id'      => $this->request->getPost('category_id'),
            'author_id'        => session('user_id'),
            'status'           => $this->request->getPost('status'),
            'published_at'     => $publishedAt,
            'is_highlighted'   => $this->request->getPost('is_highlighted') ? 1 : 0,
            'meta_keywords'    => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description'),
        ]);

        return redirect()->to(base_url('admin/berita'))->with('success', 'Berita baru berhasil disimpan.');
    }

    public function edit($id = null)
    {
        $news = $this->newsModel->find($id);
        if (!$news) {
            return redirect()->to(base_url('admin/berita'))->with('error', 'Berita tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Berita: ' . esc($news['title']),
            'profile'    => $this->schoolProfile,
            'news'       => $news,
            'categories' => $this->categoryModel->where('is_active', 1)->findAll(),
        ];

        return view('admin/news/edit', $data);
    }

    public function update($id = null)
    {
        $news = $this->newsModel->find($id);
        if (!$news) {
            return redirect()->to(base_url('admin/berita'))->with('error', 'Berita tidak ditemukan.');
        }

        $rules = [
            'title'       => 'required|min_length[5]|max_length[255]',
            'category_id' => 'required|numeric',
            'content'     => 'required',
            'status'      => 'required|in_list[draft,published,archived]',
            'image'       => 'permit_empty|is_image[image]|max_size[image,3072]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title');
        $slug = $this->request->getPost('slug') ? url_title($this->request->getPost('slug'), '-', true) : url_title($title, '-', true);

        // Check unique slug excluding this ID
        $count = $this->newsModel->where('slug', $slug)->where('id !=', $id)->countAllResults();
        if ($count > 0) {
            $slug .= '-' . time();
        }

        // Handle Image
        $imageName = $news['featured_image'];
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            // Delete old file if exists locally
            if (!empty($imageName) && file_exists(FCPATH . 'uploads/news/' . $imageName)) {
                @unlink(FCPATH . 'uploads/news/' . $imageName);
            }
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/news', $imageName);
        }

        $publishedAt = $news['published_at'];
        if ($this->request->getPost('status') === 'published' && empty($publishedAt)) {
            $publishedAt = Time::now()->toDateTimeString();
        }

        $this->newsModel->update($id, [
            'title'            => $title,
            'slug'             => $slug,
            'excerpt'          => $this->request->getPost('excerpt') ?: excerpt_words($this->request->getPost('content'), 25),
            'content'          => $this->request->getPost('content'),
            'featured_image'   => $imageName,
            'category_id'      => $this->request->getPost('category_id'),
            'status'           => $this->request->getPost('status'),
            'published_at'     => $this->request->getPost('published_at') ?: $publishedAt,
            'is_highlighted'   => $this->request->getPost('is_highlighted') ? 1 : 0,
            'meta_keywords'    => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description'),
        ]);

        return redirect()->to(base_url('admin/berita'))->with('success', 'Berita berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $news = $this->newsModel->find($id);
        if (!$news) {
            return redirect()->to(base_url('admin/berita'))->with('error', 'Berita tidak ditemukan.');
        }

        $this->newsModel->delete($id);
        return redirect()->to(base_url('admin/berita'))->with('success', 'Berita berhasil dihapus.');
    }

    public function toggleHighlight($id = null)
    {
        $news = $this->newsModel->find($id);
        if ($news) {
            $newStatus = $news['is_highlighted'] == 1 ? 0 : 1;
            $this->newsModel->update($id, ['is_highlighted' => $newStatus]);
            return $this->response->setJSON(['status' => 'success', 'is_highlighted' => $newStatus]);
        }
        return $this->response->setStatusCode(404)->setJSON(['status' => 'error', 'message' => 'Berita tidak ditemukan']);
    }

    /**
     * Summernote Drag & Drop Image Uploader
     */
    public function uploadEditorImage()
    {
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/news', $newName);
            return $this->response->setJSON([
                'url' => base_url('uploads/news/' . $newName),
            ]);
        }
        return $this->response->setStatusCode(400)->setJSON(['error' => 'Gagal mengunggah gambar']);
    }
}
