<?php 

include 'config/core.php';

$id_pelanggan = (int)$_GET['id_pelanggan'];

if(hapus_pelanggan($id_pelanggan)){
	echo "<script>
	alert ('Data Berhasil Dihapus');
	document.location.href = 'pelanggan.php';
	</script>
	";
}else{
	echo "<script>
	alert ('Data Gagal Dihapus');
	document.location.href = 'pelanggan.php';
	</script>
	";
}
