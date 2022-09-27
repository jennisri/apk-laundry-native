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

$title = "Data Tipe Pembayaran";
include 'layout/header.php';


$pembayaran = query("SELECT * FROM tipe_pembayaran ORDER BY id_tipe DESC") ;

if(isset($_POST['tambah'])){
	if(tambah_tipe($_POST) > 0){
		echo "<script>
		alert ('Data berhasil ditambahkan');
		document.location.href = 'pembayaran.php';
		</script>
		";
	}else{
		echo "<script>
		alert ('Data gagal ditambahkan');
		document.location.href = 'pembayaran.php';
		</script>
		";
	}
}


if(isset($_POST['ubah'])){
	if(ubah_tipe($_POST) > 0){
		echo "<script>
		alert ('Data berhasil diperbarui');
		document.location.href = 'pembayaran.php';
		</script>
		";
	}else{
		echo "<script>
		alert ('Data gagal diperbarui');
		document.location.href = 'pembayaran.php';
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
								<li class="breadcrumb-item active">Tipe Pembayaran</li>
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
							<h5>Data Tipe Pembayaran</h5>

						</div>
						<div class="card-body">
							<div class="table-responsive">
								<button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#modalTambah"><i class="ti-plus"></i> Tambah</button>

								<table id="example" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Tipe Pembayaran</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1 ?>
										<?php foreach ( $pembayaran as $data) : ?>
											<tr>
												<td><?php echo $no++ ?></td>
												<td><?php echo $data['nama_pembayaran'] ?></td>
												<!-- <td><span class="badge badge-primary">Paid</span></td> -->
												<td>
													<button class="btn btn-sm btn-success" title="Edit" data-toggle="modal" data-target="#modalUbah<?php echo $data['id_tipe']; ?>">Edit</button>
													<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus<?php echo $data['id_tipe'] ?>" title="Hapus">Hapus</button>
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
							<h5 class="modal-title" id="staticBackdropLabel">Tambah Tipe Pembayaran</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" method="post">
								<div class="form-group">
									<label for="tipe_pembayaran">Tipe Pembayaran</label>
									<input type="text" class="form-control" id="tipe_pembayaran" name="nama_pembayaran">
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
			<?php foreach ( $pembayaran as $data ) : ?>
				<div class="modal fade" id="modalHapus<?php echo $data['id_tipe']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-danger">
								<h5 class="modal-title text-white" id="staticBackdropLabel" >Hapus Tipe Pembayaran</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Apakah yakin tipe pembayaran dengan nama <?php echo $data['nama_pembayaran']; ?></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<a href="hapus-tipe.php?id_tipe=<?php echo $data['id_tipe']; ?>" class="btn btn-danger" name="hapus">Hapus</a>
							</div>

						</div>
					</div>
				</div>
			<?php endforeach ?>

			<!-- Modal Ubah-->
			<?php foreach ( $pembayaran as $data ) : ?>
				<div class="modal fade" id="modalUbah<?php echo $data['id_tipe']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Edit Tipe Pembayaran</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<input type="hidden" name="id_tipe" value="<?php echo $data['id_tipe'];?>">

									<div class="form-group">
										<label for="tipe_pembayaran">Tipe Pembayaran</label>
										<input type="text" class="form-control" id="tipe_pembayaran" name="nama_pembayaran" value="<?php echo $data['nama_pembayaran']; ?>">
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

			

			


			<?php include 'layout/footer.php';  ?>