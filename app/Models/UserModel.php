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
        'password' => 'required|min_length[8]',
        'role_id'  => 'required|is_not_unique[roles.id]',
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
        if (! isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }

    public function getUserComplete($id)
    {
        return $this->select('users.*, roles.name as role_name, user_details.name, user_details.position, user_details.status') // <-- Tambahkan status di sini
                    ->join('roles', 'roles.id = users.role_id')
                    ->join('user_details', 'user_details.user_id = users.id')
                    ->where('users.id', $id)
                    ->first();
    }
}