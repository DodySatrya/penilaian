<?php

use function PHPUnit\Framework\isEmpty;

    $jurusan = new \App\Models\JurusanModel();
    $kelas = new \App\Models\KelasModel();
    $nilai = new \App\Models\NilaiModel();
    
    function getGroupByUserId($id) {
        $user = new \App\Models\UserModel();
        $user = $user->where('id', $id)->first();
        d($user);
    }

    function getNisByNama($nama)
    {
        $siswa = new \App\Models\SiswaModel();
        
        $data = $siswa->where(['nama' => $nama])->find();
        return $data;
    }
    
    function getKkmByMapel($nama) {
        $mapel = new \App\Models\MapelModel();

        $data = $mapel->where(['nama' => $nama])->first();
        return $data;
    }

    function getKkmSetting($nama) {
        $mapel = new \App\Models\MapelModel();

        $data = $mapel->where(['nama' => $nama])->first();
        return $data;
    }

    function generateGrade($nilai, $m) {
        $mapel = new \App\Models\MapelModel();
        $siswa = new \App\Models\SiswaModel();
        
        
        $getKKM = $mapel->where(['nama' => $m])->find();
        if($getKKM == null || count($getKKM) == 0) {
            $kkm = 0;
        } else {
            $kkm = $getKKM[0]->kkm;
        }
        
        // generate grade by nilai dari kkm
        if($nilai < 60) {
            $grade = 'D';
        } else if($nilai <= 69) {
            $grade = 'C';
        } else if($nilai <= 74) {
            $grade = 'C-';
        } else if($nilai <= 79) {
            $grade = 'C+';
        } else if($nilai <= 81) {
            $grade = 'B';
        } else if($nilai <= 85) {
            $grade = 'B+';
        } else if($nilai <= 94) {
            $grade = 'A';
        } else if($nilai <= 100) {
            $grade = 'A+';
        } else {
            $grade = 'undefined';
        }

        return $grade;
    }
