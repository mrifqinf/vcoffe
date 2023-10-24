<?php
session_start();
include "connect.php";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";
if (!empty($_POST['submit_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' && password = '$password'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        $_SESSION['username_vcoffe'] = $username;
        $_SESSION['level_vcoffe'] = $hasil['level'];
        $_SESSION['id_vcoffe'] = $hasil['id'];
        header('location:../home');
    } else { ?>
        <script>
            alert('The username and password you entered are incorrect, please try again');
            window.location = '../login';
        </script>
<?php
    }
}
?>