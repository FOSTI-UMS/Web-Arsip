 <?php
    // session dimulai
    session_start();
    // menyertakan file koneksi.php
    include('private/koneksi.php');
    // cek apakah user sudah login atau belum, jika belum kembalian ke halaman login 
    if (!isset($_SESSION['admin'])) {
        header("Location: login");
        // exit artinya file yang dibawahnya tidak dieksekusi
        exit;
    }
    if (!$_SESSION['admin']) {
        header("Location: ../indexUser");
        exit;
    }

    // mengambil niali id dari id yang ada di halaman yang filenya ingin di edit 
    $id = $_GET['id'];
    // mengambil data dari tabel dokumen yang id = niali $id
    $sql = "SELECT * FROM dokumen WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_array($query)) {
        $nama = $data['nama'];
        $nomer = $data['nomer'];
        $tanggal = $data['tanggal'];
        $jenis = $data['jenis'];
        $divisi = $data['divisi'];
        $file = $data['file'];
        $id = $data['id'];
    }
    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <!-- Required meta tags-->
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="Pengarsipan FOSTI">
     <meta name="author" content="">
     <meta name="keywords" content="Pengarsipan FOSTI">

     <!-- Title Page-->
     <title>Edit Dokumen</title>
     <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">

     <!-- Icons font CSS-->
     <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
     <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
     <!-- Font special for pages-->
     <link href="../https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

     <!-- Vendor CSS-->
     <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
     <link href="../vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

     <!-- Main CSS-->
     <link href="../css/main.css" rel="stylesheet" media="all">
 </head>

 <body>
     <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
         <div class="wrapper wrapper--w680">
             <div class="card card-4">
                 <div class="card-body">
                     <h2 class="title">
                         <center>Edit Dokumen</center>
                     </h2>
                     <form method="POST" action="" enctype="multipart/form-data">
                         <div class="row row-space">
                             <div class="col-2">
                                 <div class="input-group">
                                     <label class="label">Nama Dokumen</label>
                                     <input class="input--style-4" type="text" name="nama_dokumen" value="<? echo $nama;?>">
                                 </div>
                             </div>
                             <div class="col-2">
                                 <div class="input-group">
                                     <label class="label">Nomer Dokumen</label>
                                     <input class="input--style-4" type="text" name="nomer_dokumen" value="<? echo $nomer;?>">
                                 </div>
                             </div>
                         </div>
                         <div class="row row-space">
                             <div class="col-2">
                                 <div class="input-group">
                                     <label class="label">Tanggal Dokumen</label>
                                     <div class="input-group-icon">
                                         <input class="input--style-4 js-datepicker" type="text" name="tgl_dokumen" placeholder="<? echo ($tanggal);?>">
                                         <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                     </div>
                                 </div>
                             </div>
                             <!-- <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Pilih Dokumen</label>
                                    <input type="file" name="file_dokumen">
                                </div>
                            </div> -->
                         </div>
                         <div class="input-group">
                             <label class="label">Jenis Dokumen</label>
                             <div class="rs-select2 js-select-simple select--no-search">
                                 <select name="jenis" required>
                                     <option value="">--Pilih--</option>
                                     <option value="proposal">Proposal</option>
                                     <option value="lpj">LPJ</option>
                                     <option value="berita_acara">Berita Acara</option>
                                     <option value="surat_keluar">Surat Keluar</option>
                                     <option value="surat_masuk">Surat Masuk</option>
                                 </select>
                                 <div class="select-dropdown"></div>
                             </div>
                         </div>
                         <div class="input-group">
                             <label class="label">Divisi</label>
                             <div class="rs-select2 js-select-simple select--no-search">
                                 <select name="divisi" required>
                                     <option value="">--Pilih--</option>
                                     <option value="ristek">Keilmuan Riset dan Teknologi</option>
                                     <option value="webjar">Web dan Jaringan </option>
                                     <option value="keorganisasian">Keorganisasian</option>
                                     <option value="hubpub">Hubungan Publik</option>
                                     <option value="surat_masuk">Surat Masuk</option>
                                 </select>
                                 <div class="select-dropdown"></div>
                             </div>
                         </div>
                         <div class="p-t-15">
                             <center><button class="btn btn--radius-2 btn--blue" type="submit" name="submit">Masukkan</button>
                                 <a class="btn btn--radius btn--red" href="../index">Batal</a></center>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>

     <!-- Jquery JS-->
     <script src="../vendor/jquery/jquery.min.js"></script>
     <!-- Vendor JS-->
     <script src="../vendor/select2/select2.min.js"></script>
     <script src="../vendor/datepicker/moment.min.js"></script>
     <script src="../vendor/datepicker/daterangepicker.js"></script>

     <!-- Main JS-->
     <script src="../js/global.js"></script>

 </body>

 </html>
 <!-- end document-->
 <?php
    // ketika tombol submit di klik 
    if (isset($_POST['submit'])) {
        // memasukkan data dari form kr dalam variable berikut
        $nama = mysqli_escape_string($conn, $_POST['nama_dokumen']);
        $nomer = mysqli_escape_string($conn, $_POST['nomer_dokumen']);
        $tanggal = mysqli_escape_string($conn, $_POST['tgl_dokumen']);
        $tanggal = mysqli_escape_string($conn, date('Y-m-d', strtotime($tanggal)));
        $divisi = mysqli_escape_string($conn, $_POST['divisi']);
        $jenis = mysqli_escape_string($conn, $_POST['jenis']);

        // menjalankan query untuk memasukkan data
        $sql = "UPDATE dokumen SET nama='$nama', tanggal='$tanggal', divisi='$divisi', jenis='$jenis', nomer='$nomer' WHERE id = '$id' ";
        // mengeksekuis query
        $query = mysqli_query($conn, $sql);

        // mengarahkan ke halaman index
        echo "<script>
                 alert('Berhasil ditambahkan');
                 document.location.href='../index';
             </script>";
    }
    ?>