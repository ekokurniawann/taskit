<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $userRole = session()->get('role_name');

        if (empty($arguments)) {
            return;
        }

        if (!in_array($userRole, $arguments)) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak diizinkan mengakses halaman tersebut.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}