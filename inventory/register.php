<?php 
require 'function.php';
if (!isset($_SESSION['log'])) {

} else {
    header('location:stok.php');
}


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Register</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/inventory.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
<div class="container-fluid col-md-6 mb-3">
    <div class="row content">
        <div class="col-md-12">
        <div class="card-header">
            <h3>Sign Up</h3>
            </div>
            <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nama_user">Nama</label>
                    <input type="text" name="nama_user" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="id_user">Username</label>
                    <input type="text" name="id_user" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password2">Konfirmasi Ulang Password</label>
                    <input type="password" name="password2" class="form-control" required>
                </div>
                <br>
                <div class="form-group form-check">
                    <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
                    <label class="form-check-label" for="checkbox">Pastikan data yang Anda isikan benar</label>
                </div>
                <br>
                <button class="btn btn-primary" name="register">Registrasi Akun</button>
                <br>
                <br>
                <div class="text-center">
                    <div class="small"><a href="login.php">Have an account? Login</a></div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    </body>

</html>