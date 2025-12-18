<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProgrammerTaskSeeder extends Seeder
{
    public function run()
    {
        $pData = [
            'email'    => 'programmer@taskit.com',
            'password' => password_hash('password123', PASSWORD_BCRYPT),
            'role_id'  => 4, 
        ];
        $this->db->table('users')->insert($pData);
        
        $pId = $this->db->insertID();

        $this->db->table('user_details')->insert([
            'user_id' => $pId,
            'name'    => 'Budi Programmer',
            'status'  => 'active'
        ]);

        $this->db->table('user_departments')->insert([
            'user_id'       => $pId,
            'department_id' => 4,
            'is_primary'    => true
        ]);

        $taskData = [
            'title'         => 'Optimasi UI Dashboard Minimalis',
            'description'   => 'Selesaikan layout sesuai standar Google/Uber tanpa ikon',
            'creator_id'    => 1, 
            'department_id' => 4,
            'status'        => 'in_progress',
            'priority'      => 'high',
            'deadline'      => '2025-12-25 17:00:00'
        ];
        $this->db->table('tasks')->insert($taskData);
        $taskId = $this->db->insertID();

        $this->db->table('task_users')->insert([
            'task_id' => $taskId,
            'user_id' => $pId,
            'role'    => 'assignee'
        ]);
    }
}