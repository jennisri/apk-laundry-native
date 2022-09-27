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

$title = "Data Karyawan";
include 'layout/header.php';

$karyawan = query("SELECT * FROM karyawan ORDER BY id_karyawan DESC");

if(isset($_POST['tambah'])){
	if(tambah_karyawan($_POST) > 0){
		echo "<script>
		alert ('Data Berhasil Ditambahkan');
		document.location.href = 'karyawan.php';
		</script>";
	}else{
		echo "<script>
		alert ('Data Gagal Ditambahkan');
		document.location.href = 'karyawan.php';
		</script>";
	}
}

if(isset($_POST['ubah'])){
	if(ubah_karyawan($_POST) > 0){
		echo "<script>
		alert('Data Berhasil Diperbaharui');
		document.location.href = 'karyawan.php';
		</script>
		";
	}else{
		echo "<script>
		alert('Data Berhasil Diperbaharui');
		document.location.href = 'karyawan.php';
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
								<li class="breadcrumb-item active">Karyawan</li>
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
							<h5>Data Karyawan</h5>

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
											<th>Nomor Telepon</th>
											<th>Jenis Kelamin</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1 ?>
										<?php foreach ( $karyawan as $data ) : ?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $data['nama_karyawan']; ?></td>
												<td><?php echo $data['alamat_karyawan']; ?></td>
												<td><?php echo $data['nohp']; ?></td>
												<td><?php echo $data['gender']; ?></td>
												<td>
													<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalUbah<?php echo $data['id_karyawan'];?>">Edit</button>
													<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_karyawan'];?>">Hapus</button>
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
							<h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="nama">Nama Lengkap</label>
										<input type="text" class="form-control" id="nama" name="nama_karyawan">
									</div>

									<div class="form-group col-md-6">
										<label for="username">Username</label>
										<input type="text" class="form-control" id="username" name="username">
									</div>
								</div>
								
								<div class="row">
									<div class="form-group col-md-6">
										<label for="password">Password</label>
										<input type="password" class="form-control" id="password" name="password">
									</div>
									
									<div class="form-group col-md-6">
										<label for="nohp">No HP</label>
										<input type="number" class="form-control" id="nohp" name="nohp">
									</div>
								</div>

								<div class="form-group">
									<label for="alamat">Alamat</label>
									<input type="text" class="form-control" id="alamat" name="alamat_karyawan">
								</div>


								<div class="form-group">
									<label for="gender">Jenis Kelamin</label>
									<select name="gender" id="gender" class="form-control">
										<option value="">--Pilih--</option>
										<option value="Laki-Laki">Laki-Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>

								<div class="form-group">
									<label for="role">Level</label>
									<select name="role" id="role" class="form-control">
										<option value="">--Pilih--</option>
										<option value="1">Administrator</option>
										<option value="2">Karyawan</option>
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

			<!-- Modal Ubah-->
			<?php foreach ( $karyawan as $data ) : ?>
				<div class="modal fade" id="modalUbah<?php echo $data['id_karyawan'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Edit Data Karyawan</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan'] ?>">
									<div class="row">
										<div class="form-group col-md-6">
											<label for="nama">Nama Lengkap</label>
											<input type="text" class="form-control" id="nama" name="nama_karyawan" value="<?php echo $data['nama_karyawan'] ?>">
										</div>

										<div class="form-group col-md-6">
											<label for="username">Username</label>
											<input type="text" class="form-control" id="username" name="username" value="<?php echo $data['username'] ?>">
										</div>
									</div>

									<div class="row">
										<div class="form-group col-md-6">
											<label for="gender">Jenis Kelamin</label>
											<select name="gender" id="gender" class="form-control" required >
												<?php $gender = $data['gender']; ?>
												<option value="Laki-Laki" <?php echo $gender == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>

												<option value="Perempuan" <?php echo $gender == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>

											</select>
										</div>


										<div class="form-group col-md-6">
											<label for="nohp">No HP</label>
											<input type="number" class="form-control" id="nohp" name="nohp" value="<?php echo $data['nohp'] ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="alamat">Alamat</label>
										<input type="text" class="form-control" id="alamat" name="alamat_karyawan" value="<?php echo $data['alamat_karyawan'] ?>">
									</div>


									<div class="form-group">
										<label for="password">Password</label> <small>(Isi Kembali Password Lama/Baru)</small>
										<input type="password" class="form-control" id="password" name="password">
									</div>

									<div class="form-group">
										<label for="role">Level</label>
										<select name="role" id="role" class="form-control">
											<?php $role = $data['role'] ?>
											<option value="1" <?php echo $role == '1' ? 'selected' : null ?>>Administrator</option>
											<option value="2" <?php echo $role == '2' ? 'selected' : null ?>>Karyawan</option>
										</select>
									</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" name="ubah" class="btn btn-success">Ubah</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php endforeach ?>


			<!-- Modal Hapus-->
			<?php foreach ( $karyawan as $data ) : ?>
				<div class="modal fade" id="modalHapus<?php echo $data['id_karyawan'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header btn-danger">
								<h5 class="modal-title text-white" id="exampleModalLabel">Hapus Data Karyawan</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Apakah <?php echo $data['nama_karyawan'] ?> akan dihapus ???</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<a href="hapus-karyawan.php?id_karyawan=<?php echo $data['id_karyawan']; ?>" name="hapus" class="btn btn-danger">Hapus</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>




			<?php include 'layout/footer.php';  ?>