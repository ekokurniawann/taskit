<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed Roles
        $rolesData = [
            ['name' => 'Manager', 'description' => 'Akses penuh ke semua departemen'],
            ['name' => 'Supervisor', 'description' => 'Mengawasi satu departemen spesifik'],
            ['name' => 'Leader', 'description' => 'Memimpin grup programmer'],
            ['name' => 'Programmer', 'description' => 'Eksekutor task'],
        ];
        $this->db->table('roles')->insertBatch($rolesData);

        // 2. Seed Departments
        $deptsData = [
            ['name' => 'Warehouse', 'description' => 'Gudang'],
            ['name' => 'Purchasing', 'description' => 'Pembelian'],
            ['name' => 'Produksi', 'description' => 'Lini Produksi'],
            ['name' => 'IT System', 'description' => 'Pusat Pengembangan'],
        ];
        $this->db->table('departments')->insertBatch($deptsData);

        // 3. Seed User Admin/Manager (untuk Login)
        $userData = [
            'email'      => 'manager@taskit.com',
            'password'   => password_hash('password123', PASSWORD_BCRYPT),
            'role_id'    => 1, // Manager
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('users')->insert($userData);
        $userId = $this->db->insertID();

        // 4. Seed User Details
        $this->db->table('user_details')->insert([
            'user_id'    => $userId,
            'name'       => 'Eko Manager',
            'phone'      => '08123456789',
            'status'     => 'active',
            'position'   => 'Senior Manager',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // 5. Assign Manager ke IT System
        $this->db->table('user_departments')->insert([
            'user_id'       => $userId,
            'department_id' => 4, // IT System
            'is_primary'    => true,
            'assigned_at'   => date('Y-m-d H:i:s'),
        ]);
    }
}