<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MapelMigrate extends Migration
{
    public function up()
    {
        // mata pelajaran
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tipe' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'has_kkm' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kkm' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mapel', true);
    }

    public function down()
    {
        $this->forge->dropTable('mapel', true);
    }
}
