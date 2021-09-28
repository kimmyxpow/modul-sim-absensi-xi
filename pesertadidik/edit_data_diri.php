<?php

include "../config/database.php";

$tampil = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM query_siswa WHERE nis = '$_SESSION[username]'"));

if (empty($_SESSION['username'])) {
    echo "
        <script>
            alert('Anda Belum Melakukan Login');
            document.location.href='index.php'
        </script>
    ";
}

if ($tampil['jk'] == "L") {
    $l = "checked";
    $p = "";
} else {
    $p = "checked";
    $l = "";
}

$date = explode("-", $tampil['tgl_lahir']);
$thn = $date[0];
$bln = $date[1];
$tgl = $date[2];

$perintah = new oop();

if (isset($_POST['ubah'])) {
    $table = "tbl_siswa";
    $tanggal = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
    $field = array('nama' => $_POST['nama'], 'jk' => $_POST['jk'], 'id_rayon' => $_POST['rayon'], 'id_rombel' => $_POST['rombel'], 'tgl_lahir' => $tanggal);
    $where = "nis = $_GET[nis]";
    $redirect = "?menu=lihat_data";
    echo $perintah->ubah($table, $field, $where, $redirect);
    echo "ok";
}

?>

<title>Form Siswa</title>
<form action="" method="POST">
    <table align="center">
        <tr>
            <td></td>
            <td><img src="../foto/<?= $tampil['foto'] ?>" border="5" height="175" width="155"></td>
            <td></td>
        </tr>
    </table>
    <table align="center">
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><?= $tampil['nis'] ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama" value="<?= $tampil['nama'] ?>"></td>
        </tr>
        <tr>
            <td>Kelamin</td>
            <td>:</td>
            <td>
                <input type="radio" name="jk" value="L" <?= $l ?> />Laki-laki
                <input type="radio" name="jk" value="P" <?= $p ?> />Perempuan
            </td>
        </tr>
        <tr>
            <td>Rayon</td>
            <td>:</td>
            <td>
                <select name="rayon" id="">
                    <?php
                    $E = mysqli_query($conn, "SELECT * FROM tbl_rayon");
                    while ($r = mysqli_fetch_array($E)) {
                        $selected = ($r[0] == $tampil['id_rayon']) ? 'selected' : '';
                    ?>
                        <option value="<?= $r[0] ?>" <?= $selected; ?>><?= $r[1] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Rombel</td>
            <td>:</td>
            <td>
                <select name="rombel" id="">
                    <?php
                    $E = mysqli_query($conn, "SELECT * FROM tbl_rombel");
                    while ($r = mysqli_fetch_array($E)) {
                        $selected = ($r[0] == $tampil['id_rombel']) ? 'selected' : '';
                    ?>
                        <option value="<?= $r[0] ?>" <?= $selected; ?>><?= $r[1] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>
                <select name="tgl" id="">
                    <option value="<?= $tgl; ?>"><?= $tgl; ?></option>
                    <option value="">-------</option>
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
                    <option value="<?= $bln; ?>"><?= $bln; ?></option>
                    <option value="">-------</option>
                    <?php
                    for ($bln = 1; $bln <= 12; $bln++) {
                        if ($bln <= 9) {
                    ?>
                            <option value="<?= "0" . $bln; ?>"><?= "0" . $bln; ?></option>
                        <?php
                        } else { ?>
                            <option value="<?= $bln; ?>"><?= $bln; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <select name="thn" id="">
                    <option value="<?= $thn; ?>"><?= $thn; ?></option>
                    <option value="">-------</option>
                    <?php
                    for ($thn = 1990; $thn <= 2012; $thn++) {
                    ?>
                        <option value="<?= $thn; ?>"><?= $thn; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="ubah" value="Ubah"></td>
        </tr>

    </table>
</form>