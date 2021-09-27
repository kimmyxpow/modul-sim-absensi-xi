<?php date_default_timezone_set('Asia/Bangkok'); ?>

<?php
include "../config/database.php";

$perintah = new oop();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['nis'])) {
    $where = "nis = $_GET[nis]";
}
$query = "query_absen";
$table = "tbl_rombel";

if (!empty($_GET['rombel'])) {
    $isinya = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]'"));
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
                    <option value="<?= $isinya['id_rombel'] ?>"><?= $isinya['rombel'] ?></option>
                    <option value=""></option>
                    <?php
                    $a = $perintah->tampil("tbl_rombel");
                    foreach ($a as $r) {
                    ?>
                        <option value="<?= $r['id_rombel'] ?>"><?= $r['rombel'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal Absen</td>
            <td>:</td>
            <td>
                <select name="tgl" id="">
                    <?php
                    for ($tgl = 1; $tgl <= 31; $tgl++) {
                        if ($tgl <= 9) {
                    ?>
                            <option value="<?= "0" . $tgl; ?>"><?= "0" . $tgl; ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="<?= $tgl; ?>"><?= $tgl; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <select name="bln" id="">
                    <?php
                    for ($bln = 1; $bln <= 12; $bln++) {
                        if ($bln <= 9) {
                    ?>
                            <option value="<?= "0" . $bln; ?>"><?= "0" . $bln; ?></option>
                        <?php
                        } else {
                        ?>
                            <option value="<?= $bln; ?>"><?= $bln; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <select name="thn" id="">
                    <?php
                    for ($thn = 2011; $thn <= 2025; $thn++) {
                    ?>
                        <option value="<?= $thn; ?>"><?= $thn; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
            <td><input type="submit" name="cetak" value="Cetak" /></td>
        </tr>
    </table>
    <hr>
    <?php
    if (isset($_POST['cetak'])) {
        echo "
                <script>
                    document.location.href='?menu=ubahabsen&rombel=$_POST[rombel]&thn=$_POST[thn]&bln=$_POST[bln]&tgl=$_POST[tgl]'
                </script>
            ";
    }
    if (!empty($_GET['rombel'])) {
    ?>
        <br>
        <table border="1" cellspacing="0" align="center">
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
                <td>ijin</td>
                <td>Alpa</td>
            </tr>
            <?php
            $a = $perintah->tampil("query_absen WHERE id_rombel = '$_GET[rombel]' AND tgl_absen = '$_GET[thn]-$_GET[bln]-$_GET[tgl]'");
            $no = 0;
            if ($a == "") {
                echo "
                    <tr>
                        <td align='center' colspan='8'>NO RECORD</td>
                    </tr>
                ";
            } else {
                foreach ($a as $r) {
                    $no++;

                    if ($r['hadir'] == 1) {
                        $hadir = "checked";
                        $sakit = "";
                        $ijin = "";
                        $alpa = "";
                    }

                    if ($r['sakit'] == 1) {
                        $hadir = "";
                        $sakit = "checked";
                        $ijin = "";
                        $alpa = "";
                    }

                    if ($r['ijin'] == 1) {
                        $hadir = "";
                        $sakit = "";
                        $ijin = "checked";
                        $alpa = "";
                    }

                    if ($r['alpa'] == 1) {
                        $hadir = "";
                        $sakit = "";
                        $ijin = "";
                        $alpa = "checked";
                    }
            ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $r['nis'] ?></td>
                        <td><?= $r['nama'] ?></td>
                        <td><?= $r['rombel'] ?></td>
                        <td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="hadir" <?= $hadir ?> /></td>
                        <td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="sakit" <?= $sakit ?> /></td>
                        <td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="ijin" <?= $ijin ?> /></td>
                        <td><input type="radio" name="keterangan<?= $r['nis'] ?>" value="alpa" <?= $alpa ?> /></td>
                    </tr>
                    <?php
                    if (isset($_REQUEST['ubah'])) {
                        $tgl = date('Y-m-d');
                        $table = "tbl_absen";
                        $redirect = '?menu=ubahabsen';
                        $where = "nis = $r[nis]";

                        if ($_POST['keterangan' . $r['nis']] == 'hadir') {
                            $field = ['nis' => $r['nis'], 'hadir' => '1', 'sakit' => '0', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl];
                        } elseif ($_POST['keterangan' . $r['nis']] == 'sakit') {
                            $field = ['nis' => $r['nis'], 'hadir' => '0', 'sakit' => '1', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl];
                        } elseif ($_POST['keterangan' . $r['nis']] == 'ijin') {
                            $field = ['nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '1', 'alpa' => '0', 'tgl_absen' => $tgl];
                        } else {
                            $field = ['nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '0', 'alpa' => '1', 'tgl_absen' => $tgl];
                        }
                        $perintah->ubah($table, $field, $where, $redirect);
                    }
                    ?>
                    <tr>
                        <td colspan="10" align="center">
                            <input type="submit" name="ubah" value="Ubah">
                        </td>
                    </tr>
        </table>

<?php
                }
            }
        }
?>

</form>
<br />