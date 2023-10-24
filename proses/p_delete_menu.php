<!--  -->
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";

if (!empty($_POST['input_menu_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_daftar_menu WHERE id = '$id'");
    if ($query) {
        unlink("../assets/images/$foto");
        $message = '<script>
                    window.location="../menu"; </script>';
    } else {
        $message = '<script>alert("Data failed to deleted")
                    window.location="../menu"; </script>';
    }
}
echo $message;
?>