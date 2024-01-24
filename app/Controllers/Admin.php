<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Authorization\GroupModel;

class Admin extends BaseController
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
        $this->jurusan = new \App\Models\JurusanModel();
        $this->kelas = new \App\Models\KelasModel();
        $this->siswa = new \App\Models\SiswaModel();
        $this->mapel = new \App\Models\MapelModel();
        $this->nilai = new \App\Models\NilaiModel();
        $this->kategori = new \App\Models\KategoriModel();
        $this->user = new \App\Models\UserModel();
        $this->group = new GroupModel();
    }

    public function index()
    {
        return view('admin/index', [
            'active'  => 'dashboard',
            'title'   => 'Admin | Dashboard',
            'jurusan' => $this->jurusan->findAll(),
            'kelas'   => $this->kelas->findAll(),
            'siswa'   => $this->siswa->findAll(),
            'mapel'   => $this->mapel->findAll(),
            'user'    => $this->user->findAll(),
        ]);
    }

    public function siswa()
    {
        return view('admin/siswa', [
            'active'  => 'siswa',
            'title' => 'Admin | Data  Siswa',
            'siswa' => $this->siswa->findAll(),
            'jurusan' => $this->jurusan->findAll(),
            'kelas' => $this->kelas->findAll(),
        ]);
    }

    public function siswa_store()
    {
        $data = [
            'nis'           => $this->request->getPost('nis'),
            'nama'          => $this->request->getPost('nama'),
            'kelas'         => $this->request->getPost('kelas'),
            'jurusan'       => $this->request->getPost('jurusan'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelaim'),
            'agama'         => $this->request->getPost('agama'),
            'alamat'        => $this->request->getPost('alamat'),
        ];

        if ($this->siswa->save($data)) {
            session()->setFlashdata('success', 'Data siswa berhasil ditambahkan');
            return redirect()->to('/admin/siswa');
        } else {
            session()->setFlashdata('error', 'Data siswa gagal ditambahkan');
            return redirect()->to('/admin/siswa');
        }
    }

    public function siswa_update()
    {
        $data = [
            'id'            => $this->request->getPost('randomEdit'),
            'nis'           => $this->request->getPost('nis'),
            'nama'          => $this->request->getPost('nama'),
            'kelas'         => $this->request->getPost('kelas'),
            'jurusan'       => $this->request->getPost('jurusan'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelaim'),
            'agama'         => $this->request->getPost('agama'),
            'alamat'        => $this->request->getPost('alamat'),
        ];

        if ($this->siswa->save($data)) {
            session()->setFlashdata('success', 'Data siswa berhasil diupdate');
            return redirect()->to('/admin/siswa');
        } else {
            session()->setFlashdata('error', 'Data siswa gagal diupdate');
            return redirect()->to('/admin/siswa');
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

    public function kelas()
    {
        return view('admin/kelas', [
            'active'  => 'kelas',
            'title'   => 'Admin | Data Kelas',
            'jurusan' => $this->jurusan->findAll(),
            'mapel' => $this->mapel->findAll(),
            'kelas'   => $this->kelas->findAll(),
            'wali' => $this->group->getUsersForGroup(2)
        ]);
    }

    public function siswa_delete($id)
    {
        if ($this->siswa->delete($id)) {
            session()->setFlashdata('success', 'Data siswa berhasil dihapus');
            return redirect()->to('/admin/siswa');
        } else {
            session()->setFlashdata('error', 'Data siswa gagal dihapus');
            return redirect()->to('/admin/siswa');
        }
    }

    public function kelas_store()
    {
        $data = [
            'wali'       => $this->request->getPost('wali'),
            'kelas'      => $this->request->getPost('kelas'),
            'jurusan'    => $this->request->getPost('jurusan'),
            'nomor'      => $this->request->getPost('nomor'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        if ($this->kelas->save($data)) {
            session()->setFlashdata('success', 'Data kelas berhasil ditambahkan');
            return redirect()->to('/admin/kelas');
        } else {
            session()->setFlashdata('error', 'Data kelas gagal ditambahkan');
            return redirect()->to('/admin/kelas');
        }
    }

    public function kelas_delete($id)
    {
        if ($this->kelas->delete($id)) {
            session()->setFlashdata('success', 'Data kelas berhasil dihapus');
            return redirect()->to('/admin/kelas');
        } else {
            session()->setFlashdata('error', 'Data kelas gagal dihapus');
            return redirect()->to('/admin/kelas');
        }
    }

    public function jurusan()
    {
        return view('admin/jurusan', [
            'active'  => 'jurusan',
            'title'   => 'Admin | Data Jurusan',
            'jurusan' => $this->jurusan->findAll(),
        ]);
    }

    public function jurusan_store()
    {
        $data = [
            "nama"       => $this->request->getPost('nama_jurusan'),
            "keterangan" => $this->request->getPost('keterangan'),
        ];

        if ($this->jurusan->save($data)) {
            session()->setFlashdata('success', 'Data jurusan berhasil ditambahkan');
            return redirect()->to('/admin/jurusan');
        } else {
            session()->setFlashdata('error', 'Data jurusan gagal ditambahkan');
            return redirect()->to('/admin/jurusan');
        }
    }

    public function jurusan_update()
    {
        $data = [
            "id"         => $this->request->getPost('randomEdit'),
            "nama"       => $this->request->getPost('nama_jurusan'),
            "keterangan" => $this->request->getPost('keterangan'),
        ];

        if ($this->jurusan->save($data)) {
            session()->setFlashdata('success', 'Data jurusan berhasil diedit');
            return redirect()->to('/admin/jurusan');
        } else {
            session()->setFlashdata('error', 'Data jurusan gagal diedit');
            return redirect()->to('/admin/jurusan');
        }
    }

    public function jurusan_delete($id)
    {
        if ($this->jurusan->delete($id)) {
            session()->setFlashdata('success', 'Data jurusan berhasil dihapus');
            return redirect()->to('/admin/jurusan');
        } else {
            session()->setFlashdata('error', 'Data jurusan gagal dihapus');
            return redirect()->to('/admin/jurusan');
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

    public function mapel()
    {
        return view('admin/mapel', [
            'active'   => 'mapel',
            'title'    => 'Admin | Data Mata Pelajaran',
            'mapel'    => $this->mapel->orderBy('tipe', 'ASC')->findAll(),
            'kategori' => $this->kategori->orderBy('kategori', 'ASC')->findAll(),
        ]);
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

    public function mapel_store()
    {
        if($this->request->getPost("has_kkm") == 'true') {
            $has_kkm = 1;
        } else {
            $has_kkm = 0;
        }

        $data = [
            "nama"       => $this->request->getPost('nama'),
            "tipe"       => $this->request->getPost('tipe_kelas'),
            "kkm"        => $this->request->getPost('kkm'),
            "has_kkm"    => $has_kkm,
            "keterangan" => $this->request->getPost('keterangan'),
        ];

        if ($this->mapel->save($data)) {
            session()->setFlashdata('success', 'Data Mata Pelajaran berhasil ditambahkan');
            return redirect()->to('/admin/mapel');
        } else {
            session()->setFlashdata('error', 'Data Mata Pelajaran gagal ditambahkan');
            return redirect()->to('/admin/mapel');
        }
    }

    public function mapel_update()
    {
        $data = [
            "id"         => $this->request->getPost('randomEdit'),
            "nama"       => $this->request->getPost('nama'),
            "tipe"       => $this->request->getPost('tipe_kelas'),
            "kkm"        => $this->request->getPost('kkm'),
            "keterangan" => $this->request->getPost('keterangan'),
        ];

        if ($this->mapel->save($data)) {
            session()->setFlashdata('success', 'Data Mata Pelajaran berhasil diubah');
            return redirect()->to('/admin/mapel');
        } else {
            session()->setFlashdata('error', 'Data Mata Pelajaran gagal diubah');
            return redirect()->to('/admin/mapel');
        }
    }

    public function mapel_delete($id)
    {
        if ($this->mapel->delete($id)) {
            session()->setFlashdata('success', 'Data Mata Pelajaran berhasil dihapus');
            return redirect()->to('/admin/mapel');
        } else {
            session()->setFlashdata('error', 'Data Mata Pelajaran gagal dihapus');
            return redirect()->to('/admin/mapel');
        }
    }

    public function kategori_del($id)
    {
        if ($this->kategori->delete($id)) {
            session()->setFlashdata('success', 'Data Mata Pelajaran berhasil dihapus');
            return redirect()->to('/admin/mapel');
        } else {
            session()->setFlashdata('error', 'Data Mata Pelajaran gagal dihapus');
            return redirect()->to('/admin/mapel');
        }
    }

    public function kategori_add()
    {
        $data = [
            "kategori" => $this->request->getPost('nama'),
        ];

        if ($this->kategori->save($data)) {
            session()->setFlashdata('success', 'Data Kategori berhasil ditambahkan');
            return redirect()->to('/admin/mapel');
        } else {
            session()->setFlashdata('error', 'Data Kategori gagal ditambahkan');
            return redirect()->to('/admin/mapel');
        }
    }

    public function user()
    {
        return view('admin/user', [
            'active' => 'users',
            'title' => "Admin | Daftar Pengguna",
            'user' => $this->user->findAll(),
        ]);
    }

    public function user_store()
    {
        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'active'   => 1
        ];
        
        $data = new \App\Entities\User($data);

        if ($this->user->withGroup($this->request->getPost('role'))->save($data)) {
            session()->setFlashdata('success', 'Data Pengguna berhasil ditambahkan');
            return redirect()->to('/admin/user');
        } else {
            session()->setFlashdata('error', 'Data Pengguna gagal ditambahkan');
            return redirect()->to('/admin/user');
        }
    }

    public function user_update()
    {
        $data = [
            'id'       => $this->request->getPost('randomUser'),
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'active'   => 1
        ];
        
        $this->group->removeUserFromAllGroups($data['id']);
        $this->group->addUserToGroup($data['id'], $this->request->getPost('role'));

        $data = new \App\Entities\User($data);

        if ($this->user->save($data)) {
            session()->setFlashdata('success', 'Data Pengguna berhasil diubah');
            return redirect()->to('/admin/user');
        } else {
            session()->setFlashdata('error', 'Data Pengguna gagal diubah');
            return redirect()->to('/admin/user');
        }
    }

    public function password_default()
    {
        $data = [
            'id' => $this->request->getPost('randomUser'),
            'password' => "#SMKINPekalongan"
        ];

        $data = new \App\Entities\User($data);

        if ($this->user->save($data)) {
            session()->setFlashdata('success', 'Data Pengguna berhasil diubah');
            return redirect()->to('/admin/user');
        } else {
            session()->setFlashdata('error', 'Data Pengguna gagal diubah');
            return redirect()->to('/admin/user');
        }
    }

    public function user_del($id)
    {
        if ($this->user->delete($id)) {
            session()->setFlashdata('success', 'Data penilaian berhasil dihapus');
            return redirect()->to('/admin/penilaian');
        } else {
            session()->setFlashdata('error', 'Data penilaian gagal dihapus');
            return redirect()->to('/admin/penilaian');
        }
    }

    public function penilaian()
    {
        return view('admin/penilaian', [
            'active' => 'penilaian',
            'title'  => 'Admin | Penilaian Siswa',
            'mapel'  => $this->mapel->orderBy('tipe', 'ASC')->findAll(),
            'siswa'  => $this->siswa->findAll(),
            'kelas'  => $this->kelas->findAll(),
        ]);
    }

    public function penilaian_add()
    {
        return view('admin/penilaian_add', [
            'active'   => 'penilaian',
            'title'    => 'Admin | Tambah Penilaian Siswa',
            'mapel'    => $this->mapel->orderBy('tipe', 'ASC')->findAll(),
            'siswa'    => $this->siswa->findAll(),
            'kelas'    => $this->kelas->findAll(),
            'kategori' => $this->kategori->orderBy('kategori', 'ASC')->findAll(),
        ]);
    }

    public function penilaian_edit($id)
    {
        return view('admin/penilaian_edit', [
            'active'   => 'penilaian',
            'title'    => 'Admin | Edit Penilaian Siswa',
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
            return redirect()->to('/admin/penilaian');
        } else {
            session()->setFlashdata('error', 'Data Penilaian Akademik gagal ditambahkan');
            return redirect()->to('/admin/penilaian');
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
            return redirect()->to('/admin/penilaian');
        } else {
            session()->setFlashdata('error', 'Data Penilaian Akademik gagal diubah');
            return redirect()->to('/admin/penilaian');
        }
    }

    public function nilai_delete($smt, $nama)
    {
        if ($this->nilai->where(['semester' => $smt, 'nama' => $nama])->delete()) {
            session()->setFlashdata('success', 'Data penilaian berhasil dihapus');
            return redirect()->to('/admin/penilaian');
        } else {
            session()->setFlashdata('error', 'Data penilaian gagal dihapus');
            return redirect()->to('/admin/penilaian');
        }
    }

    public function rapor($smt, $nama)
    {
        if ($smt == null || $nama == null) {
            return redirect()->to('/admin/penilaian');
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
            return redirect()->to('/admin/penilaian');
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
