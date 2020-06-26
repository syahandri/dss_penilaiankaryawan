<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon-32x32.png" size="32x32">

    <title><?= $judul; ?></title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <!-- Font Awesome-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Style sb admin-2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/sb-admin-2.min.css">

    <!-- Data tables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/fixedColumns.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/button.bootstrap4.css">

    <!-- datepicker css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery-ui.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/stylePage.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="sidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-text">Penilaian Kinerja Karyawan</div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item beranda">
                <a class="nav-link" href="<?= base_url(); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Penilaian
            </div>

            <!-- Nav Item & Pages Collapse Menu -->
            <li class="nav-item kriteria">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuKriteria"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-bars"></i>
                    <span>Kriteria</span>
                </a>
                <div id="menuKriteria" class="collapse" data-parent="#sidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Kriteria:</h6>
                        <a class="collapse-item" href="<?= base_url('kriteria'); ?>"><i class="fas fa-fw fa-bars"></i> Daftar Kriteria</a>
                        <a class="collapse-item" href="<?= base_url('sub_kriteria'); ?>"><i class="fas fa-fw fa-archive"></i> Daftar Sub Kriteria</a>
                    </div>
                </div>
            </li>

            <li class="nav-item karyawan">
                <a class="nav-link" href="<?= base_url('karyawan'); ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Karyawan</span>
                </a>
            </li>

            <li class="nav-item penilaian">
                <a class="nav-link" href="<?= base_url('penilaian'); ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Penilaian Karyawan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Laporan
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item laporan">
                <a class="nav-link" href="<?= base_url('hasil_penilaian'); ?>">
                    <i class="fas fa-fw fa-book-open"></i>
                    <span>Laporan Penilaian</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <h3 class="judul"><?= $judul; ?></h3>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small profile-name"><?= $this->session->userdata('ses_nama'); ?></span>
                                <img class="img-profile profile-image rounded-circle" src="assets/img/upload/<?= $this->session->userdata('ses_foto'); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item profile" href="<?= base_url('profile'); ?>" id="<?= $this->session->userdata('ses_nip'); ?>"> <i class="fas fa-cogs fa-sm fa-fw mr-2 text-dark-400"></i> Ubah Profile
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-dark-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->