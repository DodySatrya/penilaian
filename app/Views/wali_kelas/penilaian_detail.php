<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<?php
$n = json_decode($nilai->nilai);
?>

<section class="section">
    <div class="section-header">
        <h1>Detail Penilaian Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="/wali_kelas/penilaian" class="btn btn-primary btn-tambah-nilai">
                    <i class="fa fa-arrow-left mr-2"></i> BACK
                </a>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-primary">
            <form action="/wali_kelas/nilai/update" id="formNilai" class="formNilai" method="post">
                <input type="hidden" name="editIdNilai" value="<?= $nilai->id ?>">
                <input type="hidden" name="id_siswa" value="<?= $nilai->id_siswa ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="semester" class="form-label">Semester</label>
                                <input type="number" required min="1" value="<?= $nilai->semester ?>" name="semester" id="semester" placeholder="Masukan Semester (1,2)" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="idSiswa" class="form-label">Siswa</label>
                                <select name="idSiswa" disabled required id="idSiswa" class="custom-select">
                                    <option value="default">-- PILIH SISWA --</option>
                                    <?php foreach ($siswa as $s) : ?>
                                        <option <?= $nilai->id_siswa == $s->id ? 'selected' : '' ?> value="<?= $s->id ?>"><?= $s->nama ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" value="<?= $nilai->nama ?>" id="nama" readonly readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" name="kelas" value="<?= $nilai->kelas ?>" id="kelas" readonly readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <input type="text" name="jurusan" value="<?= $nilai->jurusan ?>" id="jurusan" readonly readonly class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($kategori as $key => $value) : ?>
                            <div class="col-md-6">
                                <div class="section-title"><?= $value->kategori ?></div>
                                <?php $index = 0; ?>
                                <?php foreach ($mapel as $k => $v) : ?>
                                    <?php if (strtolower($v->tipe) == strtolower($value->kategori)) : ?>
                                        <div class="form-group">
                                            <label for="<?= $v->nama ?>" class="form-label"><?= $v->nama ?></label>
                                            <!-- bisa juga pake ( array_key_exists($index, $n->{$value->kategori}) ? $n->{$value->kategori}[$index]->nilai : 0 ) -->
                                            <input value="<?= isset($n->{$value->kategori}[$index]) ? $n->{$value->kategori}[$index]->nilai : 0 ?>" type="number" min="0" max="100" required placeholder="Masukan nilai <?= $v->nama ?>" name="nilaiMapel[<?= $v->nama ?>]" id="nilaiMapel_<?= $v->nama ?>" readonly class="form-control mapelku">
                                        </div>
                                        <?php $index++ ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php $index = 0 ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $("#idSiswa").change(function() {
            var idSiswa = $(this).val();
            $.ajax({
                url: '/wali_kelas/siswa/get/' + idSiswa,
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    $("#nama").val(res.data[0].nama);
                    $("#kelas").val(res.data[0].kelas);
                    $("#jurusan").val(res.data[0].jurusan);
                }
            });
        });

        // Form Validation
        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "This field is required");

        $.validator.addMethod("metodku", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");

        $(".formNilai").validate({
            rules: {
                semester: {
                    required: true,
                    min: 1
                },
                idSiswa: {
                    required: true,
                    metodku: true,
                    valueNotEquals: "default"
                },
            },
        });

        <?php foreach ($mapel as $m) : ?>
            $(".formNilai").validate({
                rules: {
                    "nilaiMapel[<?= $m->nama ?>]": {
                        required: true,
                        number: true,
                        min: 0,
                        max: 100
                    },
                },
                messages: {
                    "nilaiMapel[<?= $m->nama ?>]": {
                        required: "Nilai <?= $m->nama ?> tidak boleh kosong",
                        number: "Nilai <?= $m->nama ?> harus berupa angka",
                        min: "Nilai <?= $m->nama ?> minimal 0",
                        max: "Nilai <?= $m->nama ?> maksimal 100"
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "nilaiMapel[<?= $m->nama ?>]") {
                        error.insertAfter("#nilaiMapel_<?= $m->nama ?>");
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        <?php endforeach ?>
    });
</script>
<?= $this->endSection(); ?>