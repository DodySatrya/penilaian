<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Mata Pelajaran</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-7">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data Mata Pelajaran</h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMapel">
                                <i class="fa fa-plus-circle mr-1"></i> Mapel
                            </button>
                        </div>
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
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fa fa-hashtag"></i></th>
                                        <th>Tipe Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>KKM</th>
                                        <th class="text-center"><i class="fa fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($mapel as $m) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td>
                                                <?php if (strtolower($m->tipe) == 'akademik') : ?>
                                                    <div class="badge badge-primary"><?= $m->tipe ?></div>
                                                <?php elseif (strtolower($m->tipe) == 'non akademik') : ?>
                                                    <div class="badge badge-info"><?= $m->tipe ?></div>
                                                <?php elseif (strtolower($m->tipe) == 'ekstrakurikuler' || strtolower($m->tipe) == 'ekstra kurikuler' || strtolower($m->tipe) == 'ekskul') : ?>
                                                    <div class="badge badge-success"><?= $m->tipe ?></div>
                                                <?php elseif (strtolower($m->tipe) == 'kehadiran') : ?>
                                                    <div class="badge badge-warning"><?= $m->tipe ?></div>
                                                <?php else : ?>
                                                    <div class="badge badge-secondary"><?= $m->tipe ?></div>
                                                <?php endif ?>
                                            </td>
                                            <td><?= $m->nama; ?></td>
                                            <td><?= $m->has_kkm == true ? $m->kkm : '-'; ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm" data-confirm="Woops...|Apakah anda yakin akan menghapus jurusan <?= $m->nama ?>" data-confirm-yes="$.ajax({ url: '/admin/mapel/delete/' + <?= $m->id ?>, type: 'DELETE', success: function(result) { window.location.href = '/admin/mapel'; }});">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Kategori Penilaian</h4>
                    </div>
                    <div class="card-body">
                        <form action="/admin/mapel/kategori_add" class="mb-3" method="POST">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" class="form-control mr-2 w-100" id="nama" name="nama" placeholder="Nama Kategori">
                                </div>
                                <div class="col-md-4 text-right">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>

                        <div class="list-group">
                            <?php foreach ($kategori as $k) : ?>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <b><?= $k->kategori; ?></b>
                                    <span class="float-right">
                                        <button class="btn btn-danger btn-sm" data-confirm="Woops...|Apakah anda yakin akan menghapus kategori <?= $k->kategori ?>" data-confirm-yes="$.ajax({ url: '/admin/mapel/kategori_del/' + <?= $k->id ?>, type: 'DELETE', success: function(result) { window.location.href = '/admin/mapel'; }});">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </span>
                                </a>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- tambah mapel -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahMapel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/mapel/store" id="formMapel" method="post">
                    <div class="form-group">
                        <label for="nama">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mata Pelajaran">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="has_kkm">Tetapkkan KKM</label>
                                <select name="has_kkm" id="has_kkm" class="custom-select">
                                    <option value="default"> -- MAPEL INI PUNYA KKM ? -- </option>
                                    <option value="true">Ya</option>
                                    <option value="false">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipe" class="form-label">Tipe Kelas</label>
                                <select name="tipe_kelas" class="custom-select" id="tipe">
                                    <option value="default">-- PILIH TIPE KELAS --</option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k->kategori ?>"><?= $k->kategori ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-none" id="kkm_field">
                            <div class="form-group">
                                <label for="kkm">KKM</label>
                                <input type="number" class="form-control" value="0" min="0" step="5" id="kkm" name="kkm" placeholder="KKM / Nilai Minimum">
                            </div>
                        </div>
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

<script>
    $(document).ready(function() {
        $.validator.addMethod("metodku", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");

        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "This field is required.");

        $("#formMapel").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 3,
                    metodku: true
                },
                tipe_kelas: {
                    required: true,
                    valueNotEquals: "default"
                },
                has_kkm: {
                    required: true,
                    valueNotEquals: "default"
                },
                kkm: {
                    required: true,
                    number: true
                }
            },
        });

        $("#has_kkm").change(function() {
            if ($(this).val() == 'true') {
                $("#kkm_field").removeClass('d-none');
                $("#formMapel").validate({
                    rules: {
                        kkm: {
                            required: true,
                            number: true
                        }
                    },
                });
            } else {
                $("#kkm_field").addClass('d-none');
                $("#formMapel").validate({
                    rules: {
                        kkm: {}
                    },
                });
            }
        });
    });
</script>
<?= $this->endSection(); ?>