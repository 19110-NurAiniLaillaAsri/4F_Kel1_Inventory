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
    <title>Cetak Barang Masuk</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/inventory.css">
</head>
<body>
	<h2 class="text-center mt-3">Data Barang Masuk</h2>
	<table class="table table-bordered" style="width: 100%">
		<thead>
            <tr>
                <th class="sorting" style="width: 5%;">No</th>
                <th style="width: 15%;">Id Barang</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 25%;">Nama Barang</th>
                <th style="width: 5%;">Stok</th>
                <th style="width: 15%;">Supplier</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            // if (isset($_GET['cari'])) {
            //     $cari = $_GET['cari'];
            //     $tgl = date("Y-m-d", strtotime($cari));
            //     $getdata = mysqli_query($koneksi, "SELECT id_masuk, s.id_barang, m.tanggal, s.nama_barang, m.supplier, m.quantitas FROM masuk m, stok s WHERE s.id_barang = m.id_barang AND (s.id_barang like '%".$cari."%' OR m.tanggal like '%".$tgl."%' OR s.nama_barang like '%".$cari."%' OR m.supplier like '%".$cari."%' OR m.quantitas like '%".$cari."%')");
            // } else {
            //     $getdata = mysqli_query($koneksi, "SELECT * FROM masuk m, stok s where s.id_barang = m.id_barang ORDER BY m.tanggal DESC");
            // }
            $getdata = mysqli_query($koneksi, "SELECT * FROM masuk m, stok s where s.id_barang = m.id_barang ORDER BY m.tanggal DESC");
            while($row=mysqli_fetch_array($getdata)){
            // echo var_dump($row);
            $id_masuk = $row['id_masuk'];
            $id_barang = $row['id_barang'];
            $tanggal = $row['tanggal'];
            $nama_barang = $row['nama_barang'];
            $quantitas = $row['quantitas'];
            $supplier = $row['supplier'];
            echo $tanggal;
             ?>
             <tr>
                <td><?=$i;?></td>
                 <!-- <td><?=$id_masuk;?></td> -->
                <td><?=$id_barang;?></td>
                <td><?= date("d F Y", strtotime($tanggal));?></td> 
                <td><?=$nama_barang;?></td>
                <td><?=$quantitas;?></td>
                <td><?=$supplier;?></td>
            </tr>
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