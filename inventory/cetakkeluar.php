<?php 
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Barang Keluar</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/inventory.css">
</head>
<body>
	<h2 class="text-center mt-3">Data Barang Keluar</h2>
	<table class="table table-bordered" style="width: 100%">
		<thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Id Barang</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 35%;">Nama Barang</th>
                <th style="width: 5%;">Stok</th>
                <th style="width: 15%;">Customer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $tgl = date("Y-m-d", strtotime($cari));
                $getdata = mysqli_query($koneksi, "SELECT id_keluar, s.id_barang, k.tanggal, s.nama_barang, k.customer, k.quantitas FROM keluar k, stok s WHERE s.id_barang = k.id_barang AND (s.id_barang like '%".$cari."%' OR k.tanggal like '%".$tgl."%' OR s.nama_barang like '%".$cari."%' OR k.customer like '%".$cari."%' OR k.quantitas like '%".$cari."%')");
            } else {
                $getdata = mysqli_query($koneksi, "SELECT * FROM keluar k, stok s where s.id_barang = k.id_barang ORDER BY k.tanggal DESC");
            }
            // $getdata = mysqli_query($koneksi, "SELECT * FROM keluar k, stok s where s.id_barang = k.id_barang ORDER BY k.tanggal DESC");
            while($data=mysqli_fetch_array($getdata)){
            $id_keluar = $data['id_keluar'];
            $id_barang = $data['id_barang'];
            $tanggal = $data['tanggal'];
            $nama_barang = $data['nama_barang'];
            $customer = $data['customer'];
            $quantitas = $data['quantitas'];
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$id_barang;?></td>
                <td><?= date("d F Y", strtotime($tanggal));?></td>
                <td><?=$nama_barang;?></td>
                <td><?=$quantitas;?></td>
                <td><?=$customer;?></td>
            <?php $i++; ?>
            <?php
            };
                                                    
            ?>
	    </tbody>
	</table>
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript">
    	window.print();
	</script>
</body>
</html>