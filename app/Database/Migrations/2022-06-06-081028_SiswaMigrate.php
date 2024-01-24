<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SiswaMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'nis' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'kelas' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'jurusan' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'nama'        => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_lahir' => [
                'type'       => 'DATE',
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'agama'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
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
        $this->forge->createTable('siswa', true);
    }

    public function down()
    {
        $this->forge->dropTable('siswa', true);
    }
}
