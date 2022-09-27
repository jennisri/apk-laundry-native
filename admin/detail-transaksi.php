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

$id_transaksi = (int)$_GET['id_transaksi'];
$transaksi = query("SELECT * FROM transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN paket_laundry ON transaksi.id_paket = paket_laundry.id_paket INNER JOIN tipe_pembayaran ON transaksi.id_tipe = tipe_pembayaran.id_tipe WHERE id_transaksi = $id_transaksi")[0];

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
							<h5>Detal Data Transaksi</h5>

						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<th class="table-primary">No.Order</th>
										<td><?php echo $transaksi['no_order'] ?></td>
									</tr>

									<tr>
										<th class="table-primary">Nama Customer</th>
										<td><?php echo $transaksi['nama'] ?></td>
									</tr>

									<tr>
										<th class="table-primary">Alamat</th>
										<td><?php echo $transaksi['alamat'] ?></td>
									</tr>

									<tr>
										<th class="table-primary">Nomor Telepon</th>
										<td><?php echo $transaksi['telepon'] ?></td>
									</tr>

									<tr>
										<th class="table-primary">Jenis Kelamin</th>
										<td><?php echo $transaksi['jenis_kelamin'] ?></td>
									</tr>

									<tr>
										<th class="table-primary">Tanggal Transaksi</th>
										<td><?php echo $transaksi['tgl_transaksi'] ?></td>
									</tr>

									<tr>
										<th class="table-primary">Tanggal Ambil</th>
										<td><?php echo $transaksi['tgl_ambil'] ?></td>
									</tr>

									<tr>
										<th class="table-primary">Status Pembayaran</th>
										<?php if ($transaksi['sts_pembayaran'] == 1): ?>
											<td>Belum Lunas</td>
											<?php elseif($transaksi['sts_pembayaran'] == 2) : ?>
												<td>Lunas</td>
											<?php endif ?>
										</tr>

										<tr>
											<th class="table-primary">Status Order</th>
											<?php if ($transaksi['sts_order'] == 1): ?>
												<td>Baru</td>
												<?php elseif($transaksi['sts_order'] == 2) : ?>
													<td>Diambil</td>
												<?php endif ?>
											</tr>
										</table>
									</div>
								</div>

								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr class="table-primary" >
												<th>No</th>
												<th>Tanggal Order</th>
												<th>Paket Laundry</th>
												<th>Berat Cucian</th>
												<th>Harga/Kg</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1 ?>
											<td><?php echo $no++ ?></td>
											<td><?php echo $transaksi['tgl_transaksi']?></td>
											<td><?php echo $transaksi['jenis_paket']; ?></td>
											<td><?php echo $transaksi['berat']; ?> Kg</td>
											<td>Rp. <?php echo number_format($transaksi['harga'], 0, '.', '.') ?></td>
											<td>Rp. <?php echo number_format($transaksi['harga'] * $transaksi['berat'] , 0, '.', '.'); ?></td>

										</tbody>
										
									</table>
								</div>

								<div class="float-left mt-5">
									<a href="transaksi.php" class="btn btn-secondary">Kembali</a>
								</div>



							</div>
							<!-- /# column -->
						</div>


						<?php include 'layout/footer.php'; ?>