<?php 

include 'config/core.php';

$id_karyawan = (int)$_GET['id_karyawan'];

if(hapus_karyawan($id_karyawan)){
	echo "<script>
	alert ('Data Berhasil Dihapus');
	document.location.href = 'karyawan.php';
	</script>";
}else{
	echo "<script>
	alert ('Data Gagal Dihapus');
	document.location.href = 'karyawan.php';
	</script>";
}