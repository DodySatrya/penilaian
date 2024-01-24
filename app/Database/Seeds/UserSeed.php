<?php

namespace App\Database\Seeds;

use App\Entities\User;
use CodeIgniter\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        // ROle
        $user = new \App\Models\UserModel();
        $auth_groups = [
            [
                "id"          => 1,
                "name"        => 'admin',
                "description" => 'site administration'
            ],
            [
                "id"          => 2,
                "name"        => 'wali_kelas',
                "description" => 'Walikelas'
            ],
        ];
        $this->db->table('auth_groups')->insertBatch($auth_groups);

        // User Default
        $user->withGroup('admin')->save(new User([
            "email" => "admin@exaple.com",
            "username" => "Admin",
            "nama" => "Nama Admin",
            "password" => "admin",
            "active" => 1,
        ]));

        // Jurusan
        $jurusan = new \App\Models\JurusanModel();
        $jurusan->insertBatch([
            [
                "nama" => "TKJ",
                "keterangan" => "Jurusan Teknik Komputer Dan Jaringan",
            ],
            [
                "nama" => "TKR",
                "keterangan" => "Jurusan Teknik Kendaraan Ringan",
            ],
            [
                "nama" => "AKUNTANSI",
                "keterangan" => "Jurusan AKUNTANSI",
            ],
        ]);

        // Kategori Penilaian
        $kategori = new \App\Models\KategoriModel();
        $kategori->insertBatch([
            [
                'kategori' => 'AKADEMIK',
            ],
            [
                'kategori' => 'NON AKADEMIK',
            ],
            [
                'kategori' => 'EKSTRA KURIKULER',
            ],
            [
                'kategori' => 'KEHADIRAN',
            ],
        ]);
    }
}
