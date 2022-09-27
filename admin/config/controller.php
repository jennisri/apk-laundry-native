<?php 

function query ($query){
	global $db;

	$result = mysqli_query($db, $query);
	$row = [];

	while ($rows = mysqli_fetch_assoc($result)){
		$row[]=$rows;
	}return $row;
}

// ----------------------------------------------------------------------------------------------------------------------------------

function tambah_tipe($post){
	global $db;

	$nama_pembayaran = strip_tags($post['nama_pembayaran']);

	$query = "INSERT INTO tipe_pembayaran VALUES ('', '$nama_pembayaran')";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

function hapus_tipe ($id_tipe){
	global $db;

	$query = "DELETE FROM tipe_pembayaran WHERE id_tipe = $id_tipe";
	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

function ubah_tipe($post){
	global $db;

	$id_tipe = $post['id_tipe'];
	$nama_pembayaran = strip_tags($post['nama_pembayaran']);

	$query = "UPDATE tipe_pembayaran SET
	nama_pembayaran = '$nama_pembayaran' WHERE id_tipe = $id_tipe
	";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// ----------------------------------------------------------------------------------------------------------------------------------

function tambah_pelanggan ($post){
	global $db;

	$nama = strip_tags($post['nama']);
	$alamat = strip_tags($post['alamat']);
	$telepon = strip_tags($post['telepon']);
	$jenis_kelamin = strip_tags($post['jenis_kelamin']);

	$query = "INSERT INTO pelanggan VALUES ('', '$nama', '$alamat', '$telepon', '$jenis_kelamin')";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

function hapus_pelanggan ($id_pelanggan){
	global $db;

	$query = "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

function ubah_pelanggan ($post){
	global $db;

	$id_pelanggan 	= $post['id_pelanggan'];
	$nama 			= strip_tags($post['nama']);
	$alamat 		= strip_tags($post['alamat']);
	$telepon 		= strip_tags($post['telepon']);
	$jenis_kelamin 	= strip_tags($post['jenis_kelamin']);

	$query = "UPDATE pelanggan SET
	nama = '$nama',
	alamat = '$alamat',
	telepon = '$telepon',
	jenis_kelamin = '$jenis_kelamin' WHERE id_pelanggan = $id_pelanggan
	";

	mysqli_query($db,$query);

	return mysqli_affected_rows($db);
}
// ----------------------------------------------------------------------------------------------------------------------------------

function tambah_paket($post){
	global $db;

	$jenis_paket	= strip_tags($post['jenis_paket']);
	$harga			= strip_tags($post['harga']);

	$query = "INSERT INTO paket_laundry VALUES ('', '$jenis_paket', '$harga')";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

function hapus_paket ($id_paket){
	global $db;

	$query = "DELETE FROM paket_laundry WHERE id_paket = $id_paket";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

function ubah_paket ($post){
	global $db;

	$id_paket	= $post['id_paket'];
	$jenis_paket = strip_tags($post['jenis_paket']);
	$harga = strip_tags($post['harga']);

	$query = "UPDATE paket_laundry SET 
	jenis_paket = '$jenis_paket', 
	harga = '$harga' WHERE id_paket = $id_paket
	";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}
// ----------------------------------------------------------------------------------------------------------------------------------

function tambah_karyawan($post){
	global $db;

	$nama_karyawan	= strip_tags($post['nama_karyawan']);
	$username		= strtolower(strip_tags($post['username']));
	$password		= strip_tags($post['password']);
	$alamat_karyawan= strip_tags($post['alamat_karyawan']);
	$nohp			= strip_tags($post['nohp']);
	$gender			= strip_tags($post['gender']);
	$role			= strip_tags($post['role']);

	// enkripsi password ke database
	$password = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO karyawan VALUES 
	('','$nama_karyawan','$username','$password', '$alamat_karyawan', '$nohp', '$gender', '$role');
	";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);

}

function ubah_karyawan($post){
	global $db;

	$id_karyawan 	= $post['id_karyawan'];
	$nama_karyawan 	= strip_tags($post['nama_karyawan']);
	$username 		= strtolower(strip_tags($post['username']));
	$password 		= strip_tags($post['password']);
	$alamat_karyawan= strip_tags($post['alamat_karyawan']);
	$nohp 			= strip_tags($post['nohp']);
	$gender 		= strip_tags($post['gender']);
	$role			= strip_tags($post['role']);

	$password = password_hash($password, PASSWORD_DEFAULT);

	$query = "UPDATE karyawan SET 
	nama_karyawan = '$nama_karyawan',
	username 		= '$username',
	password 		= '$password',
	alamat_karyawan = '$alamat_karyawan',
	nohp 			= '$nohp',
	gender 			= '$gender',
	role 			= '$role' WHERE id_karyawan = $id_karyawan
	";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);

}

function hapus_karyawan($id_karyawan){
	global $db;

	$query = "DELETE FROM karyawan WHERE id_karyawan = $id_karyawan";

	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}
// ----------------------------------------------------------------------------------------------------------------------------------

function tambah_transaksi($post){
	global $db;

	$no_order = strip_tags($post['no_order']);
	$id_pelanggan = strip_tags($post['id_pelanggan']);
	$id_paket = strip_tags($post['id_paket']);
	$id_tipe = strip_tags($post['id_tipe']);
	$berat = strip_tags($post['berat']);
	$tgl_ambil = strip_tags($post['tgl_ambil']);
	$sts_pembayaran = strip_tags($post['sts_pembayaran']);
	$sts_order = strip_tags($post['sts_order']);

	$query = "INSERT INTO transaksi VALUES
	('','$no_order', '$id_pelanggan', '$id_paket', '$id_tipe', '$berat', '$tgl_ambil', CURRENT_TIMESTAMP, '$sts_pembayaran', '$sts_order')
	";

	mysqli_query($db, $query);
	return mysqli_affected_rows($db);


}

function ubah_transaksi($post){
	global $db;

	$id_transaksi = $post['id_transaksi'];
	$no_order = strip_tags($post['no_order']);
	$id_pelanggan = strip_tags($post['id_pelanggan']);
	$id_paket = strip_tags($post['id_paket']);
	$id_tipe = strip_tags($post['id_tipe']);
	$berat = strip_tags($post['berat']);
	$tgl_ambil = strip_tags($post['tgl_ambil']);
	$sts_pembayaran = strip_tags($post['sts_pembayaran']);
	$sts_order = strip_tags($post['sts_order']);

	$query = "UPDATE transaksi SET 
	no_order = '$no_order',
	id_pelanggan = '$id_pelanggan', 
	id_paket = '$id_paket',
	id_tipe = '$id_tipe', 
	berat = '$berat',
	tgl_ambil = '$tgl_ambil',
	sts_pembayaran ='$sts_pembayaran', 
	sts_order = '$sts_order' WHERE id_transaksi = $id_transaksi
	";

	mysqli_query($db, $query);
	return mysqli_affected_rows($db);

}