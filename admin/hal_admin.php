<?php

require '../config/Database.php';
require '../library/controllers.php';

$perintah = new Oop();
$username = $_SESSION['username'];

$perintah->tampil("tbl_user WHERE username = '$username'");

if (empty($_SESSION['username'])) echo "<script>alert('Silakan login terlebih dahulu!'); document.location.href='index.php'</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>SIM ABSENSI</title>
</head>

<body>
  <div id="utama">
    <ul class="menu">
      <li><a href="?menu=home">Home</a></li>
      <li>
        <a href="#">Input</a>
        <ul>
          <li><a href="?menu=siswa">Siswa</a></li>
          <li><a href="?menu=rayon">Rayon</a></li>
          <li><a href="?menu=rombel">Rombel</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Absensi</a>
        <ul>
          <li><a href="?menu=absen">Absen</a></li>
          <li><a href="?menu=ubahabsen">Ubah Absen</a></li>
        </ul>
      </li>
      <li><a href="?menu=laporan">Laporan</a></li>
      <li><a href="logout.php" onclick="return confirm('Anda yakin ingin keluar?');">Keluar</a></li>
    </ul>

    <div class="konten">
      <?php

      switch ($_GET['menu']) {
        case 'home':
          require 'home.php';
          break;
        case 'siswa':
          require 'siswa.php';
          break;
        case 'rombel':
          require 'rombel.php';
          break;
        case 'rayon':
          require 'rayon.php';
          break;
        case 'absen':
          require 'absen.php';
          break;
        case 'ubahabsen':
          require 'absensi_ubah.php';
          break;
        case 'laporan':
          require 'laporan.php';
          break;
      }

      ?>
    </div>
  </div>
</body>

</html>