<?php
// Session dimulai
session_start();
// menyertakan file koneksi.php
include('public/private/koneksi.php');

// cek apakah user sudah login atau belum, jika belum kembalian ke halaman login
if (!isset($_SESSION['login'])) {
    header("Location: public/login");
    exit;
}
if (!$_SESSION['admin']) {
    header("Location: indexUser");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Web Pengarsipan</title>
    <link rel="shortcut icon" href="public/assets/favicon.png" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
                <div class="sidebar-brand-icon">
                    <img src="public/assets/fosti.png" height="50" alt="Fosti Logo">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Nav Item - Tambah Dokumen -->
            <li class="nav-item active">
                <a class="nav-link" href="public/form">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Tambah Dokumen</span>
                </a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="public/private/logout">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Logout</span>
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


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <?php
                        // menghitung jumlah dokumen dari divisi ristek
                        $jumlah1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dokumen WHERE divisi = 'ristek'"));
                        // menghitung jumlah dokumen dari divisi webjar
                        $jumlah2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dokumen WHERE divisi = 'webjar'"));
                        // menghitung jumlah dokumen dari divisi keorganisasian
                        $jumlah3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dokumen WHERE divisi = 'keorganisasian'"));
                        // menghitung jumlah dokumen dari divisi hubpub
                        $jumlah4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dokumen WHERE divisi = 'hubpub'"));
                        // menghitung jumlah dokumen dari divisi surat masuk
                        $jumlah5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dokumen WHERE divisi = 'surat_masuk'"));
                        // menghitung jumlah dokumen dari template dokumen 
                        $jumlah6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM template"));
                        ?>
                        <!-- Webjar -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <a class="card-body" href="public/ristek_proposal" style="text-decoration: none;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">RISET DAN TEKNOLOGI</div><br>
                                            <!-- Menampilkan jumlah dokumen dalam variable $jumlah1 -->
                                            <p>
                                                <? echo "$jumlah1"; ?> Dokumen Tersimpan</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-laptop fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Ristek -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <a class="card-body" href="public/webjar_proposal" style="text-decoration: none;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">WEB DAN JARINGAN</div><br>
                                            <!-- Menampilkan jumlah dokumen dalam variable $jumlah2 -->
                                            <p>
                                                <? echo "$jumlah2"; ?> Dokumen Tersimpan</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Keorganisasian -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <a class="card-body" href="public/keor_proposal" style="text-decoration: none;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">KEORGANISASIAN</div><br>
                                            <!-- Menampilkan jumlah dokumen dalam variable $jumlah3 -->
                                            <p>
                                                <? echo "$jumlah3"; ?> Dokumen Tersimpan</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-puzzle-piece fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Hubungan Publik -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <a class="card-body" href="public/hubpub_proposal" style="text-decoration: none;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">HUBUNGAN DAN PUBLIK</div><br>
                                            <!-- Menampilkan jumlah dokumen dalam variable $jumlah4 -->
                                            <p>
                                                <? echo "$jumlah4"; ?> Dokumen Tersimpan</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-people-carry fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Surat masuk -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <a class="card-body" href="public/surat_masuk" style="text-decoration: none;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">SURAT MASUK FOSTI</div><br>
                                            <!-- Menampilkan jumlah dokumen dalam variable $jumlah5 -->
                                            <p>
                                                <? echo "$jumlah5"; ?> Dokumen Tersimpan</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Download Surat -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <a class="card-body" href="public/download_template" style="text-decoration: none;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">DOWNLOAD TEMPLATE DOKUMEN</div><br>
                                            <!-- Menampilkan jumlah dokumen dalam variable $jumlah5 -->
                                            <p>
                                                <? echo "$jumlah6"; ?> Dokumen Tersimpan</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Fosti UMS 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary fas fa-user fa-2x" href="public/private/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>