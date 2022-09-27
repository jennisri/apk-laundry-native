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

$title = 'Aplikasi Laundry Online';
include 'layout/header.php';

$transaksi_baru = query("SELECT * FROM transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN paket_laundry ON transaksi.id_paket = paket_laundry.id_paket ORDER BY id_transaksi DESC");

$transaksi = query("SELECT * FROM transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN paket_laundry ON transaksi.id_paket = paket_laundry.id_paket WHERE sts_pembayaran = 1 ORDER BY id_transaksi DESC LIMIT 0, 10");


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
                                <li class="breadcrumb-item active">Home</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-money color-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Transaksi</div>
                                    <div class="stat-digit"><?php echo count($transaksi_baru) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-12">
                    <table class="table table-bordered table-responsive-sm table-striped">
                       <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl. Transaksi</th>
                            <th>Pembayaran</th>
                            <th>Customer</th>
                            <th>Status Order</th>
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
                                    <td>
                                        <?php if ($data['sts_order'] == 1): ?>
                                            <span class="badge badge-info">Baru</span>
                                            <?php elseif ($data['sts_order'] == 2): ?>
                                                <span class="badge badge-success">Diambil</span>
                                            <?php endif ?>
                                        </td>
                                    </tr>


                                <?php endforeach ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- /# column -->
</div>


<?php include 'layout/footer.php'; ?>