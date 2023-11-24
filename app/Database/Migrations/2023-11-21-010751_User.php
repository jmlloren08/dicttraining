<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'firstname' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'lastname' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'username' =>[
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
