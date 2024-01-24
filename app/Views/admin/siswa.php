<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahSiswa">
                    <i class="fa fa-plus-circle mr-1"></i> Tambah Data
                </button>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data Siswa</h4>
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

                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <i class="fa fa-hashtag"></i>
                                        </th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th><i class="fa fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($siswa as $s) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td><?= $s->nis; ?></td>
                                            <td><?= $s->nama; ?> <?= $s->jenis_kelamin == "L" ? '<i class="ml-1 text-info fa fa-mars"></i>' : '<i class="ml-1 text-warning fa fa-venus"></i>'  ?></td>
                                            <td><?= $s->kelas; ?></td>
                                            <td><?= $s->jurusan; ?></td>
                                            <td>
                                                <button class="btn btn-light btn-sm btn-edit" data-number='<?= $s->id ?>' data-toggle="modal" data-target="#editSiswa">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-confirm="Woops...|Apakah anda yakin akan menghapus siswa '<?= $s->nama ?>'" data-confirm-yes="$.ajax({ url: '/admin/siswa/delete/' + <?= $s->id ?>, type: 'DELETE', success: function(result) { window.location.href = '/admin/siswa'; }});">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Siswa -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahSiswa">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/siswa/store" id="formsiswa" method="post">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" name="nis" id="nis" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="custom-select">
                                    <option value="default"> -- PILIH KELAS -- </option>
                                    <?php foreach ($kelas as $k) : ?>
                                        <option value="<?= $k->kelas . " " . str_replace(" ", "_", $k->jurusan) . " " . $k->nomor ?>"> <?= $k->kelas . " " . $k->jurusan . " " . $k->nomor ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" name="jurusan" id="jurusan" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="jenis_kelaim" class="custom-select" id="jenis_kelaim">
                                    <option value="default"> -- PILIH JENIS KELAMIN -- </option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <select name="agama" class="custom-select" id="agama">
                            <option value="default"> -- PILIH Agama -- </option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal edit siswa -->
<div class="modal fade" tabindex="-1" role="dialog" id="editSiswa">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/siswa/update" id="formsiswa" method="post">
                    <input type="hidden" name="randomEdit" id="randomEdit" value="">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" name="nis" id="nis" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="custom-select">
                                    <option value="default"> -- PILIH KELAS -- </option>
                                    <?php foreach ($kelas as $k) : ?>
                                        <option value="<?= $k->kelas . " " . str_replace(" ", "_", $k->jurusan) . " " . $k->nomor ?>"> <?= $k->kelas . " " . $k->jurusan . " " . $k->nomor ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" name="jurusan" id="jurusan" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="jenis_kelaim" class="custom-select" id="jenis_kelaim">
                                    <option value="default"> -- PILIH JENIS KELAMIN -- </option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <select name="agama" class="custom-select" id="agama">
                            <option value="default"> -- PILIH Agama -- </option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".btn-edit").each(function() {
            $(this).click(function() {
                let id = $(this).data('number');
                $.ajax({
                    url: '/admin/siswa/get/' + id,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(res) {
                        $("#editSiswa").find("#randomEdit").val(res.data[0].id);
                        $("#editSiswa").find("#nis").val(res.data[0].nis);
                        $("#editSiswa").find("#nama").val(res.data[0].nama);
                        $("#editSiswa").find("#alamat").val(res.data[0].alamat);
                        $("#editSiswa").find("#tanggal_lahir").val(res.data[0].tanggal_lahir);

                        $("#editSiswa").find("#jurusan").val(res.data[0].jurusan);

                        let kelas = res.data[0].kelas.split(" ");
                        $("#editSiswa").find("#kelas").val(kelas[0] + " " + kelas[1] + " " + kelas[2]);

                        $("#editSiswa").find("#jenis_kelaim").val(res.data[0].jenis_kelamin);

                        $("#editSiswa").find("#agama").val(res.data[0].agama);
                    }
                });
            });
        })

        $('#kelas').change(function() {
            var kelas = $(this).val();
            var kelas_split = kelas.split(" ");
            $('#jurusan').val(kelas_split[1]);
        });

        $('#editSiswa #kelas').change(function() {
            var kelas = $(this).val();
            var kelas_split = kelas.split(" ");
            $('#editSiswa #jurusan').val(kelas_split[1]);
        });

        $.validator.addMethod("metodku", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");

        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "This field is required.");

        $('#formsiswa').validate({
            rules: {
                nis: {
                    required: true,
                    number: true,
                    minlength: 5,
                    maxlength: 50
                },
                nama: {
                    required: true,
                    minlength: 5,
                    maxlength: 50,
                    metodku: true
                },
                kelas: {
                    required: true,
                    valueNotEquals: "default"
                },
                jurusan: {
                    required: true
                },
                tanggal_lahir: {
                    required: true,
                    date: true
                },
                jenis_kelaim: {
                    required: true,
                    valueNotEquals: "default"
                },
                agama: {
                    required: true,
                    valueNotEquals: "default"
                },
                alamat: {
                    required: true,
                    metodku: true
                }
            },
        });
    });
</script>
<?= $this->endSection(); ?>