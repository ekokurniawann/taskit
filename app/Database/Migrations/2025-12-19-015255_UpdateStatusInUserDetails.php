<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateStatusInUserDetails extends Migration
{
    public function up()
    {
        $fields = [
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'resigned'],
                'default'    => 'active',
            ],
        ];
        $this->forge->modifyColumn('user_details', $fields);
    }

    public function down()
    {
        $fields = [ 
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'resigned'],
                'default'    => 'active',
            ],
        ];
        $this->forge->modifyColumn('user_details', $fields);
    }
}