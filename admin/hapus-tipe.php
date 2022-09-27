<?php 

include 'config/core.php';

$id_tipe = (int)$_GET['id_tipe'];

if(hapus_tipe($id_tipe)){
	echo "<script>
	alert ('Data berhasil dihapus');
	document.location.href = 'pembayaran.php';
	</script>
	";
}else{
	echo "<script>
	alert ('Data gagal dihapus');
	document.location.href = 'pembayaran.php';
	</script>
	";
}