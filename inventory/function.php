<?php  
session_start();
//membuat koneksi database
$koneksi = mysqli_connect("localhost","root","","stokbarang") or die("Gagal");
//cek koneksi
// if($koneksi){
// 	echo "Berhasil";
// 	echo "Koneksi database gagal : " . mysqli_connect_error();
// }


//LOGIN
if (isset($_POST['login'])) {
   	$id_user = $_POST['id_user'];
   	$password = $_POST['password'];

   	$cekdatabase = mysqli_query($koneksi, "SELECT * FROM user where id_user='$id_user' and password='$password'");
   	$hitung = mysqli_num_rows($cekdatabase);
   	if($hitung>0){
   		$_SESSION['log'] = 'True';
   		$qry = mysqli_fetch_array($cekdatabase);
   		$_SESSION['id_user'] = $qry['id_user'];
   		$_SESSION['nama_user'] = $qry['nama_user'];
   		$_SESSION['no_telp'] = $qry['no_telp'];
   		$_SESSION['email'] = $qry['email'];
   		$_SESSION['password'] = $qry['password'];
   		header('location:stok.php');
   	} else {
   		echo "<script>alert('Data Tidak Ada')
            window.location.replace('index.php');</script>";
   		// echo "data tidak ada";
   		//header('location:login.php');
   	}
}

//REGISTER
if (isset($_POST['register'])) {
	$nama_user = $_POST['nama_user'];
	$no_telp = $_POST['no_telp'];
	$email = $_POST['email'];
	$id_user = $_POST['id_user'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	//cek data apakah sudah terdaftar
	$result = mysqli_query($koneksi, "SELECT id_user FROM user WHERE id_user = '$id_user'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
			alert('Data pengguna telah terdaftar');
			</script>";
		return false;
	}
	//konfirmasi password
	if ($password !== $password2) {
		echo "<script>
			alert('Konfirmasi password tidak sesuai');
			</script>";
		return false;
	} else {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$addtouser = mysqli_query($koneksi, "INSERT INTO user (id_user, nama_user, no_telp, email, password) VALUES ('$id_user','$nama_user','$no_telp','$email','$password')");
		if ($addtouser) {
			echo "<script>
			alert('Data pengguna berhasil ditambahkan');
			</script>";
		} else {
			die("Connection failed: " . mysqli_connect_error());
		}
	}
}

//BARANG BARU
if (isset($_POST['barangbaru'])) {
	$id_barang = $_POST['id_barang'];
	$nama_barang = $_POST['nama_barang'];
	$supplier = $_POST['supplier'];
	$stok = $_POST['stok'];
	$id_user = $_SESSION['id_user'];
	$addtotable = mysqli_query($koneksi, "INSERT INTO stok VALUES ('$id_barang','$nama_barang','$id_user',NOW(),'$supplier','$stok')");
	if ($addtotable) {
		echo "<script>alert('Barang berhasil ditambahkan!')
		window.location.replace('stok.php');</script>";
	} else {
		// echo "<script>alert('Barang gagal ditambahkan!')
		// window.location.replace('stok.php');</script>";
		die("Connection failed: " . mysqli_connect_error());
	}
}

//BARANG MASUK
if (isset($_POST['barangmasuk'])) {
	$jenisbarang = $_POST['jenisbarang'];
	$id_user = $_SESSION['id_user'];
	$supplier = $_POST['supplier'];
	$quantitas = $_POST['quantitas'];
	
	$cekstoknow = mysqli_query($koneksi, "SELECT * FROM stok WHERE id_barang='$jenisbarang'");
	$getdatastok = mysqli_fetch_array($cekstoknow);

	$stoknow = $getdatastok['stok'];
	$tambahstok = $stoknow+$quantitas;

	$addtomasuk = mysqli_query($koneksi, "INSERT INTO masuk (id_barang, id_user, tanggal, supplier, quantitas) VALUES ('$jenisbarang','$id_user',NOW(),'$supplier','$quantitas')");
	$updatestokmasuk = mysqli_query($koneksi, "UPDATE stok SET stok = '$tambahstok' WHERE id_barang = '$jenisbarang'");
	if ($addtomasuk&&$updatestokmasuk) {
		// header('location:stok.php');
		echo "<script>alert('Barang berhasil ditambahkan!')window.location.replace('masuk.php');</script>";
	} else {
		// echo "<script>alert('Barang gagal ditambahkan!')
		// window.location.replace('stok.php');</script>";
		// header('location:masuk.php');
		die("Connection failed: " . mysqli_connect_error());
	}
}

//BARANG KELUAR
if (isset($_POST['barangkeluar'])) {
	$jenisbarang = $_POST['jenisbarang'];
	$id_user = $_SESSION['id_user'];
	$customer = $_POST['customer'];
	$quantitas = $_POST['quantitas'];

	$cekstoknow = mysqli_query($koneksi, "SELECT * FROM stok WHERE id_barang='$jenisbarang'");
	$getdatastok = mysqli_fetch_array($cekstoknow);

	$stoknow = $getdatastok['stok'];
	$kurangstok = $stoknow-$quantitas;

	$addtokeluar = mysqli_query($koneksi, "INSERT INTO keluar (id_barang, id_user, tanggal, customer, quantitas) VALUES ('$jenisbarang','$id_user',NOW(),'$customer','$quantitas')");
	$updatestokkeluar = mysqli_query($koneksi, "UPDATE stok SET stok = '$kurangstok' WHERE id_barang = '$jenisbarang'");
	if ($addtokeluar&&$updatestokkeluar) {
		echo "<script>alert('Barang berhasil ditambahkan!')window.location.replace('masuk.php');</script>";
	} else {
		// echo "<script>alert('Barang gagal ditambahkan!')
		// window.location.replace('stok.php');</script>";
		// header('location:keluar.php');
		die("Connection failed: " . mysqli_connect_error());
	}
}

//EDIT AKUN blm selesai error Duplicate entry '1' for key 'PRIMARY'
$id_userlama = $_SESSION['id_user'];
//$id_userlama = $_GET['id_user'];
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_userlama'");
$baris = mysqli_fetch_array($data);
if (isset($_POST['updatedata'])) {
	$id_user = $_POST['id_user'];
	$nama_user = $_POST['nama_user'];
	$no_telp = $_POST['no_telp'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$updateuser = mysqli_query($koneksi, "UPDATE user SET id_user='$id_user', nama_user='$nama_user', no_telp='$no_telp', email='$email', password='$password'") or die(mysqli_error($koneksi));
	if ($updateuser) {
		echo "<script>alert('Data berhasil diperbarui')window.location.replace('editakun.php');</script>";
	} else {
		// echo "<script>alert('GAGAL')window.location.replace('editakun.php');</script>";
		die("Connection failed: " . mysqli_connect_error());
	}
}
?>