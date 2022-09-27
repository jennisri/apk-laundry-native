<?php 

include 'config/core.php';

$query = query("SELECT * FROM transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN paket_laundry ON transaksi.id_paket = paket_laundry.id_paket INNER JOIN tipe_pembayaran ON transaksi.id_tipe = tipe_pembayaran.id_tipe")

?>

<!-- Styles -->
<link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
<link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
<link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/lib/themify-icons.css" rel="stylesheet">
<link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
<link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
<link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
<link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
<link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/lib/helper.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">    


<h3 class="text-center mt-4">Laporan Transaksi Laundry APJ</h3><br><br>
<div class="container">
	<table class="table table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>No</th>
				<th>Tgl. Transaksi</th>
				<th>Pembayaran</th>
				<th>Nama Customer</th>
				<th>Paket</th>
				<th>Tipe Pembayaran</th>
				<th>Status Order</th>
				<th>Total</th>
			</tr>
		</thead>

		<tbody>
			<?php $no= 1; ?>
			<?php foreach ( $query as $data ) : ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $data['tgl_transaksi']; ?></td>
					<td>
						<?php if ($data['sts_pembayaran'] == 1): ?>
							<p>Belum Lunas</p>
							<?php elseif ($data['sts_pembayaran'] == 2): ?>
								<p>Lunas</p>
							<?php endif ?>
						</td>
						<td><?php echo $data['nama']; ?></td>
						<td><?php echo $data['jenis_paket']; ?></td>
						<td><?php echo $data['nama_pembayaran']; ?></td>
						<td>
							<?php if ($data['sts_order'] == 1): ?>
								<p>Baru</p>
								<?php elseif ($data['sts_order'] == 2): ?>
									<p>Diambil</p>
								<?php endif ?>
							</td>
							<td>Rp. <?php echo number_format($data['harga'] * $data['berat'] , 0, '.', '.'); ?></td>
						</tr>


					<?php endforeach ?>
				</tbody>

			</table>
		</div>
		<script>
			window.print();
		</script>