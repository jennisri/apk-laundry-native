<?php 

include 'config/core.php';

$id_paket = (int)$_GET['id_paket'];

if(hapus_paket($id_paket)){
	echo "<script>
	alert ('Data Berhasil Dihapus');
	document.location.href = 'paketlaundry.php';
	</script>
	";
}else{
	echo "<script>
	alert ('Data Gagal Dihapus');
	document.location.href = 'paketlaundry.php';
	</script>
	";
}