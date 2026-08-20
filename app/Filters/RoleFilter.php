<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userRole = $session->get('user_role');
        if (!empty($arguments) && !in_array($userRole, $arguments, true)) {
            $session->setFlashdata('error', 'Anda tidak memiliki hak akses untuk membuka halaman tersebut.');
            return redirect()->to(base_url('admin/dashboard'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
