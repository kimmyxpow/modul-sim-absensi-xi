<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIM ABSENSI</title>
</head>
<body>
  <?php 
  if (isset($_POST['admin'])) echo "<script>document.location.href='admin'</script>";
  if (isset($_POST['pd'])) echo "<script>document.location.href='pesertadidik'</script>";
  ?>

  <form method="post" action="">
    <table align="center">
      <tr>
        <td colspan="2" align="center">Login Sebagai :</td>
      </tr>
      <tr>
        <td><button type="submit" name="admin">Administrator</button></td>
        <td><button type="submit" name="pd">Peserta Didik</button></td>
      </tr>
    </table>
  </form>
</body>
</html>