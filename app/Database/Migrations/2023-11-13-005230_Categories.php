<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
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
            'cat_severity' =>[
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false
            ],
            'cat_status' =>[
                'type' => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
