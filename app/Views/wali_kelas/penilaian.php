<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Daftar Nilai Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="/wali_kelas/penilaian/add" class="btn btn-primary btn-tambah-nilai">
                    <i class="fa fa-plus-circle mr-1"></i> Tambah Data
                </a>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Data Nilai Siswa</h4>
            </div>
            <div class="card-body">

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mb-3 p-3 rounded shadow-sm" style="background-color: rgb(103 119 239 / 30%);">
                    <h5>Filter Data</h5>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group mb-2">
                                <select name="filter_kelas" id="filter_kelas" class="custom-select">
                                    <option value="default">-- PILIH KELAS --</option>
                                    <?php foreach ($kelas as $k) : ?>
                                        <option value="<?= $k->kelas . " " . $k->jurusan . " " . $k->nomor ?>"> <?= $k->kelas . " " . $k->jurusan . " " . $k->nomor ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group mb-2">
                                <select name="filter_semester" id="filter_semester" class="custom-select">
                                    <option value="default">-- PILIH SEMESTER --</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                    <option value="3">Semester 3</option>
                                    <option value="4">Semester 4</option>
                                    <option value="5">Semester 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100 btn-filter">CARI</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="tableNilaiSiswa">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <i class="fa fa-hashtag"></i>
                                </th>
                                <th>Nama Siswa</th>
                                <th>Semester</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th class="text-center" width='200px'><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $(".btn-filter").click(function() {
            const kelas = $("#filter_kelas").val();
            const semester = $("#filter_semester").val();
            $.ajax({
                url: '/wali_kelas/nilai/getBKM/' + kelas + '/' + semester,
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    $("#tableNilaiSiswa tbody").empty();
                    $.each(res.data, function(i, v) {
                        $("#tableNilaiSiswa tbody").append(`
                            <tr>
                                <td class="text-center">${i+1}</td>
                                <td>${v.nama}</td>
                                <td>${v.semester}</td>
                                <td>${v.kelas}</td>
                                <td>${v.jurusan}</td>
                                <td class="text-center">
                                    <a href="/wali_kelas/nilai/print/${v.id}" class="btn btn-success btn-sm btn-detail"><i class="fas fa-print"></i></a>
                                    <a href="/wali_kelas/nilai/detail/${v.id}" class="btn btn-info btn-sm btn-detail"><i class="fa fa-file-alt"></i></a>
                                    <a href="/wali_kelas/penilaian/edit/${v.id}" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="${v.id}" data-nama="${v.nama}" data-semester="${v.semester}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        `);
                    });

                    $(".btn-delete").each(function() {
                        $(this).click(function() {
                            const conirm = window.confirm(`Apakah yakin anda akan menghapus data milik ${$(this).data('nama')} pada semester ${$(this).data('semester')}`);
                            if (conirm) {
                                $.ajax({
                                    url: '/wali_kelas/nilai/delete/' + $(this).data('semester') + "/" + $(this).data('nama'),
                                    type: 'DELETE',
                                    success: function(r) {
                                        window.location.href = "/wali_kelas/penilaian";
                                    }
                                });
                            }
                        });
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>