<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'semester' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            // 'tipe' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 255,
            // ],
            'id_siswa' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nilai' => [
                'type' => 'LONGTEXT',  
            ],
            // 'nilai' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            // ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('nilai', true);
    }

    public function down()
    {
        $this->forge->dropTable('nilai', true);
    }
}
