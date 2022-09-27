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

$title = "Edit Data Transaksi";
include 'layout/header.php';

$id_transaksi = (int)$_GET['id_transaksi'];

$pelanggan = query("SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
$paket_laundry = query("SELECT * FROM paket_laundry ORDER BY id_paket DESC");
$tipe_pembayaran = query("SELECT * FROM tipe_pembayaran ORDER BY id_tipe DESC");

$transaksi = query("SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi")[0];


if(isset($_POST['ubah'])){
	if(ubah_transaksi($_POST) > 0){
		echo "<script>
		alert('Data Berhasil Diperbaharui');
		document.location.href = 'transaksi.php';
		</script>
		";
	}else{
		echo "<script>
		alert('Data Gagal Diperbaharui');
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
								<input type="hidden" name="id_transaksi" value="<?php echo $transaksi['id_transaksi']; ?>">
								<input type="hidden" name="id_paket" value="<?php echo $transaksi['id_paket']; ?>">
								<input type="hidden" name="id_pelanggan" value="<?php echo $transaksi['id_pelanggan']; ?>">
								<input type="hidden" name="id_tipe" value="<?php echo $transaksi['id_tipe']; ?>">

								<div class="row">	
									<div class="form-group col-sm-6">
										<label for="no_order">No.Order</label>
										<input type="text" name="no_order" id="no_order" class="form-control" value="<?php echo $transaksi['no_order'] ?>">
									</div>

									<div class="form-group col-sm-6">
										<label for="id_pelanggan">Nama Pelanggan</label>
										<select class="form-control" name="id_pelanggan" id="id_pelanggan">
											<?php foreach ( $pelanggan as $data ) : ?>
												<?php if ($transaksi['id_pelanggan'] == $data['id_pelanggan']): ?>
													<option value="<?php echo $data['id_pelanggan'] ?>" selected><?php echo $data['nama']; ?></option>
													<?php else : ?>
														<option value="<?php echo $data['id_pelanggan'] ?>"><?php echo $data['nama']; ?></option>
													<?php endif; ?>
												<?php endforeach ?>
											</select>
										</div>
									</div>

									

									<div class="row">
										<div class="form-group col-sm-6">
											<label for="id_paket">Paket</label>
											<select class="form-control" name="id_paket" id="id_paket">
												<?php foreach ( $paket_laundry as $data ) : ?>
													<?php if ($transaksi['id_paket'] == $data['id_paket']): ?>
														<option value="<?php echo $data['id_paket'] ?>" selected><?php echo $data['jenis_paket']; ?></option>
														<?php else : ?>
															<option value="<?php echo $data['id_paket'] ?>"><?php echo $data['jenis_paket']; ?></option>
														<?php endif; ?>
													<?php endforeach ?>
												</select>
											</div>

											<div class="form-group col-sm-6">
												<label for="id_tipe">Tipe Pembayaran</label>
												<select class="form-control" name="id_tipe" id="id_tipe">
													<?php foreach ( $tipe_pembayaran as $data ) : ?>
														<?php if ($transaksi['id_tipe'] == $data['id_tipe']): ?>
															<option value="<?php echo $data['id_tipe'] ?>" selected><?php echo $data['nama_pembayaran']; ?></option>
															<?php else : ?>
																<option value="<?php echo $data['id_tipe'] ?>"><?php echo $data['nama_pembayaran']; ?></option>
															<?php endif; ?>
														<?php endforeach ?>
													</select>
												</div>
											</div>

											<div class="row">
												<div class="form-group col-sm-6">
													<label for="berat">Berat (Kg)</label>
													<input type="text" name="berat" id="berat" class="form-control" placeholder="Masukkan Berat Laundry" value="<?php echo $transaksi['berat'] ?>">
												</div>

												<div class="form-group col-sm-6">
													<label for="tgl_ambil">Tgl. Ambil</label>
													<input type="datetime" name="tgl_ambil" id="tgl_ambil" class="form-control" value="<?php echo $transaksi['tgl_ambil']?>" >
												</div>
											</div>

											<div class="row">
												<div class="form-group col-sm-6">
													<label for="sts_pembayaran">Status Pembayaran</label>
													<select name="sts_pembayaran" id="sts_pembayaran" class="form-control">
														<?php  $sts_pembayaran = $transaksi['sts_pembayaran'];?>
														<option value="1" <?php echo $sts_pembayaran ? 'selected' : null ?>>Belum Lunas</option>
														<option value="2" <?php echo $sts_pembayaran ? 'selected' : null ?>>Lunas</option>
													</select>
												</div>

												<div class="form-group col-sm-6">
													<label for="sts_order">Status Order</label>
													<select name="sts_order" id="sts_order" class="form-control">
														<?php $order = $transaksi['sts_order']; ?>
														<option value="1" <?php echo $order ? 'selected' : null?>>Baru</option>
														<option value="2"<?php echo $order ? 'selected' : null ?>>Diambil</option>
													</select>
												</div>
											</div>

											<div class="float-right">
												<button class="btn btn-primary" type="submit" name="ubah">Ubah</button>
												<a href="transaksi.php" class="btn btn-secondary">Kembali</a>
											</div>


										</form>
									</div>
								</div>
							</div>
							<!-- /# column -->
						</div>


						<?php include 'layout/footer.php'; ?>