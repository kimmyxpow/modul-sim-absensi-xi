<?php

require '../config/Database.php';
require '../library/controllers.php';

$perintah = new Oop();

if (isset($_POST['login'])) {
  $table = "tbl_user";
  $username = $_POST['user'];
  $password = $_POST['pass'];
  $namaForm = "hal_admin.php?menu=home";
  $perintah->login($table, $username, $password, $namaForm);
}
if (isset($_POST['batal'])) echo "<script>document.location.href='../'</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>
  <form method="post" action="">
    <table align="center">
      <tr>
        <td>Username</td>
        <td>:</td>
        <td><input type="text" name="user"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td>:</td>
        <td><input type="password" name="pass"></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>
          <button type="submit" name="login">LOGIN</button>
          <button type="submit" name="batal">BATAL</button>
        </td>
      </tr>
    </table>
  </form>
</body>

</html>