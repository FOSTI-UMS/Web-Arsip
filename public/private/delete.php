<?php
	session_start(); 
	include('koneksi.php');
	// cek apakah user sudah login atau belum, jika belum kembalian ke halaman login
    if (!isset($_SESSION['admin']) ) {
        header("Location: ../login.php");
        exit;
    } 

	$id = $_GET['id'];
	

	$hapus = mysqli_query($conn, "DELETE FROM dokumen WHERE id = '$id'");
	header('Location: ../../index.php');

 ?>