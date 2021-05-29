<?php  
session_start();
//membuat koneksi database
$koneksi = mysqli_connect("localhost","root","","stokbarang") or die("Gagal");

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

//EDIT DATA BARANG
if (isset($_POST['editbarang'])) {
	$id_barang = $_POST['id_barang'];
	$nama_barang = $_POST['nama_barang'];

	$edit = mysqli_query($koneksi, "UPDATE stok SET nama_barang='$nama_barang' WHERE id_barang='$id_barang'");
	if ($edit) {
		echo "<script>alert('Data barang berhasil diperbarui!')window.location.replace('stok.php');</script>";
	} else {
		// echo "<script>alert('Data barang gagal diperbarui!')
		// window.location.replace('stok.php');</script>";
		die("Connection failed: " . mysqli_connect_error());
	}
}

//HAPUS DATA BARANG
if (isset($_POST['hapusbarang'])) {
	$id_barang = $_POST['id_barang'];

	$delete = mysqli_query($koneksi, "DELETE FROM stok WHERE id_barang='$id_barang'");
	if ($delete) {
		echo "<script>alert('Data barang berhasil diperbarui!')window.location.replace('stok.php');</script>";
	} else {
		// echo "<script>alert('Data barang gagal diperbarui!')
		// window.location.replace('stok.php');</script>";
		die("Connection failed: Gagal Delete " . mysqli_connect_error());
	}
}

//EDIT DATA BARANG MASUK
if (isset($_POST['editmasuk'])) {
	$id_barang = $_POST['id_barang'];
	$id_masuk = $_POST['id_masuk'];
	$quantitas = $_POST['quantitas'];
	$supplier = $_POST['supplier'];

	$datastok = mysqli_query($koneksi, "SELECT * FROM stok WHERE id_barang='$id_barang'");
	$stok = mysqli_fetch_array($datastok);
	$stoknow = $stok['stok'];

	$datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk WHERE id_masuk='$id_masuk'");
	$masuk = mysqli_fetch_array($datamasuk);
	$qtynow = $masuk['quantitas'];

	if($quantitas > $qtynow){
		$selisih = $quantitas-$qtynow;
		$tambah = $stoknow+$selisih;
		$updatestok = mysqli_query($koneksi, "UPDATE stok SET stok='$tambah' WHERE id_barang='$id_barang'");
		$updatemasuk = mysqli_query($koneksi, "UPDATE masuk SET quantitas='$quantitas', supplier='$supplier' WHERE id_masuk='$id_masuk'");
		if ($updatestok && $updatemasuk) {
			echo "<script>alert('Data barang berhasil diperbarui!')window.location.replace('masuk.php');</script>";
		} else {
			// echo "<script>alert('Data barang gagal diperbarui!')
				// window.location.replace('masuk.php');</script>";
			die("Connection failed: Gagal Update input>data " . mysqli_connect_error());
		}
	} else {
		$selisih = $qtynow - $quantitas;
		$kurang = $stoknow - $selisih;
		$updatestok = mysqli_query($koneksi, "UPDATE stok SET stok='$kurang' WHERE id_barang='$id_barang'");
		$updatemasuk = mysqli_query($koneksi, "UPDATE masuk SET quantitas='$quantitas', supplier='$supplier' WHERE id_masuk='$id_masuk'");
		if ($updatestok && $updatemasuk) {
			echo "<script>alert('Data barang berhasil diperbarui!')window.location.replace('masuk.php');</script>";
		} else {
			// echo "<script>alert('Data barang gagal diperbarui!')
				// window.location.replace('masuk.php');</script>";
			die("Connection failed: Gagal Update input<data " . mysqli_connect_error());
		}
	}
}

//HAPUS DATA BARANG MASUK
if (isset($_POST['hapusbarangmasuk'])) {
	$id_barang = $_POST['id_barang'];
	$quantitas = $_POST['quantitas'];
	$id_masuk = $_POST['id_masuk'];

	$datastok = mysqli_query($koneksi, "SELECT * FROM stok WHERE id_barang='$id_barang'");
	$stok = mysqli_fetch_array($datastok);
	$stoknow = $stok['stok'];

	$selisih = $stoknow - $quantitas;

	$update = mysqli_query($koneksi, "UPDATE stok SET stok='$selisih' WHERE id_barang='$id_barang'");
	$delete = mysqli_query($koneksi, "DELETE FROM masuk WHERE id_masuk='$id_masuk'");
	if ($update && $delete) {
		echo "<script>alert('Data barang berhasil dihapus!')window.location.replace('masuk.php');</script>";
	} else {
		// echo "<script>alert('Data barang gagal diperbarui!')
		// window.location.replace('masuk.php');</script>";
			die("Connection failed: Gagal Hapus " . mysqli_connect_error());
	}
}

//EDIT AKUN
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
