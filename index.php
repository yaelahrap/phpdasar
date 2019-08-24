<?php
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// tombol cari ditekan
if(isset($_POST["cari"])) {
  $mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Halaman Admin</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container-fluid">
  <a href="logout.php" type="submit" class="btn btn-flat btn-danger">Logout</a>
    <h1>Daftar Mahasiswa</h1>
      <a class="btn btn-flat btn-primary" href="tambah.php">Tambah data mahasiswa</a><br><br>
        <form class="text-right" action="" method="post">

          <input type="text" name="keyword" size="40" autofocus placeholder="masukan keyword pencarian..." autocomplete="off" id="keyword">
          <button type="submit" class="btn btn-flat btn-warning" name="cari" id="tombol-cari">Cari</button>
          <a type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Login Now" href="login.php">Login</a> |
          <a type="button" class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Register Now" href="registrasi.php">Register</a>
        </form>

</div><br>

<div id="container">
<div class="container-fluid">
  <div class="table-responsive">
    <table class="table table-striped" border="1">
      <tr class="danger">
        <th class="danger">No.</th>
        <th class="danger">Aksi</th>
        <th class="danger">Gambar</th>
        <th class="danger">NRP</th>
        <th class="danger">Nama</th>
        <th class="danger">Email</th>
        <th class="danger">Jurusan</th>
      </tr>
      <?php $i = 1; ?>
      <?php foreach( $mahasiswa as $row ) : ?>
      <tr class="warning">
        <td><?= $i ?></td>
          <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>" type="submit" class="btn btn-flat btn-success">Ubah</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda yakin akan menghapus ini?');" type="submit" class="btn btn-flat btn-danger">Hapus</a>
          </td>
          <td class="warning"><img src="img/<?= $row["gambar"]; ?>" width="60"></td>
          <td class="warning"><?= $row["nrp"]; ?></td>
          <td class="warning"><?= $row["nama"]; ?></td>
          <td class="warning"><?= $row["email"]; ?></td>
          <td class="warning"><?= $row["jurusan"]; ?></td>
      </tr>
      <?php $i++ ?>
      <?php endforeach; ?>
    </table>
  </div>
</div>
</div>
    <script src="js/script.js">

    </script>
  </body>
</html>
