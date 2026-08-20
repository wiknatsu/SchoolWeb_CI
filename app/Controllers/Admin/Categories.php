<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsCategoryModel;
use App\Models\NewsModel;

class Categories extends BaseController
{
    protected $categoryModel;
    protected $newsModel;

    public function __construct()
    {
        $this->categoryModel = new NewsCategoryModel();
        $this->newsModel     = new NewsModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->findAll();

        // Calculate count of news in each category
        foreach ($categories as &$cat) {
            $cat['news_count'] = $this->newsModel->where('category_id', $cat['id'])->countAllResults();
        }

        $data = [
            'title'      => 'Kategori Berita',
            'profile'    => $this->schoolProfile,
            'categories' => $categories,
        ];

        return view('admin/categories/index', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'icon' => 'permit_empty|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');
        $slug = url_title($name, '-', true);

        // Check uniqueness
        $count = $this->categoryModel->where('slug', $slug)->countAllResults();
        if ($count > 0) {
            $slug .= '-' . time();
        }

        $this->categoryModel->insert([
            'name'        => $name,
            'slug'        => $slug,
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon') ?: 'fas fa-tag',
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/kategori'))->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function update($id = null)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to(base_url('admin/kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'icon' => 'permit_empty|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');
        $slug = $this->request->getPost('slug') ? url_title($this->request->getPost('slug'), '-', true) : url_title($name, '-', true);

        $count = $this->categoryModel->where('slug', $slug)->where('id !=', $id)->countAllResults();
        if ($count > 0) {
            $slug .= '-' . time();
        }

        $this->categoryModel->update($id, [
            'name'        => $name,
            'slug'        => $slug,
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon') ?: 'fas fa-tag',
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/kategori'))->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to(base_url('admin/kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        // Set null for news with this category
        $this->newsModel->where('category_id', $id)->set(['category_id' => null])->update();

        $this->categoryModel->delete($id);
        return redirect()->to(base_url('admin/kategori'))->with('success', 'Kategori berhasil dihapus.');
    }
}
