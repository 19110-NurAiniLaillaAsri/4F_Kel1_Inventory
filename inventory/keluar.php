<?php 
require 'function.php';


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
                    <a href="stok.php" style="text-decoration: none;"><i class="fas fa-table me-2"></i><span>Stok Barang</span></a>
                </li>
                <li>
                    <a href="masuk.php" style="text-decoration: none;"><i class="fas fa-table me-2"></i><span>Barang Masuk</span></a>
                </li>
                <li>
                    <a href="keluar.php" class="active" style="text-decoration: none;"><i class="fas fa-table me-2"></i><span>Barang Keluar</span></a>
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
				Barang Keluar
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Barang Keluar
                        </button>

                        <!-- Modal -->
                        <form method="POST">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Barang Keluar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <select name="jenisbarang" class="form-control">
                                        <?php
                                            $getdata = mysqli_query($koneksi, "SELECT * FROM stok");
                                            while ($fetcharray = mysqli_fetch_array($getdata)) {
                                                $jenisbarang = $fetcharray['nama_barang'];
                                                $idbarang = $fetcharray['id_barang'];
                                        ?>

                                        <option value="<?=$idbarang;?>"><?=$jenisbarang;?></option>

                                        <?php
                                            }

                                        ?>
                                    </select><br>
                                    <input type="text" name="customer" placeholder="Customer" class="form-control" required><br>
                                    <input type="text" name="quantitas" placeholder="Quantitas" class="form-control" required><br>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="close">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        </form>
    				</div>
<!-- Tabel -->
    				<div class="card-body">
    					<div class="table-responsive-xxl">
    						<table class="table table-bordered overflow-scroll" id="dataTable" width="100%">
    							<thead>
    								<tr>
    									<th>No</th>
    									<th>Id Barang</th>
    									<th>Tanggal</th>
    									<th>Nama Barang</th>
    									<th>Stok</th>
    									<th>Customer</th>
    									<th>Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
                                    <?php
                                    $i = 1;
                                    $getdata = mysqli_query($koneksi, "SELECT * FROM keluar m, stok = s where s.id_barang = m.id_barang");
                                    while($fetcharray=mysqli_fetch_array($getdata)){
                                        $id_barang = $fetcharray['id_barang'];
                                        $tanggal = $fetcharray['tanggal'];
                                        $nama_barang = $fetcharray['nama_barang'];
                                        $customer = $fetcharray['customer'];
                                        $quantitas = $fetcharray['quantitas'];
                                    ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><?=$id_barang;?></td>
                                        <td><?= date("d F Y", strtotime($tanggal));?></td>
                                        <td><?=$nama_barang;?></td>
                                        <td><?=$quantitas;?></td>
                                        <td><?=$customer;?></td>
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