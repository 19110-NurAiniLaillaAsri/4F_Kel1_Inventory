<?php  
include 'function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Akun</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/inventory.css">
</head>

<body>
	<input type="checkbox" id="nav-toggle"> 
	<div class="sidebar">
		<div class="sidebar-brand">
			<h2><span class="fas fa-box-open"></span><span>MyInventory</span></h1>
		</div>

		<div class="sidebar-menu">
			<ul>
				<li>
					<a href="stok.php" style="text-decoration: none;"><span class="fas fa-table"></span><span>    Stok Barang</span></a>
				</li>
				<li>
					<a href="masuk.php" style="text-decoration: none;"><span class="fas fa-table"></span><span>   Barang Masuk</span></a>
				</li>
				<li>
					<a href="keluar.php" style="text-decoration: none;"><span class="fas fa-table"></span><span>  Barang Keluar</span></a>
				</li>
			</ul>
		</div>
	</div>

	<div class="main-content">
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="fas fa-bars"></span>
				</label>
				Akun
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

		<main>
    		<div class="container-fluid">
    			<div class="card mb-4">
    				<div class="card-header">
    					<h3>Ubah Kata Sandi</h3>
    				</div>
    				<div class="card-body">
    					<form method="POST">
                            <div class="form-group">
                                <label for="id_user">ID User</label>
                                <input type="text" name="id_user" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password Lama</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="newpassword">Password Baru</label>
                                <input type="password" name="newpassword" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="newpassword">Konfirmasi Password Baru</label>
                                <input type="password" name="newpassword" class="form-control" required>
                            </div>
                            <br>        
                            <div class="form-group form-check">
                                <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="checkbox">Pastikan data yang Anda isikan benar</label>
                            </div>
                            <br>
                            <button type="button" class="btn btn-primary" name="updatepassword">
                                        Perbarui Password
                            </button>
                                    
                        </form>
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