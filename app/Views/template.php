<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title !== null ? $title : '' ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assets/modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/assets/modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/assets/modules/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">

    <!-- Javascript First -->
    <script src="/assets/modules/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <style>
        .error {
            color: red !important;
        }
    </style>

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="/assets/img/tangan.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= user()->nama ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">SMK IN Pekalongan</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">St</a>
                    </div>
                    <ul class="sidebar-menu">
                        <?php if (in_groups('admin')) : ?>
                            <li class="menu-header">Dashboard</li>
                            <li class="<?= $active == 'dashboard' ? 'active' : '' ?>"><a class="nav-link" href="/admin"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
                            <li class="menu-header">Penilaian</li>
                            <li class="<?= $active == 'penilaian' ? 'active' : '' ?>"><a class="nav-link" href="/admin/penilaian"><i class="fas fa-star-half-alt"></i> <span>Penilaian</span></a></li>
                            <li class="menu-header">Data</li>
                            <li class="<?= $active == 'siswa' ? 'active' : '' ?>"><a class="nav-link" href="/admin/siswa"><i class="fas fa-users"></i> <span>Siswa</span></a></li>
                            <li class="<?= $active == 'mapel' ? 'active' : '' ?>"><a class="nav-link" href="/admin/mapel"><i class="fas fa-book"></i> <span>Mata Pelajaran</span></a></li>
                            <li class="<?= $active == 'kelas' ? 'active' : '' ?>"><a class="nav-link" href="/admin/kelas"><i class="fas fa-object-group"></i> <span>Kelas</span></a></li>
                            <li class="<?= $active == 'jurusan' ? 'active' : '' ?>"><a class="nav-link" href="/admin/jurusan"><i class="fas fa-layer-group"></i> <span>Jurusan</span></a></li>
                            <li class="menu-header">Pengguna</li>
                            <li class="<?= $active == 'users' ? 'active' : '' ?>"><a class="nav-link" href="/admin/user"><i class="fas fa-user-cog"></i> <span>Data Pengguna</span></a></li>
                        <?php elseif (in_groups('wali_kelas')) : ?>
                            <li class="menu-header">Dashboard</li>
                            <li class="<?= $active == 'dashboard' ? 'active' : '' ?>"><a class="nav-link" href="/wali_kelas"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
                            <li class="menu-header">Penilaian</li>
                            <li class="<?= $active == 'penilaian' ? 'active' : '' ?>"><a class="nav-link" href="/wali_kelas/penilaian"><i class="fas fa-star-half-alt"></i> <span>Penilaian</span></a></li>
                        <?php else : ?>
                        <?php endif ?>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content'); ?>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="/assets/modules/popper.js"></script>
    <script src="/assets/modules/tooltip.js"></script>
    <script src="/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/assets/modules/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="/assets/modules/cleave-js/dist/cleave.min.js"></script>
    <script src="/assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
    <script src="/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="/assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="/assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="assets/js/page/forms-advanced-forms.js"></script>

    <!-- Template JS File -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>

</html>