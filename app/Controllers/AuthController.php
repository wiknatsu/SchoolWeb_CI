<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->session->get('is_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        $data = [
            'title'   => 'Login Administrator - ' . ($this->schoolProfile['school_name'] ?? 'Portal Sekolah'),
            'profile' => $this->schoolProfile,
        ];

        return view('auth/login', $data);
    }

    public function attemptLogin()
    {
        $rules = [
            'login'    => 'required|min_length[3]',
            'password' => 'required|min_length[5]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        // Check by username or email
        $user = $this->userModel->where('username', $login)
            ->orWhere('email', $login)
            ->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Username/Email atau Password salah.');
        }

        if ((int) $user['is_active'] !== 1) {
            return redirect()->back()->withInput()->with('error', 'Akun Anda sedang dinonaktifkan. Silakan hubungi Administrator.');
        }

        if (!password_verify($password, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Username/Email atau Password salah.');
        }

        // Set session
        $sessionData = [
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'full_name'    => $user['full_name'],
            'user_email'   => $user['email'],
            'user_role'    => $user['role'],
            'user_avatar'  => $user['avatar'],
            'is_logged_in' => true,
        ];
        $this->session->set($sessionData);

        return redirect()->to(base_url('admin/dashboard'))->with('success', 'Selamat datang kembali, ' . esc($user['full_name']) . '!');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
