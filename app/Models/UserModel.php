<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; 
    
    protected $allowedFields    = ['email', 'password', 'role_id'];

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules      = [
        'email'    => 'required|valid_email|is_unique[users.email,id,{id}]',
        'role_id'  => 'required',
    ];

    protected $validationMessages   = [
        'email' => [
            'is_unique' => 'Email ini sudah terdaftar dalam sistem.',
        ],
    ];


    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password']) || empty($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }


    public function getUserComplete($id)
    {
        return $this->select('users.*, roles.name as role_name, user_details.name, user_details.position, user_details.status, user_details.phone')
                    ->join('roles', 'roles.id = users.role_id')
                    ->join('user_details', 'user_details.user_id = users.id')
                    ->where('users.id', $id)
                    ->first();
    }


    // public function getAllUsersComplete()
    // {
    //     return $this->select('users.id, users.email, roles.name as role_name, user_details.name, user_details.position, user_details.status, user_details.phone, departments.name as dept_name')
    //                 ->join('roles', 'roles.id = users.role_id')
    //                 ->join('user_details', 'user_details.user_id = users.id')
    //                 ->join('user_departments', 'user_departments.user_id = users.id', 'left')
    //                 ->join('departments', 'departments.id = user_departments.department_id', 'left')
    //                 ->findAll();
    // }

    public function getAllUsersComplete($keyword = null)
    {
        $builder = $this->select('users.id, users.email, roles.name as role_name, user_details.name, user_details.position, user_details.status, departments.name as dept_name')
                        ->join('roles', 'roles.id = users.role_id')
                        ->join('user_details', 'user_details.user_id = users.id')
                        ->join('user_departments', 'user_departments.user_id = users.id', 'left')
                        ->join('departments', 'departments.id = user_departments.department_id', 'left');

        if ($keyword) {
            $builder->groupStart()
                    ->like('user_details.name', $keyword)
                    ->orLike('users.email', $keyword)
                    ->orLike('user_details.position', $keyword)
                    ->orLike('departments.name', $keyword)
                    ->groupEnd();
        }

        return $builder->findAll();
    }


    public function getUserForEdit($id)
    {
        return $this->select('users.id, users.email, users.role_id, user_details.name, user_details.position, user_details.status, user_details.phone, user_departments.department_id')
                    ->join('user_details', 'user_details.user_id = users.id')
                    ->join('user_departments', 'user_departments.user_id = users.id', 'left')
                    ->where('users.id', $id)
                    ->first();
    }


    public function updateCompleteUser($id, $data)
    {
        $db = \Config\Database::connect();
        $db->transStart(); 

        // Update Tabel 'users' 
        $userData = array_filter([
            'email'    => $data['email'] ?? null,
            'role_id'  => $data['role_id'] ?? null,
            'password' => (!empty($data['password'])) ? $data['password'] : null,
        ]);
        
        if (!empty($userData)) {
            $this->update($id, $userData);
        }

        // Update Tabel 'user_details' 
        $detailData = array_filter([
            'name'     => $data['name'] ?? null,
            'phone'    => $data['phone'] ?? null,    
            'position' => $data['position'] ?? null,
            'status'   => $data['status'] ?? null,
        ]);

        if (!empty($detailData)) {
            $db->table('user_details')->where('user_id', $id)->update($detailData);
        }

        // Update Tabel 'user_departments' (Departemen)
        if (isset($data['department_id'])) {
            $db->table('user_departments')
               ->where('user_id', $id)
               ->update(['department_id' => $data['department_id']]);
        }

        $db->transComplete(); 
        return $db->transStatus();
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
}