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

$title = "Data Transaksi";
include 'layout/header.php';

$transaksi = query("SELECT * FROM transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN paket_laundry ON transaksi.id_paket = paket_laundry.id_paket ORDER BY id_transaksi DESC");

// INNER JOIN bidang 
// ON pegawai.id_bidang = bidang.id_bidang WHERE id_pegawai = '$id_pegawai'



?>


<div class="content-wrap">
	<div class="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-8 p-r-0 title-margin-right">
					<div class="page-header">
						<div class="page-title">
							<h1>Selamat Datang, <span>di Aplikasi Laundry Online</span></h1>
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
							<h5>Data Transaksi</h5>

						</div>
						<div class="card-body">
							<div class="table-responsive">
								<a href="tambah-transaksi.php" class="btn btn-primary btn-sm mb-1"><i class="ti-plus"></i> Tambah</a>

								<table id="example" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Tgl. Transaksi</th>
											<th>Pembayaran</th>
											<th>Customer</th>
											<th>Paket</th>
											<th>Status Order</th>
											<th>Total</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no= 1; ?>
										<?php foreach ( $transaksi as $data ) : ?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $data['tgl_transaksi']; ?></td>
												<td>
													<?php if ($data['sts_pembayaran'] == 1): ?>
														<span class="badge badge-info">Belum Lunas</span>
														<?php elseif ($data['sts_pembayaran'] == 2): ?>
															<span class="badge badge-success">Lunas</span>
														<?php endif ?>
													</td>
													<td><?php echo $data['nama']; ?></td>
													<td><?php echo $data['jenis_paket']; ?></td>
													<td>
														<?php if ($data['sts_order'] == 1): ?>
															<span class="badge badge-info">Baru</span>
															<?php elseif ($data['sts_order'] == 2): ?>
																<span class="badge badge-success">Diambil</span>
															<?php endif ?>
														</td>
														<td>Rp. <?php echo number_format($data['harga'] * $data['berat'] , 0, '.', '.'); ?></td>
														<td>
															<a href="detail-transaksi.php?id_transaksi=<?php echo $data['id_transaksi'] ?>" class="btn btn-sm btn-secondary">Detail</a>
															<a href="ubah-transaksi.php?id_transaksi=<?php echo $data['id_transaksi'] ?>" class="btn btn-sm btn-success">Edit</a>
															<a href="cetak.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn btn-sm btn-warning">Cetak</a>
														</td>
													</tr>


												<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- /# column -->
					</div>


					<?php include 'layout/footer.php'; ?>