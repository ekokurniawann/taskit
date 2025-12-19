<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Database\Config;

class UserController extends BaseController
{
    protected $userModel;
    protected $db;

    public function __construct()
    {
        // Inisialisasi Model dan Database sekali saja
        $this->userModel = new UserModel();
        $this->db = Config::connect();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $users = $this->userModel->getAllUsersComplete($keyword);

        $data = [
            'title'   => 'Manajemen User',
            'users'   => $users,
            'keyword' => $keyword 
        ];
        
        return view('pages/manager/index_user', $data);
    }

    public function register()
    {
        $data = [
            'title'       => 'Tambah Karyawan Baru',
            'roles'       => $this->db->table('roles')->get()->getResultArray(),
            'departments' => $this->db->table('departments')->get()->getResultArray(),
        ];

        return view('pages/manager/register_user', $data);
    }

    public function store() {
        $postData = $this->request->getPost();

        $this->db->transStart();

        // Simpan Akun Login
        $this->userModel->save([
            'email'    => $postData['email'],
            'password' => $postData['password'],
            'role_id'  => $postData['role_id']
        ]);

        $userId = $this->userModel->getInsertID();

        // Simpan Detail Profil (Termasuk Phone)
        $this->db->table('user_details')->insert([
            'user_id'    => $userId,
            'name'       => $postData['name'] ?? 'No Name',
            'phone'      => $postData['phone'] ?? null, 
            'position'   => $postData['position'] ?? '-', 
            'status'     => 'active',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Simpan Penempatan Departemen
        $this->db->table('user_departments')->insert([
            'user_id'       => $userId,
            'department_id' => $postData['department_id'],
            'is_primary'    => 1,
            'assigned_at'   => date('Y-m-d H:i:s')
        ]);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftarkan karyawan.');
        }

        return redirect()->to('/manager/users')->with('success', 'Karyawan ' . $postData['name'] . ' berhasil didaftarkan.');
    }


    public function edit($id)
    {
        $user = $this->userModel->getUserForEdit($id);

        if (!$user) {
            return redirect()->to('/manager/users')->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'title'       => 'Edit Profil Karyawan',
            'user'        => $user,
            'roles'       => $this->db->table('roles')->get()->getResultArray(),
            'departments' => $this->db->table('departments')->get()->getResultArray(),
        ];

        return view('pages/manager/edit_user', $data);
    }

    public function update($id)
    {
        $postData = $this->request->getPost();

        if ($this->userModel->updateCompleteUser($id, $postData)) {
            return redirect()->to('/manager/users')->with('success', 'Data user berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data user.');
    }

    public function delete($id)
    {
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        if ($this->userModel->deleteUser($id)) {
            return redirect()->to('/manager/users')->with('success', 'User berhasil dihapus dari sistem.');
        }

        return redirect()->back()->with('error', 'Gagal menghapus user.');
    }
}