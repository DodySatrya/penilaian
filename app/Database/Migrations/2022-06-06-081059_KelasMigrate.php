<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelasMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'wali'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'kelas'        => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jurusan'        => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nomor'        => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                "null"       => true,
            ],
            'created_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('kelas', true);
    }

    public function down()
    {
        $this->forge->dropTable('kelas', true);
    }
}
