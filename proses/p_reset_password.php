<!--  -->
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET password=md5('#lakukeras') WHERE id = '$id'");
    if ($query) {
        $message = '<script>
                    alert("Password has been successfully reset")
                    window.location="../user";
                    </script>';
    } else {
        $message = '<script>alert("Password reset failed")
                    window.location="../user";
                    </script>';
    }
}
echo $message;
?>