<?php
    include "../config/database.php";
    include "../library/controllers.php";
    $perintah = new oop();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN KEHADIRAN DETAIL</title>
    <style>
        .utama {
            margin: 0 auto;
            border: thin solid #000;
            width: 700px;
        }
        .print {
            margin: 0 auto;
            width: 700px;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <a href="#" onClick="document.getElementById('print').style.display='none'; window.print();">
        <img src="../images/print-icon.png" id="print" width="25" height="25" border="0" />
    </a>

    <div class="utama">
        <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top: 10px;">
            <tr>
                <td width="7%" rowspan="3" align="center" valign="top">
                    <img src="../images/logo.png" width="55" height="55">
                </td>
                <td width="93%" valign="top">
                    <strong>&nbsp; LAPORAN KEHADIRAN</strong>
                </td>
                <tr>
                    <td valign="top">&nbsp; SMK Wikrama Kota Bogor</td>
                </tr>
                <tr>
                    <td valign="top">&nbsp; Ilmu yang Amaliah, Amal yang Ilmiah, Akhlakul Karimah</td>
                </tr>
            </tr>
        </table>
        <table width="100%">
            <tr><td><hr></td></tr>
        </table>
        <table cellspacing="1" align="center" border="1">
            <tr align="center">
                <td rowspan="2" width="30">No</td>
                <td rowspan="2" width="100">NIS</td>
                <td rowspan="2" width="150">Nama</td>
                <td rowspan="2" width="100">Rombel</td>
                <td colspan="4">Keterangan</td>
                <td rowspan="2" width="100">Tanggal</td>
            </tr>
            <tr align="center" bgcolor="#ffffff">
                <td width="30">H</td>
                <td width="30">S</td>
                <td width="30">I</td>
                <td width="30">A</td>
            </tr>
            <?php
                $a = $perintah->tampil("query_absen WHERE nis = '$_GET[nis]'");
                $no = 0;
                if ($a == "") {
                    echo "
                        <table>
                            <tr>
                                <td colspan='9'>NO RECORDS</td>
                            </tr>
                        </table>
                    ";
                } else {
                    foreach ($a as $r) {
                        $no++;
            ?>
            <tr align="center">
                <td><?php echo $no ?></td>
                <td><?php echo $r['nis'] ?></td>
                <td><?php echo $r['nama'] ?></td>
                <td><?php echo $r['rombel'] ?></td>
                <td><?php echo $r['hadir'] ?></td>
                <td><?php echo $r['sakit'] ?></td>
                <td><?php echo $r['ijin'] ?></td>
                <td><?php echo $r['alpa'] ?></td>
                <td><?php echo $r['tgl_absen'] ?></td>
            </tr>
            <?php
                    }
                }
            ?>
        </table>
    </div>

    <center>
        <p>&copy; <?php echo date('Y'); ?>SMK WIKRAMA BOGOR</p>
    </center>

</body>
</html>