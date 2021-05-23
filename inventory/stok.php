<?php 
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stok Barang</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/inventory.css">
</head>

<!-- Sidebar -->
<body>
	<input type="checkbox" id="nav-toggle"> 
	<div class="sidebar">
		<div class="sidebar-brand">
			<h2><span class="fas fa-box-open"></span><span>MyInventory</span></h1>
		</div>

		<div class="sidebar-menu">
			<ul>
				<li>
					<a href="stok.php" class="active" style="text-decoration: none;"><i class="fas fa-table"></i><span>Stok Barang</span></a>
				</li>
				<li>
					<a href="masuk.php" style="text-decoration: none;"><i class="fas fa-table me-2"></i><span>Barang Masuk</span></a>
				</li>
				<li>
                    <a href="keluar.php" style="text-decoration: none;"><i class="fas fa-table me-2"></i><span>Barang Keluar</span></a>
				</li>
			</ul>
		</div>
	</div>
<!--Navbar -->
	<div class="main-content">
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="fas fa-bars"></span>
				</label>
				Stok Barang 
			</h2>

            <div class="dropdown">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><?= ucfirst($_SESSION['nama_user']);?></a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="editakun.php">Edit Akun</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="ubahsandi.php">Ubah Kata Sandi</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="logout.php" name="logout">Logout</a></li>
              </ul>
            </div>
		</header>
<!-- Form Barang -->
		<main>
    		<div class="container-fluid">
    			<div class="card mb-4">
    				<div class="card-header">
    					<!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah Jenis Barang </button>

                        <!-- Modal -->
                        <form action="" method="POST">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <input type="text" name="id_barang" placeholder="ID Barang" class="form-control" required><br>
                                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required><br>
                                    <input type="text" name="supplier" placeholder="Supplier" class="form-control" required><br>
                                    <input type="text" name="stok" placeholder="Quantitas" class="form-control" required><br>
                              </div>
                              <div class="modal-footer">
                                <button type="Submit" class="btn btn-primary" name="barangbaru">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="close">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        </form>
    				</div>
<!-- Tabel -->
    				<div class="card-body">
                        <!-- Note Stok Habis -->
                        <?php
                        $getdata = mysqli_query($koneksi, "SELECT * FROM stok where stok < 1");

                        while($fetcharray=mysqli_fetch_array($getdata)){
                            $barang = $fetcharray['nama_barang'];
                                

                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            
                            <strong>Perhatian!</strong> Stok <?=$barang;?> sudah habis.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                          }
                        ?>
    					<div class="table-responsive-xxl">
    						<table class="table table-bordered overflow-scroll" id="dataTable" width="100%">
    							<thead>
    								<tr>
    									<th>No</th>
    									<th>Id Barang</th>
    									<th>Tanggal</th>
    									<th>Nama Barang</th>
    									<th>Stok</th>
    									<th>Supplier</th>
    									<th>Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
                                    <?php
                                    $i = 1;
                                    $getdata = mysqli_query($koneksi, "SELECT * FROM stok");
                                    while($fetcharray=mysqli_fetch_array($getdata)){
                                        $id_barang = $fetcharray['id_barang'];
                                        $tanggal = $fetcharray['tanggal'];
                                        $nama_barang = $fetcharray['nama_barang'];
                                        $stok = $fetcharray['stok'];
                                        $supplier = $fetcharray['supplier'];
                                    ?>
                                    <tr>
                                       <td><?=$i;?></td>
                                        <td><?=$id_barang;?></td>
                                        <td><?= date("d F Y", strtotime($tanggal));?></td>
                                        <td><?=$nama_barang;?></td>
                                        <td><?=$stok;?></td>
                                        <td><?=$supplier;?></td>
                                        <td>
                                            <a class="btn btn-warning"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php
                                    };
                                    
                                    ?>
                                </tbody>
    						</table>
    					</div>
    					<!-- <nav aria-label="Page navigation example">
						  <ul class="pagination justify-content-end">
						    <li class="page-item disabled">
						      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
						    </li>
						    <li class="page-item"><a class="page-link" href="#">1</a></li>
						    <li class="page-item"><a class="page-link" href="#">2</a></li>
						    <li class="page-item"><a class="page-link" href="#">3</a></li>
						    <li class="page-item">
						      <a class="page-link" href="#">Next</a>
						    </li>
						  </ul>
						</nav> -->
    				</div>
    			</div>
    		</div>
		</main>
	</div>
<!-- Script -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script> <!-- buat modal -->   
</body>
</html>