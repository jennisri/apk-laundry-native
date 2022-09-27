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

$title = "Cetak";
include 'config/core.php';

$id_transaksi = (int)$_GET['id_transaksi'];

$transaksi = query("SELECT * FROM transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN paket_laundry ON transaksi.id_paket = paket_laundry.id_paket INNER JOIN tipe_pembayaran ON transaksi.id_tipe = tipe_pembayaran.id_tipe WHERE id_transaksi = $id_transaksi")[0];


?>

<div class="cetak-kartu" 
style="
width: 1000px; 
height: auto; 
margin: 12px; 
padding-bottom: 12px; 
padding-left: 12px; 
padding-right: 12px; 
border-style: solid;
border-width: 2px;
border-color: black">



<div id="label-page" style="text-align: center;">
	<h2 style="display: block; border-style: solid; padding: 5px; margin-bottom: 0.5em; margin-left: auto; margin-right: auto; border-width: 1px;">LAUNDRY APJ</h2>
	<h4>INVOICE</h4>
</div>
<div id="content" style="margin-left: 30px;">
	<table  cellpadding="3" cellspacing="5" style="width: 930px;">
		<tr>
			<th width="80px">Customer</th>
			<td width="580px;"><?php echo $transaksi['nama']; ?></td>

			<td>No. Order</td>
			<td><?php echo $transaksi['no_order'] ?></td>
		</tr>

		<tr>
			<td></td>
			<td><?php echo $transaksi['alamat']; ?></td>

			<td>Tanggal Transaksi</td>
			<td><?php echo date('d/m/Y', strtotime($transaksi['tgl_transaksi']));  ?></td>
		</tr>

		<tr>
			<td rowspan="2"></td>
			<td rowspan="2">Telp. <?php echo $transaksi['telepon']; ?></td>

			<td>Tanggal Transaksi</td>
			<td><?php echo date('H:i:s', strtotime($transaksi['tgl_transaksi']));  ?></td>
		</tr>

		<tr>
			<td>Tanggal Ambil</td>
			<td><?php echo date('d/m/Y', strtotime($transaksi['tgl_ambil']))  ?></td>
		</tr>
	</table>
	<br><br>

	<table  border="1" style="width: 930px;">
		<thead>
			<tr>
				<td>No</td>
				<td>Tanggal Order</td>
				<td>Paket Laundry</td>
				<td>Berat Cucian</td>
				<td>Harga/Kg</td>
				<td>Total</td>
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

			<tr>
				<td colspan="5" style="text-align: right;">Total </td>
				<td>Rp. <?php echo number_format($transaksi['harga'] * $transaksi['berat'] , 0, '.', '.'); ?></td>
			</tr>

		</tbody>



	</table>

	<br><br><br>

	<table style="width: 930px;">
		<tr>
			<td><b>Keterangan</b></td>	
		</tr>
		<tr>
			<td>1. Pengambilan cucian harus membawa nota</td>
		</tr>
		<tr>
			<td>2. Cucian luntur bukan tanggung jawab kami</td>
		</tr>
		<tr>
			<td>3. Hitung dan Periksa sebelum pergi</td>
		</tr>
		<tr>
			<td>4. Cucian yang tidak diambil lebih dari 1 bulan bukan tanggung jawab kami</td>
		</tr>
		<tr>
			<td>5. Klaim kekurangan/kehilangan cucian setelah meninggalkan laundry tidak dilayani</td>
		</tr>

	</table>
</div>
</div>
<script>
	window.print();
</script>