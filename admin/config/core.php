<?php 

error_reporting(0);

session_start();

if(isset($_SESSION['login']) == true){
	$id_karyawan	= $_SESSION['id_karyawan'];
	$username		= $_SESSION['username'];
	$nama_karyawan	= $_SESSION['nama_karyawan'];
	$role			= $_SESSION['role'];
}

include 'databases.php';
include 'controller.php';