<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PageModel;

class Pages extends BaseController
{
    protected $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    public function index()
    {
        $pages = $this->pageModel->orderBy('display_order', 'ASC')->findAll();

        $data = [
            'title'   => 'Manajemen Halaman Statis',
            'profile' => $this->schoolProfile,
            'pages'   => $pages,
        ];

        return view('admin/pages/index', $data);
    }

    public function create()
    {
        $data = [
            'title'   => 'Tambah Halaman Baru',
            'profile' => $this->schoolProfile,
        ];

        return view('admin/pages/create', $data);
    }

    public function store()
    {
        $rules = [
            'title'    => 'required|min_length[3]|max_length[255]',
            'content'  => 'required',
            'template' => 'required|in_list[default,about,facilities,achievements]',
            'image'    => 'permit_empty|is_image[image]|max_size[image,3072]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        $count = $this->pageModel->where('slug', $slug)->countAllResults();
        if ($count > 0) {
            $slug .= '-' . time();
        }

        $imageName = null;
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/profiles', $imageName);
        }

        $this->pageModel->insert([
            'title'            => $title,
            'slug'             => $slug,
            'content'          => $this->request->getPost('content'),
            'template'         => $this->request->getPost('template'),
            'featured_image'   => $imageName,
            'display_order'    => (int) $this->request->getPost('display_order'),
            'is_active'        => $this->request->getPost('is_active') ? 1 : 0,
            'meta_keywords'    => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description'),
        ]);

        return redirect()->to(base_url('admin/halaman'))->with('success', 'Halaman baru berhasil disimpan.');
    }

    public function edit($id = null)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            return redirect()->to(base_url('admin/halaman'))->with('error', 'Halaman tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Halaman: ' . esc($page['title']),
            'profile' => $this->schoolProfile,
            'page'    => $page,
        ];

        return view('admin/pages/edit', $data);
    }

    public function update($id = null)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            return redirect()->to(base_url('admin/halaman'))->with('error', 'Halaman tidak ditemukan.');
        }

        $rules = [
            'title'    => 'required|min_length[3]|max_length[255]',
            'content'  => 'required',
            'template' => 'required|in_list[default,about,facilities,achievements]',
            'image'    => 'permit_empty|is_image[image]|max_size[image,3072]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title');
        $slug = $this->request->getPost('slug') ? url_title($this->request->getPost('slug'), '-', true) : url_title($title, '-', true);

        $count = $this->pageModel->where('slug', $slug)->where('id !=', $id)->countAllResults();
        if ($count > 0) {
            $slug .= '-' . time();
        }

        $imageName = $page['featured_image'];
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            if (!empty($imageName) && file_exists(FCPATH . 'uploads/profiles/' . $imageName)) {
                @unlink(FCPATH . 'uploads/profiles/' . $imageName);
            }
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/profiles', $imageName);
        }

        $this->pageModel->update($id, [
            'title'            => $title,
            'slug'             => $slug,
            'content'          => $this->request->getPost('content'),
            'template'         => $this->request->getPost('template'),
            'featured_image'   => $imageName,
            'display_order'    => (int) $this->request->getPost('display_order'),
            'is_active'        => $this->request->getPost('is_active') ? 1 : 0,
            'meta_keywords'    => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description'),
        ]);

        return redirect()->to(base_url('admin/halaman'))->with('success', 'Halaman berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $page = $this->pageModel->find($id);
        if (!$page) {
            return redirect()->to(base_url('admin/halaman'))->with('error', 'Halaman tidak ditemukan.');
        }

        $this->pageModel->delete($id);
        return redirect()->to(base_url('admin/halaman'))->with('success', 'Halaman berhasil dihapus.');
    }
}
