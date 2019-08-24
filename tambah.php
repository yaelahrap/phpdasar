<?php
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// cek apakah tombol submit sudah di tekan atau belum
if(isset($_POST["submit"])) {

	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah($_POST) > 0 ) {
		echo "
				<script>
					alert('data berhasil ditambahkan!');
					document.location.href = 'index.php';
				</script>
			";
	} else {
		echo "
				<script>
					alert('data gagal ditambahkan!');
					document.location.href = 'index.php';
				</script>
			";
	}

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tambah data mahasiswa</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

   
  </head>
  <body>
    <h1>Tambah data mahasiswa</h1>

    <div class="container-fluid">
	<div class="row">
	<div class="col-sm-5 col-offside-4">
	<form class="form-group" action="" method="post" enctype="multipart/form-data">
		<ul>
		<div class="form-group">	
				<label for="nrp">NRP : </label>
				<input type="text" class="form-control" name="nrp" id="nrp" required><br><br>
		</div>
		<div class="form-group">	
				<label for="nama">Nama : </label>
				<input type="text" class="form-control" name="nama" id="nama"><br><br>
		</div>
		<div class="form-group">
				<label for="email">Email : </label>
				<input type="text" class="form-control" name="email" id="email"><br><br>
		</div>
		<div class="form-group">	
				<label for="jurusan">Jurusan : </label>
				<input type="text" class="form-control" name="jurusan" id="jurusan"><br><br>
		</div>	
		<div class="form-group">	
				<label for="gambar">Gambar : </label>
				<input type="file" class="form-control" name="gambar" id="gambar"><br><br>
		</div>
		<div class="form-group">	
				<button type="submit" class="btn btn-flat btn-success" name="submit">Tambah Data!</button>
		</div>	
		</ul>
		
	</form>
	</div>
	</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>