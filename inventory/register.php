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
    <link rel="stylesheet" href="css/login.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
<div class="container fadeIn firs d-flex wrapper">
    <div class="row content w-75 m-auto">
        <div class="text-center">
            <h3>Sign Up</h3><br>
            <div class="underline-title"></div>
        </div>
        <form method="POST">
            <div class="col-md-6 m-auto">
                <div class="form-group mt-2">
                    <label for="nama_user">Nama</label>
                    <input type="text" name="nama_user" class="form-control" required>
                </div>
                <div class="form-group mt-2">
                    <label for="no_telp">No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control" required>
                </div>
                <div class="form-group mt-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mt-2">
                    <label for="id_user">Id User</label>
                    <input type="text" name="id_user" class="form-control" required>
                </div>
                <div class="form-group mt-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group mt-2">
                    <label for="password2">Konfirmasi Ulang Password</label>
                    <input type="password" name="password2" class="form-control" required>
                </div>
            </div>
            <div class="text-center">
                <input id="submit-btn" type="submit" name="register" value="Registrasi Akun" /><br><a href="index.php" id="signup">Have an account? Login</a>
            </div>
        </form>    
    </div>
</div>

    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script> <!-- buat modal --> 
    </body>

</html>
