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

$title = "Data Pelanggan";
include 'layout/header.php';

$pelanggan = query("SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");

if(isset($_POST['tambah'])){
	if(tambah_pelanggan($_POST) > 0){
		echo "<script>
		alert('Data Berhasil Ditambahkan');
		document.location.href = 'pelanggan.php';
		</script>
		";
	}else{
		echo "<script>
		alert('Data Gagal Ditambahkan');
		document.location.href = 'pelanggan.php';
		</script>
		";
	}
}

if(isset($_POST['ubah'])){
	if(ubah_pelanggan($_POST) > 0){
		echo "<script>
		alert('Data Berhasil Diperbarui');
		document.location.href = 'pelanggan.php';
		</script>
		";
	}else{
		echo "<script>
		alert('Data Gagal Diperbarui');
		document.location.href = 'pelanggan.php';
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
								<li class="breadcrumb-item active">Customer</li>
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
							<h5>Data Customer</h5>

						</div>
						<div class="card-body">
							<div class="table-responsive">
								<button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#modalTambah"><i class="ti-plus"></i> Tambah</button>

								<table id="example" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th>Telepon</th>
											<th>Jenis Kelamin</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no= 1; ?>
										<?php foreach ( $pelanggan as $data ) : ?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $data['nama'] ?></td>
												<td><?php echo $data['alamat'] ?></td>
												<td><?php echo $data['telepon'] ?></td>
												<td><?php echo $data['jenis_kelamin'] ?></td>
												<td>
													<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalUbah<?php echo $data['id_pelanggan'] ?>">Edit</button>
													<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_pelanggan'] ?>">Hapus</button>
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
			<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Tambah Data Customer</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<div class="form-group">
									<label for="nama">Nama Lengkap</label>
									<input type="text" class="form-control" id="nama" name="nama">
								</div>

								<div class="form-group">
									<label for="alamat">Alamat Lengkap</label>
									<input type="text" class="form-control" id="alamat" name="alamat">
								</div>

								<div class="form-group">
									<label for="telepon">No Telepon</label>
									<input type="number" class="form-control" id="telepon" name="telepon">
								</div>

								<div class="form-group">
									<label for="jenis_kelamin">Jenis Kelamin</label>
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
										<option value="">--Pilih--</option>
										<option value="Laki-Laki">Laki-Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal Hapus-->
			<?php foreach ( $pelanggan as $data ) : ?>
				<div class="modal fade" id="modalHapus<?php echo $data['id_pelanggan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-danger">
								<h5 class="modal-title text-white" id="exampleModalLabel">Hapus Data Customer</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Apakah Yakin Custumer atas nama : <?php echo $data['nama'] ?> akan dihapus ?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<a href="hapus-pelanggan.php?id_pelanggan=<?php echo $data['id_pelanggan']; ?>" name="hapus" class="btn btn-danger">Hapus</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>

			<!-- Modal Ubah-->
			<?php foreach ( $pelanggan as $data ) : ?>
				<div class="modal fade" id="modalUbah<?php echo $data['id_pelanggan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Tambah Data Customer</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<input type="hidden" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>">

									<div class="form-group">
										<label for="nama">Nama Lengkap</label>
										<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
									</div>

									<div class="form-group">
										<label for="alamat">Alamat Lengkap</label>
										<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat']; ?>">
									</div>

									<div class="form-group">
										<label for="telepon">No Telepon</label>
										<input type="number" class="form-control" id="telepon" name="telepon" value="<?php echo $data['telepon']; ?>">
									</div>

									<div class="form-group">
										<label for="jenis_kelamin">Jenis Kelamin</label>
										<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
											<?php $jenis_kelamin = $data['jenis_kelamin'] ?>
											<option value="Laki-Laki" <?php echo $jenis_kelamin == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
											<option value="Perempuan" <?php echo $jenis_kelamin == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
										</select>
									</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" name="ubah" class="btn btn-success">Edit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php endforeach ?>



			<?php include 'layout/footer.php'; ?>