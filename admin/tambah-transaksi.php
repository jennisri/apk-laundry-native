<?php 

session_start();

//check login jika gagal lempar kembali ke login.php
if(!isset($_SESSION["login"])){
	echo "<script>
	alert ('ANDA HARUS LOGIN DULU');
	document.location.href ='login.php';
	</script>";
	exit;

} 

$title = "Tambah Data Transaksi";
include 'layout/header.php';

$pelanggan = query("SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
$paket_laundry = query("SELECT * FROM paket_laundry ORDER BY id_paket DESC");
$tipe_pembayaran = query("SELECT * FROM tipe_pembayaran ORDER BY id_tipe DESC");

$transaksi = query("SELECT * FROM pelanggan ORDER BY id_pelanggan DESC LIMIT 0, 1");

if(isset($_POST['tambah'])){
	if(tambah_transaksi($_POST) > 0){
		echo "<script>
		alert('Data Berhasil Ditambahkan');
		document.location.href = 'transaksi.php';
		</script>
		";
	}else{
		echo "<script>
		alert('Data Gagal Ditambahkan');
		document.location.href = 'transaksi.php';
		</script>
		";
	}
}



?>


<div class="content-wrap">
	<div class="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-8 p-r-0 title-margin-right">
					<div class="page-header">
						<div class="page-title">

						</div>
					</div>
				</div>
				<!-- /# column -->
				<div class="col-lg-4 p-l-0 title-margin-left">
					<div class="page-header">
						<div class="page-title">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
								<li class="breadcrumb-item active">Transaksi</li>
							</ol>
						</div>
					</div>
				</div>
				<!-- /# column -->
			</div>
			<!-- /# row -->
			<section id="main-content">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h5>Tambah Data Transaksi</h5>

						</div>
						<div class="card-body">
							<form action="" method="post">
								<div class="row">
									<div class="form-group col-sm-6">
										<label for="no_order">No.Order</label>
										<input type="text" name="no_order" id="no_order" class="form-control" value="">
									</div>

									<div class="form-group col-sm-6">
										<label for="id_pelanggan">Nama Pelanggan</label>
										<select class="form-control" name="id_pelanggan" id="id_pelanggan">
											<option value="">--Pilih--</option>
											<?php foreach ( $pelanggan as $data ) : ?>
												<option value="<?php echo $data['id_pelanggan'] ?>"><?php echo $data['nama']; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="form-group col-sm-6">
										<label for="id_paket">Paket</label>
										<select class="form-control" name="id_paket" id="id_paket">
											<option value="">--Pilih--</option>
											<?php foreach ( $paket_laundry as $data ) : ?>
												<option value="<?php echo $data['id_paket'] ?>"><?php echo $data['jenis_paket']; ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="form-group col-sm-6">
										<label for="id_tipe">Paket</label>
										<select class="form-control" name="id_tipe" id="id_tipe">
											<option value="">--Pilih--</option>
											<?php foreach ( $tipe_pembayaran as $data ) : ?>
												<option value="<?php echo $data['id_tipe'] ?>"><?php echo $data['nama_pembayaran']; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="form-group col-sm-6">
										<label for="berat">Berat (Kg)</label>
										<input type="text" name="berat" id="berat" class="form-control" placeholder="Masukkan Berat Laundry">
									</div>

									<div class="form-group col-sm-6">
										<label for="tgl_ambil">Tgl. Ambil</label>
										<input type="date" name="tgl_ambil" id="tgl_ambil" class="form-control" >
									</div>
								</div>

								<div class="row">
									<div class="form-group col-sm-6">
										<label for="sts_pembayaran">Status Pembayaran</label>
										<select name="sts_pembayaran" id="sts_pembayaran" class="form-control">
											<option value="">--Pilih</option>
											<option value="1">Belum Lunas</option>
											<option value="2">Lunas</option>
										</select>
									</div>

									<div class="form-group col-sm-6">
										<label for="sts_order">Status Order</label>
										<select name="sts_order" id="sts_order" class="form-control">
											<option value="">--Pilih</option>
											<option value="1">Baru</option>
											<option value="2">Diambil</option>
										</select>
									</div>
								</div>

								<div class="float-right">
									<button class="btn btn-primary" type="submit" name="tambah">Tambah</button>
									<a href="transaksi.php" class="btn btn-secondary">Kembali</a>
								</div>


							</form>
						</div>
					</div>
				</div>
				<!-- /# column -->
			</div>


			<?php include 'layout/footer.php'; ?>