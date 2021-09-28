<?php

include "../config/database.php";

$perintah = new oop();

$table = "tbl_rayon";
$redirect = "?menu=rayon";

if (isset($_GET['id'])) {
  $where = "id_rayon = $_GET[id]";
}

if (isset($_POST['simpan'])) {
  $field = ['rayon' => $_POST['rayon']];
  $perintah->simpan($table, $field, $redirect);
}

if (isset($_GET['hapus'])) {
  $perintah->hapus($table, $where, $redirect);
}

if (isset($_GET['edit'])) {
  $edit = $perintah->edit($table, $where);
}

if (isset($_POST['ubah'])) {
  $field = ['rayon' => $_POST['rayon']];
  $perintah->ubah($table, $field, $where, $redirect);
}

?>

<?php if (isset($_GET['edit'])) { ?>
  <form action="" method="POST">
  <table align="center">
    <tr>
      <td>Rayon</td>
      <td>:</td>
      <td><input type="text" name="rayon" value="<?= $edit['rayon'] ?>" required placeholder="Rayon"></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>
        <?php if ($_GET['id'] == "") { ?>
          <button name="simpan" type="submit">Simpan</button>
        <?php } else { ?>
          <button name="ubah" type="submit">Ubah</button>
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
    <td>Rayon</td>
    <td colspan="2">Aksi</td>
  </tr>
  <?php $a = $perintah->tampil($table); ?>
  <?php $no = 0; ?>
  <?php if ($a == "") { ?>
    <tr>
      <td align='center' colspan='4'>NO RECORD</td>
    </tr>
  <?php   } else { ?>
    <?php foreach ($a as $r) { ?>
      <?php $no++; ?>
      <tr>
        <td><?= $no; ?></td>
        <td><?= $r['rayon'] ?></td>
        <td>
          <a href="?menu=rayon&edit&id=<?= $r['id_rayon'] ?>">
            <img src="../images/b_edit.png">
          </a>
        </td>
        <td>
          <a href="?menu=rayon&hapus&id=<?= $r['id_rayon'] ?>" onClick="return confirm('Hapus Data ?')">
            <img src="../images/b_drop.png">
          </a>
        </td>
      </tr>
  <?php } ?>
  <?php } ?>
</table>
<br />