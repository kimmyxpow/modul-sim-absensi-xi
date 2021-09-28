<?php

require "../config/database.php";

$perintah = new oop();

$table = "tbl_siswa";
$query = "query_siswa";
if (isset($_GET['id'])) {
   $where = "nis = {$_GET['id']}";
}
$redirect = "?menu=siswa";

$tempat = "../foto";

if (isset($POST['simpan'])) {
   $tanggal = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
   $foto = $_FILES['foto'];
   $upload = $perintah->upload($foto, $tempat);
   $field = [
      'nis' => $_POST['nis'],
      'nama' => $_POST['nama'],
      'jk' => $_POST['jk'],
      'id_rayon' => $_POST['rayon'],
      'id_rombel' => $_POST['rombel'],
      'foto' => $upload,
      'tgl_lahir' => $tanggal
   ];
   $perintah->simpan($table, $field, $redirect);
}

if (isset($_GET['hapus'])) {
   $perintah->hapus($table, $where, $redirect);
}

if (isset($_GET['edit'])) {
   $edit = $perintah->edit($query, $where);
   if ($edit['jk'] == "L") {
      $l = "checked";
      $p = "";
   } else {
      $p = "checked";
      $l = "";
   }

   $date = explode("-", $edit['tgl_lahir']);
   $thns = $date[0];
   $blns = $date[1];
   $tgls = $date[2];
}

if (isset($_POST['ubah'])) {
   $tanggal = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
   $foto = $_FILES['foto'];
   $upload = $perintah->upload($foto, $tempat);
   if (empty($_FILES['foto']['name'])) {
      $field = [
         'nis' => $_POST['nis'],
         'nama' => $_POST['nama'],
         'jk' => $_POST['jk'],
         'id_rayon' => $_POST['rayon'],
         'id_rombel' => $_POST['rombel'],
         'tgl_lahir' => $tanggal
      ];
      $perintah->ubah($table, $field, $where, $redirect);
   } else {
      $field = [
         'nis' => $_POST['nis'],
         'nama' => $_POST['nama'],
         'jk' => $_POST['jk'],
         'id_rayon' => $_POST['rayon'],
         'id_rombel' => $_POST['rombel'],
         'foto' => $upload,
         'tgl_lahir' => $tanggal
      ];
      $perintah->ubah($table, $field, $where, $redirect);
   }
}

?>

