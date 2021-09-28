<?php

include "../config/database.php";

$perintah = new oop();

$table = "tbl_rombel";
$redirect = "?menu=rombel";

if (isset($_GET['id'])) {
  $where = "id_rombel = $_GET[id]";
}

if (isset($_POST['simpan'])) {
  $field = ['rombel' => $_POST['rombel']];
  $perintah->simpan($table, $field, $redirect);
}

if (isset($_GET['hapus'])) {
  $perintah->hapus($table, $where, $redirect);
}

if (isset($_GET['edit'])) {
  $edit = $perintah->edit($table, $where);
}

if (isset($_POST['ubah'])) {
  $field = ['rombel' => $_POST['rombel']];
  $perintah->ubah($table, $field, $where, $redirect);
}

?>

<?php if (isset($_GET['edit'])) { ?>
  <form action="" method="POST">
  <table align="center">
    <tr>
      <td>Rombel</td>
      <td>:</td>
      <td><input type="text" name="rombel" value="<?php echo $edit['rombel'] ?>" required placeholder="Rombel"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>
        <?php if ($_GET['id'] == "") { ?>
          <input type="submit" name="simpan" value="Simpan">
        <?php } else { ?>
          <input type="submit" name="ubah" value="Ubah">
        <?php } ?>
      </td>
    </tr>
  </table>
</form>
<?php } ?>
<br />

<table align="center" border="1">
  <tr>
    <td>No</td>
    <td>Rombel</td>
    <td colspan="2">Aksi</td>
  </tr>
  <?php $a = $perintah->tampil($table); ?>
  <?php $no = 0; ?>
  <?php if ($a == "") { ?>
    <tr><td align='center' colspan='4'>NO RECORD</td></tr>
  <?php } else { ?>
    <?php foreach ($a as $r) { ?>
      <?php $no++; ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $r['rombel'] ?></td>
        <td>
          <a href="?menu=rombel&edit&id=<?= $r['id_rombel'] ?>">
            <img src="../images/b_edit.png">
          </a>
        </td>
        <td>
          <a href="?menu=rombel&hapus&id=<?= $r['id_rombel'] ?>" onClick="return confirm('Hapus Data ?')">
            <img src="../images/b_drop.png">
          </a>
        </td>
      </tr>
  <?php } ?>
  <?php } ?>
</table>
<br />