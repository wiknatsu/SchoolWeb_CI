<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SchoolAppModel;

class Apps extends BaseController
{
    protected $appModel;

    public function __construct()
    {
        $this->appModel = new SchoolAppModel();
    }

    public function index()
    {
        $apps = $this->appModel->orderBy('display_order', 'ASC')->findAll();

        $data = [
            'title'   => 'Manajemen Link Aplikasi Sekolah',
            'profile' => $this->schoolProfile,
            'apps'    => $apps,
        ];

        return view('admin/apps/index', $data);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[2]|max_length[150]',
            'url'      => 'required|valid_url',
            'category' => 'required|in_list[academic,finance,library,exam,alumni,etc]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $icon = $this->request->getPost('icon') ?: 'fas fa-external-link-alt';

        $this->appModel->insert([
            'name'          => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
            'icon'          => $icon,
            'url'           => $this->request->getPost('url'),
            'category'      => $this->request->getPost('category'),
            'display_order' => (int) $this->request->getPost('display_order'),
            'is_active'     => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/aplikasi'))->with('success', 'Link aplikasi sekolah berhasil ditambahkan.');
    }

    public function update($id = null)
    {
        $app = $this->appModel->find($id);
        if (!$app) {
            return redirect()->to(base_url('admin/aplikasi'))->with('error', 'Aplikasi tidak ditemukan.');
        }

        $rules = [
            'name'     => 'required|min_length[2]|max_length[150]',
            'url'      => 'required|valid_url',
            'category' => 'required|in_list[academic,finance,library,exam,alumni,etc]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->appModel->update($id, [
            'name'          => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
            'icon'          => $this->request->getPost('icon') ?: 'fas fa-external-link-alt',
            'url'           => $this->request->getPost('url'),
            'category'      => $this->request->getPost('category'),
            'display_order' => (int) $this->request->getPost('display_order'),
            'is_active'     => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/aplikasi'))->with('success', 'Link aplikasi berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $app = $this->appModel->find($id);
        if (!$app) {
            return redirect()->to(base_url('admin/aplikasi'))->with('error', 'Aplikasi tidak ditemukan.');
        }

        $this->appModel->delete($id);
        return redirect()->to(base_url('admin/aplikasi'))->with('success', 'Link aplikasi berhasil dihapus.');
    }
}
