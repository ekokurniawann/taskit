<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasks extends Migration
{
    public function up() {
        $this->forge->addField([
            'id'                     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'                  => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'            => ['type' => 'TEXT', 'null' => true],
            'creator_id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'department_id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'original_department_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'status'                 => ['type' => 'ENUM', 'constraint' => ['pending', 'in_progress', 'done'], 'default' => 'pending'],
            'priority'               => ['type' => 'ENUM', 'constraint' => ['low', 'medium', 'high'], 'default' => 'medium'],
            'deadline'               => ['type' => 'DATETIME', 'null' => true],
            'created_at'             => ['type' => 'DATETIME', 'null' => true],
            'updated_at'             => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('creator_id', 'users', 'id');
        $this->forge->addForeignKey('department_id', 'departments', 'id');
        $this->forge->createTable('tasks');
    }
    public function down() { $this->forge->dropTable('tasks'); }
}
