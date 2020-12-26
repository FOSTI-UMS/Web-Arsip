<?php
// session dimuali
session_start();
// menyertakan file koneksi
include('private/koneksi.php');
// cek apakah user sudah login atau belum, jika belum kembalian ke halaman login
if (!isset($_SESSION['admin'])) {
    header("Location: login");
    // exit artinya code yang ada dibawahnya tidak dieksekusi
    exit;
}
if (!$_SESSION['admin']) {
    header("Location: ../indexUser");
    exit;
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
    <title>Web | Pengarsipan FOSTI</title>
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
                        <center>Masukkan Template Dokumen</center>
                    </h2>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nama Dokumen</label>
                                    <input class="input--style-4" type="text" name="nama_dokumen" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Tanggal Dokumen</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="tgl_dokumen" required>
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Pilih Dokumen</label>
                                    <input type="file" name="file_dokumen">
                                    <p style="color: #fd3d3d">Format (.docx/ .pdf/ .xlsx)</p>
                                </div>
                            </div>
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
    // memasukkan data dari form ke dalam variable berikut, kemudian variable di amankan menggunakan fungsi mysqli_escape_string 
    $nama = mysqli_escape_string($conn, $_POST['nama_dokumen']);
    $tanggal = mysqli_escape_string($conn, $_POST['tgl_dokumen']);
    $tanggal = mysqli_escape_string($conn, date('Y-m-d', strtotime($tanggal)));
    $jenis = mysqli_escape_string($conn, $_POST['jenis']);

    // buat fungsi namanya upload untuk upload file
    function upload()
    {
        // memasukkan data file yang di upload ke dalam variable
        $namaFile = $_FILES['file_dokumen']['name'];
        $ukuranFile = $_FILES['file_dokumen']['size'];
        $error = $_FILES['file_dokumen']['error'];
        $tmpName = $_FILES['file_dokumen']['tmp_name'];

        // Cek apakah ada gambar yang di upload atau tidak
        if ($error == 4) {
            echo "<script>
                    alert('Upload file terlebih dahulu !');
                </script>";
            return exit;
        }
        // end cek apakah ada gambar yang diupload atau tidak

        // cek apakah yang diupload adalah dokumen
        $ekstensiGambarValid = ['docx', 'pdf', 'xlsx'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        // cek apakah ekstensi file yang di upload ada atau tiddak di $ekstensiGambarValid 
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('Yang anda upload tidak sesuai Bung !');
                </script>";
            return exit;
        }
        // end cek ekstensi file

        // cek ukuran file apakan terlalu besar atau tidak
        if ($ukuranFile > 10000000) {
            echo "<script>
                    alert('Ukuran file terlalu besar !');
                </script>";
            return exit;
        }
        // end cek ukuran file terlalu besar atau tidak

        // jika lolos pengecekan, file di upload ke direktori
        global $nomer;
        move_uploaded_file($tmpName, '../dokumen/template' . '/' . $namaFile);
        // mengembalikan nilai dari variable $namaFile untuk menjadi nilai dari fungsi upload()
        return $namaFile;
    }
    // end fungsi upload()


    // mengisi variable $file dengan nilai dari fungsi upload()
    $file = upload();

    // menjalankan query untuk memasukkan data
    $sql = "INSERT INTO template(id_template,nama,tanggal,jenis,file) VALUES ('','$nama','$tanggal','$jenis','$file')";
    $query = mysqli_query($conn, $sql);

    // alert ketika data berhasil ditambahkan
    echo "<script>
                 alert('Berhasil ditambahkan');
                 document.location.href='../index';
             </script>";
}
// end ketika tombol submit di klik
?>