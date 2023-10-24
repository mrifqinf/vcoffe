<!--  -->
<?php
include "connect.php";
$id_kat_menu = (isset($_POST['id_kat_menu'])) ? htmlentities($_POST['id_kat_menu']) : "";

if (!empty($_POST['input_katmenu_validate'])) {
    $select = mysqli_query($conn, "SELECT kategori FROM tb_daftar_menu WHERE kategori = '$id_kat_menu'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
                    alert("Category is currently in use in Menu List, Category cannot be deleted")
                    window.location="../katmenu";
                    </script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_kategori_menu WHERE id_kat_menu = '$id_kat_menu'");
        if ($query) {
            $message = '<script>
                        window.location="../katmenu"; </script>';
        } else {
            $message = '<script>
                        alert("Category failed to delete")
                        window.location="../katmenu"; </script>';
        }
    }
}
echo $message;
?>