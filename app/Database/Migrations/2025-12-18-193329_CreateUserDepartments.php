<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserDepartments extends Migration
{
    public function up() {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'department_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'is_primary'    => ['type' => 'BOOLEAN', 'default' => false],
            'assigned_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('department_id', 'departments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_departments');
    }
    public function down() { $this->forge->dropTable('user_departments'); }
}
