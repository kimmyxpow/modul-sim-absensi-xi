<?php

session_start();

include "../config/database.php";

if (isset($_POST['login'])) {
    $a = mysqli_query($conn, "SELECT * FROM tbl_siswa WHERE nis = '$_POST[user]'");
    $b = mysqli_fetch_array($a);
    $c = mysqli_num_rows($a);
    // var_dump($c);
    if ($c > 0) {
        $nama = $b['nama'];
        if ($_POST['pass'] == $_POST['user']) {
            $_SESSION['username'] = $_POST['user'];
            $_SESSION['password'] = $_POST['pass'];
            echo "
                <script>
                    alert('Selamat datang $nama');
                    document.location.href='hal_peserta_didik.php?menu=home'
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Username dan Password Tidak Sesuai !!');
                    document.location.href='index.php'
                </script>
            ";
        }
    } else {
        echo "
                <script>
                    alert('Username tidak terdaftar!!');
                    document.location.href='index.php'
                </script>
            ";
    }

    if (isset($_POST['batal'])) {
        echo "
            <script>
                document.location.href='../'
            </script>
        ";
    }
}

?>

<title>Login</title>
<form action="" method="POST">
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
                <input type="submit" name="login" value="LOGIN">
                <input type="submit" name="batal" value="BATAL">
            </td>
        </tr>
    </table>
</form>