<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Kelas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKelas">
                    <i class="fa fa-plus-circle mr-1"></i> Tambah Data
                </button>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data Kelas</h4>
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
                                        <th>Kelas</th>
                                        <th><i class="fa fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kelas as $k) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td><?= $k->kelas . " " . $k->jurusan . " " . $k->nomor; ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" data-confirm="Woops...|Apakah anda yakin akan menghapus kelas '<?= $k->kelas ?>'" data-confirm-yes="$.ajax({ url: '/admin/kelas/delete/' + <?= $k->id ?>, type: 'DELETE', success: function(result) { window.location.href = '/admin/kelas'; }});">
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
            <div class="col-md-4">
                <!-- alert warning -->
                <div class="mb-3">
                    <div class="alert alert-warning text-dark fade show" role="alert">
                        <strong><i class="fa fa-exclamation-circle"></i> Perhatian!</strong>
                        <p>
                            Sebelum menambahkan kelas, harap masukan jurusan terlebih dahulu.
                            <a href="/admin/jurusan" class="btn btn-sm btn-light text-dark ml-2">Tambah Jurusan</a>
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="alert alert-warning text-dark fade show" role="alert">
                        <strong><i class="fa fa-exclamation-circle"></i> Perhatian!</strong>
                        <p>
                            Data kelas tidak dapat diubah / edit, jika ada penulisan kesalahan harap hapus data dan masukan kembali data yang benar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="tambahKelas">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/kelas/store" id="formKelas" method="post">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas">
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select required class="custom-select" name="jurusan" id="jurusan">
                            <option value="default"> -- PILIH JURUSAN -- </option>
                            <?php foreach ($jurusan as $j) : ?>
                                <option value="<?= $j->nama ?>"> <?= $j->nama ?> </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nomor">Nomor</label>
                        <input type="number" class="form-control" value="0" id="nomor" name="nomor" placeholder="nomor">
                    </div>

                    <div class="form-group">
                        <label for="wali">Wali Kelas</label>
                        <select required class="custom-select" name="wali" id="wali">
                            <option value="default"> -- PILIH wali -- </option>
                            <?php foreach ($wali as $w) : ?>
                                <option value="<?= $w['nama'] ?>"> <?= $w['nama'] ?> </option>
                            <?php endforeach ?>
                        </select>
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
                    url: '/admin/jurusan/get/' + id,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(res) {
                        $('#randomEdit').val(res.data[0].id);
                        $('#edit_nama_jurusan').val(res.data[0].nama);
                        $('#edit_keterangan').val(res.data[0].keterangan);
                    }
                });
            });
        })

        // jquery validation
        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "This field is required");

        $.validator.addMethod("metodku", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");

        $('#formKelas').validate({
            rules: {
                kelas: {
                    required: true,
                    maxlength: 5,
                    metodku: true
                },
                jurusan: {
                    metodku: true,
                    valueNotEquals: "default"
                },
                wali : {
                    required: true,
                    metodku: true,
                    valueNotEquals: "default"
                }
            },
            messages: {
                jurusan: {
                    valueNotEquals: "Please select an item!"
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>