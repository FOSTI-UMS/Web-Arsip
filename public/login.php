<?php
// session dimulai
session_start();
// cek apabila $_SESSION bernilai true, arahkan ke file index.php
if (isset($_SESSION['login'])) {
    header("Location: ../");
    exit;
}
// koneksi ke dalam database pengarsipan
include('private/koneksi.php');

// ketika tombol login di klik maka jalankan kode berikut
if (isset($_POST['login'])) {
    $user = mysqli_escape_string($conn, $_POST['username']);
    $pass = mysqli_escape_string($conn, $_POST['password']);
    // buat query untuk mengambil data dari tabel user dimana username = $user
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");

    // cek username kemudian memasukkan nilai dari dalam database yang didimpan di dalam $query ke dalam variable $data
    if (mysqli_num_rows($query) == 1) {
        $data = mysqli_fetch_array($query);

        // cek password , apakah $pass = $data dengan index password
        // kode di bawah ini digunakan untuk membuat multiuser antara admin dengan sekdiv (user biasa)
        // $_SESSION adalah super global variable yang dapat di akses di file lain
        if ($pass == $data['password']) {
            $_SESSION['login'] = true;

            // jika $data indeks ['level'] == admin maka bikin variable $_S
            if ($data['level'] == 'admin') {
                $_SESSION['admin'] = true;
                header("Location: ../index");
                exit;
            } elseif ($data['level'] == 'user') {
                $_SESSION['admin'] = false;
                header("Location: ../indexUser");
                exit;
            } else {
                header('Location: login.php?pesan=gagal');
            }
        }
    }
    $error = true;
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags-->

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
                    <center><img src="assets/fosti.png" height="100" alt="Fosti Logo"></center>
                    <!-- <center>
                        <h2 class="title">LOGIN</h2>
                    </center> -->
                    <form method="POST" action="">
                        <div class="row row-space">
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label"> </label>
                                    <input class="input--style-5" type="text" name="username" placeholder="username">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label"> </label>
                                    <input class="input--style-5" type="password" name="password" placeholder="password">
                                </div>
                            </div>
                            <?php if (isset($error)) : ?>
                                <div class="col-3">
                                    <center>
                                        <p style="color: #ff3131">Username dan password anda salah</p>
                                    </center>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-t-15">
                            <center><button class="btn btn--radius-2 btn--blue" type="submit" name="login">Login</button></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>