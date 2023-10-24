<!--  -->
<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$passwordlama = (isset($_POST['passwordlama'])) ? md5(htmlentities($_POST['passwordlama'])) : "";
$passwordbaru = (isset($_POST['passwordbaru'])) ? md5(htmlentities($_POST['passwordbaru'])) : "";
$repasswordbaru = (isset($_POST['repasswordbaru'])) ? md5(htmlentities($_POST['repasswordbaru'])) : "";

if (!empty($_POST['ubah_password_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_vcoffe]' && password = '$passwordlama'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        if ($passwordbaru == $repasswordbaru) {
            $query = mysqli_query($conn, "UPDATE tb_user SET password='$passwordbaru' WHERE username = '$_SESSION[username_vcoffe]'");
            if ($query) {
                $message = '<script>
                    alert("Password has been successfully changed")
                    window.history.back();
                    </script>';
            } else {
                $message = '<script>
                    alert("Password update failed")
                    window.history.back();
                    </script>';
            }
        } else {
            $message = '<script>
                    alert("New password is not the same")
                    window.history.back();
                    </script>';
        }
    } else {
        $message = '<script>
                    alert("Old password is wrong")
                    window.history.back();
                    </script>';
    }
} else {
    header('location../home');
}
echo $message;
?>