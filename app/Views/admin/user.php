<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Daftar Pengguna</h1>
    </div>

    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Data Pengguna</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahUser">
                        <i class="fa fa-plus-circle"></i> Pengguna
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Role</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th class="text-center"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($user as $u) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                    <?php $role = $u->getRoles() ?>
                                    <?php if (end($role) == 'admin') : ?>
                                        <div class="badge badge-primary"><?= end($role) ?></div>
                                    <?php else : ?>
                                        <div class="badge badge-secondary"><?= end($role) ?></div>
                                    <?php endif ?>
                                </td>
                                <td><?= $u->nama ?></td>
                                <td><?= $u->username ?></td>
                                <td><?= $u->email ?></td>
                                <td class="text-center">
                                    <button data-toggle="modal" data-target="#editUserPass<?= $u->id . $u->username ?>" class="btn btn-sm btn-warning"><i class="fa fa-key"></i></button>
                                    <button data-toggle="modal" data-target="#editUser<?= $u->id . $u->username ?>" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></button>
                                    <button class="btn btn-danger btn-sm" data-confirm="Woops...|Apakah anda yakin akan menghapus user <?= $u->username ?>" data-confirm-yes="$.ajax({ url: '/admin/user/user_del/' + <?= $u->id ?>, type: 'DELETE', success: function(result) { window.location.href = '/admin/user'; }});">
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
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="tambahUser">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/user/store" id="formUser" method="post">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="role" class="form-label">role</label>
                            <select name="role" id="role" class="custom-select">
                                <option value="default">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="wali_kelas">Wali kelas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" name="password" id="password" readonly value="#SMKINPekalongan" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">TAMBAH PENGGUNA</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($user as $u) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="editUser<?= $u->id . $u->username ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update User Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/user/update" id="formUser" method="post">
                        <input type="hidden" name="randomUser" value="<?= $u->id ?>">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" required value="<?= $u->nama ?>" name="nama" id="nama" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" readonly value="<?= $u->username ?>" name="username" id="username" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="role" class="form-label">role</label>
                                <?php $role = $u->getRoles() ?>
                                <select name="role" required id="role" class="custom-select">
                                    <option value="default">Pilih Role</option>
                                    <option <?= end($role) == 'admin' ? 'selected' : '' ?> value="1">Admin</option>
                                    <option <?= end($role) == 'wali_kelas' ? 'selected' : '' ?> value="2">Wali kelas</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" value="<?= $u->email ?>" required name="email" id="email" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?php foreach ($user as $u) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="editUserPass<?= $u->id . $u->username ?>">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Password Ke Default</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/user/password_default" id="formUser" method="post">
                        <input type="hidden" name="randomUser" value="<?= $u->id ?>">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" name="password" id="password" readonly value="#SMKINPekalongan" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">UBAH PASSWORD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<script>
    $(document).ready(function() {
        $.validator.addMethod("metodku", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Username must contain only letters, numbers, or dashes.");

        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "This field is required.");

        $("#formUser").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 3,
                    metodku: true
                },
                username: {
                    required: true,
                    minlength: 3,
                    metodku: true
                },
                role: {
                    required: true,
                    valueNotEquals: "default"
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
        });
    });
</script>
<?= $this->endSection(); ?>