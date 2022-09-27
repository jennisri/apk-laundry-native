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

$title = "Data Jenis Paket Laundry";
include "layout/header.php";

$paket_laundry = query("SELECT * FROM paket_laundry ORDER BY id_paket DESC");

if(isset($_POST['tambah'])){
	if(tambah_paket($_POST) > 0){
		echo "<script>
		alert ('Data Berhasil Ditambahkan');
		document.location.href = 'paketlaundry.php';
		</script>
		";
	}else{
		echo "<script>
		alert ('Data Gagal Ditambahkan');
		document.location.href = 'paketlaundry.php';
		</script>
		";
	}
}

if(isset($_POST['ubah'])){
	if(ubah_paket($_POST) > 0){
		echo "<script>
		alert ('Data Berhasil Diperbaharui');
		document.location.href = 'paketlaundry.php';
		</script>
		";
	}else{
		echo "<script>
		alert ('Data Gagal Diperbaharui');
		document.location.href = 'paketlaundry.php';
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
								<li class="breadcrumb-item active">Paket Laundry</li>
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
							<h5>Data Paket Laundry</h5>

						</div>
						<div class="card-body">
							<div class="table-responsive">
								<button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#modalTambah"><i class="ti-plus"></i> Tambah</button>

								<table id="example" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Jenis Paket</th>
											<th>Harga/Kg</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1 ?>
										<?php foreach ( $paket_laundry as $data ) : ?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $data['jenis_paket']; ?></td>
												<td>Rp. <?php echo number_format($data['harga'], 0, '.', '.'); ?></td>
												<td>
													<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalUbah<?php echo $data['id_paket'];?>">Edit</button>
													<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_paket'];?>">Hapus</button>
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

			<!-- Modal Tambah-->
			<div class="modal fade" id="modalTambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Tambah Jenis Paket</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<div class="form-group">
									<label for="jenis_paket">Jenis Paket</label>
									<input type="text" class="form-control" id="jenis_paket" name="jenis_paket">
								</div>

								<div class="form-group">
									<label for="harga">Harga/Kg</label>
									<input type="number" class="form-control" id="harga" name="harga">
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal Hapus-->
			<?php foreach ( $paket_laundry as $data ) : ?>
				<div class="modal fade" id="modalHapus<?php echo $data['id_paket'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-danger">
								<h5 class="modal-title text-white" id="staticBackdropLabel">Hapus Jenis Paket</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Apakah yakin paket dengan nama <?php echo $data['jenis_paket']; ?> akan dihapus?</p>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<a href="hapus-paket.php?id_paket=<?php echo $data['id_paket'];?>" class="btn btn-danger" name="hapus">Hapus</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>

			<!-- Modal Hapus-->
			<?php foreach ( $paket_laundry as $data ) : ?>
				<div class="modal fade" id="modalUbah<?php echo $data['id_paket'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Edit Jenis Paket</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<input type="hidden" name="id_paket" value="<?php echo $data['id_paket']; ?>">
									<div class="form-group">
										<label for="jenis_paket">Jenis Paket</label>
										<input type="text" class="form-control" id="jenis_paket" name="jenis_paket" value="<?php echo $data['jenis_paket']; ?>">
									</div>

									<div class="form-group">
										<label for="harga">Harga/Kg</label>
										<input type="number" class="form-control" id="harga" name="harga" value="<?php echo $data['harga']; ?>">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-success" name="ubah">Edit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php endforeach ?>

			<?php include 'layout/footer.php'; ?>