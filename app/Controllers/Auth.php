<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('pages/auth/login', [
            'title' => 'Masuk'
        ]);
    }

    public function loginProcess()
    {
        $userModel = new UserModel();
        
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                
                $userDetail = $userModel->getUserComplete($user['id']);

                if ($userDetail['status'] !== 'active') {
                    return redirect()->back()->withInput()->with('error', 'Akun Anda sudah tidak aktif.');
                }

                $sessionData = [
                    'user_id'   => $user['id'],
                    'name'      => $userDetail['name'],
                    'role_id'   => $user['role_id'],
                    'role_name' => $userDetail['role_name'],
                    'logged_in' => true,
                ];
                session()->set($sessionData);

                return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $userDetail['name']);
            } else {
                return redirect()->back()->withInput()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email tidak terdaftar.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}