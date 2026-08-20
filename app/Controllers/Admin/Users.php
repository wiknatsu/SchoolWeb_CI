<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();

        $data = [
            'title'   => 'Manajemen Pengguna & Hak Akses',
            'profile' => $this->schoolProfile,
            'users'   => $users,
        ];

        return view('admin/users/index', $data);
    }

    public function create()
    {
        $data = [
            'title'   => 'Tambah Pengguna Baru',
            'profile' => $this->schoolProfile,
        ];

        return view('admin/users/create', $data);
    }

    public function store()
    {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'full_name' => 'required|min_length[3]|max_length[150]',
            'role'      => 'required|in_list[superadmin,admin,editor]',
            'password'  => 'required|min_length[6]',
            'avatar'    => 'permit_empty|is_image[avatar]|max_size[avatar,2048]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $avatarName = null;
        $avatarFile = $this->request->getFile('avatar');
        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            $avatarName = $avatarFile->getRandomName();
            $avatarFile->move(FCPATH . 'uploads/users', $avatarName);
        }

        $this->userModel->insert([
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'full_name'     => $this->request->getPost('full_name'),
            'role'          => $this->request->getPost('role'),
            'avatar'        => $avatarName,
            'is_active'     => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/pengguna'))->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Pengguna: ' . esc($user['full_name']),
            'profile' => $this->schoolProfile,
            'user'    => $user,
        ];

        return view('admin/users/edit', $data);
    }

    public function update($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $rules = [
            'username'  => "required|min_length[3]|max_length[100]|is_unique[users.username,id,{$id}]",
            'email'     => "required|valid_email|is_unique[users.email,id,{$id}]",
            'full_name' => 'required|min_length[3]|max_length[150]',
            'role'      => 'required|in_list[superadmin,admin,editor]',
            'password'  => 'permit_empty|min_length[6]',
            'avatar'    => 'permit_empty|is_image[avatar]|max_size[avatar,2048]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $avatarName = $user['avatar'];
        $avatarFile = $this->request->getFile('avatar');
        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            if (!empty($avatarName) && file_exists(FCPATH . 'uploads/users/' . $avatarName)) {
                @unlink(FCPATH . 'uploads/users/' . $avatarName);
            }
            $avatarName = $avatarFile->getRandomName();
            $avatarFile->move(FCPATH . 'uploads/users', $avatarName);
        }

        $updateData = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'role'      => $this->request->getPost('role'),
            'avatar'    => $avatarName,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $updateData['password_hash'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to(base_url('admin/pengguna'))->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Pengguna tidak ditemukan.');
        }

        if ($user['id'] == session('user_id')) {
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $this->userModel->delete($id);
        return redirect()->to(base_url('admin/pengguna'))->with('success', 'Pengguna berhasil dihapus.');
    }
}
