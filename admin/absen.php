<?php date_default_timezone_set('Asia/Bangkok'); ?>

<?php

include "../config/database.php";

$perintah = new Oop;

if (isset($_GET['rombel'])) {
  $isinya = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_rombel WHERE id_rombel='$_GET[rombel]'"));
  $rombel = $isinya['rombel'];
} else {
  $isinya = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_rombel"));
}

?>

<form action="" method="POST">
  <table align="center">
    <tr>
      <td>Pilih Rombel</td>
      <td>:</td>
      <td>
        <select name="rombel" id="">
          <?php $a = $perintah->tampil("tbl_rombel"); ?>
          <?php foreach ($a as $r) { ?>
            <option value="<?= $r['id_rombel'] ?>"><?= $r['rombel'] ?></option>
          <?php } ?>
        </select>
      </td>
      <td><input type="submit" name="cetak" value="Cetak"></td>
    </tr>
  </table>
  <hr>

  <?php
  if (isset($_POST['cetak'])) echo "<script>document.location.href='?menu=absen&rombel=$_POST[rombel]'</script>";

  if (!empty($_GET['rombel'])) {
    $tgl_sekarang = date('Y-m-d');
    $cek = mysqli_query($conn, "SELECT * FROM query_absen WHERE id_rombel = '$_GET[rombel]' AND tgl_absen = '$tgl_sekarang'");
  ?>
    <?php
    if (mysqli_num_rows($cek) != 0) {
        echo "<script>alert('Rombel $rombel sudah di absen hari ini'); document.location.href='?menu=absen'</script>";
    } else {
    ?>
      <br>
      <table border="1" align="center">
        <tr>
          <td rowspan="2">No</td>
          <td rowspan="2">NIS</td>
          <td rowspan="2">Nama</td>
          <td rowspan="2">Rombel</td>
          <td colspan="4" align="center">Keterangan</td>
        </tr>
        <tr>
          <td>Hadir</td>
          <td>Sakit</td>
          <td>Izin</td>
          <td>Alpa</td>
        </tr>
        <?php $a = mysqli_query($conn, "SELECT * FROM query_siswa WHERE id_rombel = $_GET[rombel]") ?>
        <?php $no = 0; ?>
        <?php if (mysqli_num_rows($a) == 0) { ?>
          <tr>
            <td align='center' colspan='8'>NO RECORD</td>
          </tr>
        <?php } else { ?>
          <?php foreach ($a as $r) { ?>
            <?php $no++; ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $r['nis'] ?></td>
              <td><?= $r['nama'] ?></td>
              <td><?= $r['rombel'] ?></td>
              <td><input type="radio" checked="checked" name="keterangan<?= $r['nis'] ?>" value="hadir" /></td>
              <td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="sakit" /></td>
              <td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="izin" /></td>
              <td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="alpa" /></td>
            </tr>
          <?php
            if (isset($_REQUEST['simpan'])) {
              $tgl = date('Y-m-d');
              $table = "tbl_absen";
              $redirect = '?menu=absen';
              if ($_POST['keterangan' . $r['nis']] == 'hadir') {
                $field = ['nis' => $r['nis'], 'hadir' => '1', 'sakit' => '0', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl];
              } elseif ($_POST['keterangan' . $r['nis']] == 'sakit') {
                $field = ['nis' => $r['nis'], 'hadir' => '0', 'sakit' => '1', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl];
              } elseif ($_POST['keterangan' . $r['nis']] == 'ijin') {
                $field = ['nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '1', 'alpa' => '0', 'tgl_absen' => $tgl];
              } else {
                $field = ['nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '0', 'alpa' => '1', 'tgl_absen' => $tgl];
              }
              $perintah->simpan($table, $field, $redirect);
            }
          }
          ?>
          <tr>
            <td colspan="10" align="center">
              <input type="submit" name="simpan" value="Simpan">
            </td>
          </tr>
      </table>
    <?php } ?>
  <?php   } ?>
<?php } ?>
</form>
<br />