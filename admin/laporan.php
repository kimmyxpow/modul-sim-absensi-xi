<?php
    date_default_timezone_set('Asia/Bangkok');
?>

<?php
    include "../config/database.php";

    $perintah = new oop();

    if (!empty($_GET['rombel'])) {
        $isinya = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]'"));
    } else {
        $isinya = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_rombel"));
    }
?>

<title>Laporan Absensi</title>
<br>
<center>
    <font size="+3">Form Laporan Absensi</font>
</center>
<hr>
<form action="" method="POST">
    <table align="center">
        <tr>
            <td>Pilih Rombel</td>
            <td>:</td>
            <td>
                <select name="rombel" id="">
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
            <td><input type="submit" name="cetak" value="Cetak"></td>
        </tr>
    </table>
    <br />
    <?php
        if (isset($_POST['cetak'])) {
            echo "
                <script>
                    document.location.href='laporan_today.php?menu=laporan&rombel=$_POST[rombel]'
                </script>
            ";
        }
    ?>
</form>
<br />