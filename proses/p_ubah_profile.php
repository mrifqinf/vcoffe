<!--  -->
<?php
session_start();
include "connect.php";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
// $username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
// $level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";

if (!empty($_POST['ubah_profile_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET name='$name', nohp='$nohp' WHERE username = '$_SESSION[username_vcoffe]'");
    if ($query) {
        $message = '<script>
                    alert("Profile has been successfully Updated")
                    window.history.back();
                    </script>';
    } else {
        $message = '<script>
                    alert("Profile update failed")
                    window.history.back();
                    </script>';
    }
} else {
    $message = '<script>
                    alert("Profile update failed")
                    window.history.back();
                    </script>';
}
echo $message;
?>