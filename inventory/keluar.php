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
                            <div id="dataTable_wrapper" class="dataTable_wrapper">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <a type="button" target="_blank" href="cetakkeluar.php" class="btn btn-secondary">Cetak Laporan</a>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="dataTable_filter" class="dataTable_filter">
                                            <div class="container-fluid" style="max-width: 400px;">
                                            <form action="<?php echo $_SERVER["PHP_SELF"];?>" class="d-flex" method="GET">
                                                <input class="form-control me-2" type="search" name="cari" placeholder="Search" aria-label="Search">
                                                <button class="btn btn-outline-success" type="submit">Search</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-3">
                                    <table class="table table-bordered overflow-scroll" id="dataTable" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th style="width: 15%;">Id Barang</th>
                                                <th style="width: 15%;">Tanggal</th>
                                                <th style="width: 25%;">Nama Barang</th>
                                                <th style="width: 5%;">Stok</th>
                                                <th style="width: 15%;">Customer</th>
                                                <th style="width: 20%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            if (isset($_GET['cari'])) {
                                                $cari = $_GET['cari'];
                                                $tgl = date("Y-m-d", strtotime($cari));
                                                $getdata = mysqli_query($koneksi, "SELECT id_keluar, s.id_barang, k.tgl_keluar, s.nama_barang, k.customer, k.quantitas FROM keluar k, stok s WHERE s.id_barang = k.id_barang AND (s.id_barang like '%".$cari."%' OR k.tgl_keluar like '%".$tgl."%' OR s.nama_barang like '%".$cari."%' OR k.customer like '%".$cari."%' OR k.quantitas like '%".$cari."%')");
                                            } else {
                                                $getdata = mysqli_query($koneksi, "SELECT * FROM keluar k, stok s where s.id_barang = k.id_barang ORDER BY k.tgl_keluar DESC");
                                            }
                                            $data = mysqli_query($koneksi, "SELECT * FROM keluar k, stok s where s.id_barang = k.id_barang ORDER BY k.tgl_keluar DESC");
                                            while($row=mysqli_fetch_array($getdata)){
                                                $id_keluar = $row['id_keluar'];
                                                $id_barang = $row['id_barang'];
                                                $tanggal = $row['tgl_keluar'];
                                                $nama_barang = $row['nama_barang'];
                                                $customer = $row['customer'];
                                                $quantitas = $row['quantitas'];
                                            ?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$id_barang;?></td>
                                                <td><?= date("d F Y", strtotime($tanggal));?></td>
                                                <td><?=$nama_barang;?></td>
                                                <td><?=$quantitas;?></td>
                                                <td><?=$customer;?></td>
                                                <td>

                                                <!--    <a href="proseskeluar.php?id=<?php echo $id_keluar['id_keluar']?>"class="btn btn-warning">Edit </a>
                                                    <a href="proseskeluar.php?id=<?php echo $id_keluar['id_keluar']?>"class="btn btn-danger">Hapus </a>-->
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$id_keluar;?>" style="width: 100px;"><i class="far fa-edit"></i> Edit </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$id_keluar;?>"><i class="far fa-trash-alt" style="width: 20px;"></i> Hapus </button>
                                                
                                                </td>
        <!--Modal Edit Barang -->
                                            <form action="" method="POST">
                                                <div class="modal fade" id="edit<?=$id_keluar;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang Masuk</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input class="form-control" type="text" name="id_barang" value="<?=$id_barang;?>" aria-label="readonly input example" readonly><br>
                                                                <input class="form-control" type="text" name="nama_barang" value="<?=$nama_barang;?>" aria-label="readonly input example" readonly><br>
                                                                <input type="text" name="quantitas" value="<?=$quantitas;?>" class="form-control" required><br>
                                                                <input type="text" name="customer" value="<?=$customer;?>" class="form-control" required><br>
                                                                <input type="hidden" name="id_barang" value="<?=$id_barang;?>">
                                                                <input type="hidden" name="id_keluar" value="<?=$id_keluar;?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="Submit" class="btn btn-primary" name="editkeluar">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
        <!-- Modal Hapus Barang -->
                                                <form action="" method="POST">
                                                <div class="modal fade" id="delete<?=$id_keluar;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data <?=$nama_barang;?>
                                                                <input type="hidden" name="id_barang" value="<?=$id_barang;?>">
                                                                <input type="hidden" name="quantitas" value="<?=$quantitas;?>">
                                                                <input type="hidden" name="id_keluar" value="<?=$id_keluar;?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="Submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            <?php $i++; ?>
                                            <?php
                                            };
                                                    
                                            ?>
                                        </tbody>
                                    </table>   
                                    </div>
                                </div>
                            </div>
                            
                        </div>
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
