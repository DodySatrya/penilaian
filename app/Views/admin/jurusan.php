<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Jurusan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusan">
                    <i class="fa fa-plus-circle mr-1"></i> Tambah Data
                </button>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data Jurusan</h4>
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
                                        <th>Nama Jurusan</th>
                                        <th>Keterangan</th>
                                        <th><i class="fa fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($jurusan as $j) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $j->nama; ?></td>
                                            <td><?= $j->keterangan; ?></td>
                                            <td>
                                                <button class="btn btn-light btn-sm btn-edit" data-number='<?= $j->id ?>' data-toggle="modal" data-target="#editJurusan">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-confirm="Woops...|Apakah anda yakin akan menghapus jurusan <?= $j->nama ?>" data-confirm-yes="$.ajax({ url: '/admin/jurusan/delete/' + <?= $j->id ?>, type: 'DELETE', success: function(result) { window.location.href = '/admin/jurusan'; }});">
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

<!-- Modal Tambah Jurusan -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahJurusan">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/jurusan/store" id="formJurusan" method="post">
                    <div class="form-group">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Nama Jurusan">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="editJurusan">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/jurusan/update" id="formJurusan" method="post">
                    <input type="hidden" id="randomEdit" name="randomEdit">
                    <div class="form-group">
                        <label for="edit_nama_jurusan">Nama Jurusan</label>
                        <input type="text" class="form-control" id="edit_nama_jurusan" name="nama_jurusan" placeholder="Nama Jurusan">
                    </div>
                    <div class="form-group">
                        <label for="edit_keterangan">Keterangan</label>
                        <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="3"></textarea>
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
                    },
                    error: function(err) {
                        alert(err);
                    }
                });
            });
        })

        $.validator.addMethod("metodku", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");

        // jquery validation
        $('#formJurusan').validate({
            rules: {
                nama_jurusan: {
                    required: true,
                    minlength: 2,
                    metodku: true
                },
                keterangan: {
                    minlength: 5,
                    metodku: true
                }
            },
        });
    });
</script>
<?= $this->endSection(); ?>