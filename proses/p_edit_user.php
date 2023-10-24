<!--  -->
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";

if (!empty($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET name='$nama', nohp='$nohp', level='$level' WHERE id='$id'");
    if ($query) {
        $message = '<script>
                    window.location="../user";
                    </script>';
    } else {
        $message = '<script>alert("User data failed to update")
                    window.location="../user";
                    </script>';
    }
}
echo $message;
?>