<?php if (isset($_GET['edit'])) { ?>
   <form method="post" enctype="multipart/form-data" action="">
      <table align="center">
         <tr>
            <td>NIS</td>
            <td> : </td>
            <td><input type="text" name="nis" value="<?= $edit['nis']; ?>" required></td>
         </tr>
         <tr>
            <td>Nama</td>
            <td> : </td>
            <td><input type="text" name="nama" value="<?= $edit['nama']; ?>" required></td>
         </tr>
         <tr>
            <td>Jenis Kelamin</td>
            <td> : </td>
            <td>
               <input type="radio" name="jk" require value="L" <?= $l; ?>>Laki-laki
               <input type="radio" name="jk" require value="P" <?= $p; ?>>Perempuan
            </td>
         </tr>
         <tr>
            <td>Rayon</td>
            <td> : </td>
            <td>
               <select name="rayon" required>
                  <?php $a = $perintah->tampil("tbl_rayon"); ?>
                  <?php foreach ($a as $r) { ?>
                     <?php $selected = ($r["id_rayon"] == $edit['id_rayon']) ? 'selected' : ''; ?>
                     <option value="<?= $r["id_rayon"]; ?>" <?= $selected; ?>><?= $r["rayon"]; ?></option>
                  <?php } ?>
               </select>
            </td>
         </tr>
         <tr>
            <td>Rombel</td>
            <td> : </td>
            <td>
               <select name="rombel" required>
                  <?php $a = $perintah->tampil("tbl_rombel"); ?>
                  <?php foreach ($a as $r) { ?>
                     <?php $selected = ($r["id_rombel"] == $edit['id_rayon']) ? 'selected' : ''; ?>
                     <option value="<?= $r["id_rombel"]; ?>"><?= $r["rombel"]; ?></option>
                  <?php } ?>
               </select>
            </td>
         </tr>
         <tr>
            <td>Foto</td>
            <td> : </td>
            <td><input type="file" name="foto"></td>
         </tr>
         <tr>
            <td>Tanggal Lahir</td>
            <td> : </td>
            <td>
               <select name="tgl" required>
                  <?php for ($tgl = 1; $tgl < 31; $tgl++) { ?>
                     <?php $selected = ($tgl == $tgls) ? 'selected' : ''; ?>
                     <?php if ($tgl <= 9) { ?>
                        <option value="<?= "0{$tgl}"; ?>" <?= $selected; ?>><?= "0{$tgl}"; ?></option>
                     <?php } else { ?>
                        <option value="<?= $tgl; ?>" <?= $selected; ?>><?= $tgl; ?></option>
                     <?php } ?>
                  <?php } ?>
               </select>
               <select name="bln" required>
                  <?php for ($bln = 1; $bln < 12; $bln++) { ?>
                     <?php $selected = ($bln == $blns) ? 'selected' : ''; ?>
                     <?php if ($bln <= 9) { ?>
                        <option value="<?= "0{$bln}"; ?>" <?= $selected; ?>><?= "0{$bln}"; ?></option>
                     <?php } else { ?>
                        <option value="<?= $bln; ?>" <?= $selected; ?>><?= $bln; ?></option>
                     <?php } ?>
                  <?php } ?>
               </select>
               <select name="thn" required>
                  <?php for ($thn = 1989; $thn < 2025; $thn++) { ?>
                     <?php $selected = ($thn == $thns) ? 'selected' : ''; ?>
                     <option value="<?= $thn; ?>"><?= $thn; ?></option>
                  <?php } ?>
               </select>
            </td>
         </tr>
         <tr>
            <td></td>
            <td></td>
            <td>
               <?php if ($_GET['id'] == "") echo '<button type="submit" name="simpan">Simpan</button>';
               else echo '<button type="submit" name="ubah">Ubah</button>'; ?>
            </td>
         </tr>
      </table>
   </form>
<?php } ?>
<br>
<table align="center" border="1">
   <tr>
      <td>No</td>
      <td>NIS</td>
      <td>Nama</td>
      <td>Jk</td>
      <td>Rayon</td>
      <td>Rombel</td>
      <td>Foto</td>
      <td>Tanggal Lahir</td>
      <td colspan="2">Aksi</td>
   </tr>
   <?php $a = $perintah->tampil("query_siswa"); ?>
   <?php $no = 0; ?>
   <?php if ($a == "") { ?>
      <tr>
         <td align="center" colspan="10">NO RECORD</td>
      </tr>
   <?php } else { ?>
      <?php foreach ($a as $r) { ?>
         <?php $no++; ?>
         <tr>
            <td><?= $no; ?></td>
            <td><?= $r['nis']; ?></td>
            <td><?= $r['nama']; ?></td>
            <td><?= $r['jk']; ?></td>
            <td><?= $r['rayon']; ?></td>
            <td><?= $r['rombel']; ?></td>
            <td>
               <img src="../foto/<?= $r['foto']; ?>" width="50" height="50" alt="<?= $r['nama']; ?>">
            </td>
            <td><?= $r['tgl_lahir']; ?></td>
            <td>
               <a href="?menu=siswa&hapus&id=<?= $r['nis']; ?>" onclick="return confirm('Hapus Record?')">
                  <img src="../images/b_drop.png" alt="Hapus">
               </a>
            </td>
            <td>
               <a href="?menu=siswa&edit&id=<?= $r['nis']; ?>">
                  <img src="../images/b_edit.png" alt="Edit">
               </a>
            </td>
         </tr>
      <?php } ?>
   <?php } ?>
</table>