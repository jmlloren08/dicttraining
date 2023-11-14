<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Office extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true,
                'null' => false
            ],
            'office_name' =>[
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'office_code' =>[
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false
            ],
            'office_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'created_at' =>[
                'type' => 'DATETIME',
                'null' => false
            ],
            'updated_at' =>[
                'type' => 'DATETIME',
                'null' => false
            ]
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('offices');
    }

    public function down()
    {
        $this->forge->dropTable('offices');
    }
}
