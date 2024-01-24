<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class WaliKelas extends BaseController
{
    protected $jurusan;
    protected $kelas;
    protected $siswa;
    protected $mapel;
    protected $nilai;
    protected $kategori;
    protected $user;
    protected $group;

    public function __construct()
    {
        $this->jurusan  = new \App\Models\JurusanModel();
        $this->kelas    = new \App\Models\KelasModel();
        $this->siswa    = new \App\Models\SiswaModel();
        $this->mapel    = new \App\Models\MapelModel();
        $this->nilai    = new \App\Models\NilaiModel();
        $this->kategori = new \App\Models\KategoriModel();
        $this->user     = new \App\Models\UserModel();
        $this->group    = new \Myth\Auth\Authorization\GroupModel();
    }

    public function index()
    {
        $data_kelas = $this->kelas->where('wali', user()->nama)->first();
        
        if ($data_kelas !== null) {
            $kelas = $data_kelas->kelas . " " . $data_kelas->jurusan . " " . $data_kelas->nomor;
        }

        return view('wali_kelas/index', [
            'active' => 'dashboard',
            'title' => 'Wali Kelas | Dashboard',
            'mapel' => $this->mapel->findAll(),
            'siswa'    => $data_kelas !== null ? $this->siswa->where('kelas', $kelas)->findAll() : $this->siswa->findAll(),
        ]);
    }

    public function penilaian()
    {
        return view('wali_kelas/penilaian', [
            'active' => 'penilaian',
            'title'  => 'Wali Kelas | Penilaian Siswa',
            'mapel'  => $this->mapel->orderBy('tipe', 'ASC')->findAll(),
            'siswa'  => $this->siswa->findAll(),
            'kelas'  => $this->kelas->where('wali', user()->nama)->findAll(),
        ]);
    }

    public function penilaian_add()
    {
        $data_kelas = $this->kelas->where('wali', user()->nama)->first();

        if ($data_kelas !== null) {
            $kelas = $data_kelas->kelas . " " . $data_kelas->jurusan . " " . $data_kelas->nomor;
        }

        return view('wali_kelas/penilaian_add', [
            'active'   => 'penilaian',
            'title'    => 'Wali Kelas | Tambah Penilaian Siswa',
            'mapel'    => $this->mapel->orderBy('tipe', 'ASC')->findAll(),
            'siswa'    => $data_kelas !== null ? $this->siswa->where('kelas', $kelas)->findAll() : $this->siswa->findAll(),
            'kelas'    => $this->kelas->findAll(),
            'kategori' => $this->kategori->orderBy('kategori', 'ASC')->findAll(),
        ]);
    }

    public function penilaian_edit($id)
    {
        return view('wali_kelas/penilaian_edit', [
            'active'   => 'penilaian',
            'title'    => 'Wali Kelas | Edit Penilaian Siswa',
            'nilai'    => $this->nilai->where('id', $id)->first(),
            'mapel'    => $this->mapel->orderBy('tipe', 'ASC')->findAll(),
            'siswa'    => $this->siswa->findAll(),
            'kelas'    => $this->kelas->findAll(),
            'kategori' => $this->kategori->orderBy('kategori', 'ASC')->findAll(),
        ]);
    }

    public function nilai_detail($id)
    {
        return view('admin/penilaian_detail', [
            'active'   => 'penilaian',
            'title'    => 'Admin | Detail Penilaian Siswa',
            'nilai'    => $this->nilai->where('id', $id)->first(),
            'mapel'    => $this->mapel->orderBy('tipe', 'ASC')->findAll(),
            'siswa'    => $this->siswa->findAll(),
            'kelas'    => $this->kelas->findAll(),
            'kategori' => $this->kategori->orderBy('kategori', 'ASC')->findAll(),
        ]);
    }

    public function getJsonNilai($kelas, $semester)
    {
        if ($kelas == null || $semester == null) {
            return json_encode([
                'status' => 'error'
            ]);
        } else {
            $data = $this->nilai->where([
                'kelas'    => $kelas,
                'semester' => $semester
            ])->groupBy('nama')->findAll();
            if (count($data) > 0) {
                return json_encode([
                    'status' => 'success',
                    'data'   => $data
                ]);
            } else {
                return json_encode([
                    'status' => 'success',
                    'data'   => null
                ]);
            }
        }
    }

    public function getJsonSiswa($id = null)
    {
        if ($id !== null) {
            if (count($this->siswa->where('id', $id)->find()) !== 0) {
                return json_encode([
                    'status' => 'success',
                    'data' => $this->siswa->where('id', $id)->find()
                ]);
            } else {
                return json_encode([
                    'status' => 'error'
                ]);
            }
        } else {
            return json_encode([
                'status' => 'error'
            ]);
        }
    }

    public function getJsonMapel($id = null)
    {
        if ($id !== null) {
            if (count($this->mapel->where('id', $id)->find()) !== 0) {
                return json_encode([
                    'status' => 'success',
                    'data' => $this->mapel->where('id', $id)->find()
                ]);
            } else {
                return json_encode([
                    'status' => 'error'
                ]);
            }
        } else {
            return json_encode([
                'status' => 'error'
            ]);
        }
    }

    public function getJsonJurusan($id = null)
    {
        if ($id !== null) {
            if (count($this->jurusan->where('id', $id)->find()) !== 0) {
                return json_encode([
                    'status' => 'success',
                    'data' => $this->jurusan->where('id', $id)->find()
                ]);
            } else {
                return json_encode([
                    'status' => 'error'
                ]);
            }
        } else {
            return json_encode([
                'status' => 'error'
            ]);
        }
    }


    public function getJsonNilaiById($id)
    {
        if ($id == null) {
            return json_encode([
                'status' => 'error'
            ]);
        } else {
            $data = $this->nilai->where([
                'id_siswa'    => $id,
            ])->findAll();
            if (count($data) > 0) {
                return json_encode([
                    'status' => 'success',
                    'data'   => $data
                ]);
            } else {
                return json_encode([
                    'status' => 'success',
                    'data'   => null
                ]);
            }
        }
    }

    public function nilai_store()
    {
        $kategori_penilaian = $this->kategori->orderBy('kategori', 'ASC')->findAll();

        $nilai_post = $this->request->getPost('nilaiMapel');
        $nilai = [];

        // get tipe
        foreach ($kategori_penilaian as $key => $value) {
            $nilai[$value->kategori] = [];
        }

        foreach ($nilai as $key => $value) {
            foreach ($nilai_post as $k => $v) {
                $tipe = $this->mapel->where('nama', $k)->first();
                if ($tipe->tipe == $key) {
                    array_push($nilai[$key], [
                        'mapel' => $tipe->nama,
                        'nilai' => $v
                    ]);
                }
            }
        }

        $data = [
            "semester" => $this->request->getPost('semester'),
            "id_siswa" => $this->request->getPost('idSiswa'),
            "nama"     => $this->request->getPost('nama'),
            "kelas"    => $this->request->getPost('kelas'),
            "jurusan"  => $this->request->getPost('jurusan'),
            "nilai"    => json_encode($nilai),
        ];

        if ($this->nilai->save($data)) {
            session()->setFlashdata('success', 'Data Penilaian Akademik berhasil ditambahkan');
            return redirect()->to('/wali_kelas/penilaian');
        } else {
            session()->setFlashdata('error', 'Data Penilaian Akademik gagal ditambahkan');
            return redirect()->to('/wali_kelas/penilaian');
        }
    }

    public function nilai_update()
    {
        $kategori_penilaian = $this->kategori->orderBy('kategori', 'ASC')->findAll();

        $nilai_post = $this->request->getPost('nilaiMapel');
        $nilai = [];

        // get tipe
        foreach ($kategori_penilaian as $key => $value) {
            $nilai[$value->kategori] = [];
        }

        foreach ($nilai as $key => $value) {
            foreach ($nilai_post as $k => $v) {
                $tipe = $this->mapel->where('nama', $k)->first();
                if ($tipe->tipe == $key) {
                    array_push($nilai[$key], [
                        'mapel' => $tipe->nama,
                        'nilai' => $v
                    ]);
                }
            }
        }

        $data = [
            "id"       => $this->request->getPost('editIdNilai'),
            "semester" => $this->request->getPost('semester'),
            "id_siswa" => $this->request->getPost('id_siswa'),
            "nama"     => $this->request->getPost('nama'),
            "kelas"    => $this->request->getPost('kelas'),
            "jurusan"  => $this->request->getPost('jurusan'),
            "nilai"    => json_encode($nilai),
        ];

        if ($this->nilai->save($data)) {
            session()->setFlashdata('success', 'Data Penilaian Akademik berhasil diubah');
            return redirect()->to('/wali_kelas/penilaian');
        } else {
            session()->setFlashdata('error', 'Data Penilaian Akademik gagal diubah');
            return redirect()->to('/wali_kelas/penilaian');
        }
    }

    public function nilai_delete($smt, $nama)
    {
        if ($this->nilai->where(['semester' => $smt, 'nama' => $nama])->delete()) {
            session()->setFlashdata('success', 'Data penilaian berhasil dihapus');
            return redirect()->to('/wali_kelas/penilaian');
        } else {
            session()->setFlashdata('error', 'Data penilaian gagal dihapus');
            return redirect()->to('/wali_kelas/penilaian');
        }
    }

    public function rapor($smt, $nama)
    {
        if ($smt == null || $nama == null) {
            return redirect()->to('/wali_kelas/penilaian');
        } else {
            $data = $this->nilai->where([
                'nama'    => $nama,
                'semester' => $smt
            ])->findAll();

            return view('admin/rapor', [
                'data' => $data,
            ]);
        }
    }

    public function nilai_print($id)
    {
        if ($id == null) {
            return redirect()->to('/wali_kelas/penilaian');
        } else {
            $data = $this->nilai->where([
                'id'    => $id,
            ])->findAll();

            // return view('admin/rapor', [
            //     'data' => $data,
            // ]);

            $html = view('admin/rapor', [
                'data' => $data,
            ]);

            // $pdf = new \TCPDF('P', PDF_UNIT, 'F4', true, 'UTF-8', false);
            // $pdf->setPrintHeader(false);
            // $pdf->setPrintFooter(false);

            // $pdf->addPage();
            // $pdf->writeHTML($html, true, false, true, false, '');
            // //line ini penting
            // $this->response->setContentType('application/pdf');
            // $pdf->Output();

            // --------------------------------------
            $options = new \Dompdf\Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new \Dompdf\Dompdf($options);
            $dompdf->loadHtml($html);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('F4', 'potrait');
            // Render the HTML as PDF
            $dompdf->render();
            // Output the generated PDF to Browser
            $dompdf->stream();
        }
    }
}
