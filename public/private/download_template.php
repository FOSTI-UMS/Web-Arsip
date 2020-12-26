<?php 
	session_start();
	// cek apakah user sudah login atau belum, jika belum kembalian ke halaman login
    if (!isset($_SESSION['login'])) {
        header("Location: ../login.php");
        exit;
    } 
	include('koneksi.php');
	
	$id = $_GET['id'];
	$query = mysqli_query($conn, "SELECT file FROM template WHERE id_template = '$id'");
	while ($data = mysqli_fetch_array($query)) {
		$filename = $data['file'];
	}
	if (isset($_GET['id'])) {

		$back_dir = "../../dokumen/template";
		$file = $back_dir.'/'.$filename;

		if (file_exists($file)) {
			header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: private');
            header('Pragma: private');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            
            exit;
		}else {
            echo "Gagal $file <br> ";
        }
	}
 ?>