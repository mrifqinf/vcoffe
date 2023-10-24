<!--  -->
<?php
include "connect.php";
$id_kat_menu = (isset($_POST['id_kat_menu'])) ? htmlentities($_POST['id_kat_menu']) : "";
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : "";
$katmenu = (isset($_POST['katmenu'])) ? htmlentities($_POST['katmenu']) : "";

if (!empty($_POST['input_katmenu_validate'])) {
    $select = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu = '$katmenu'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
                    alert("Category is available")
                    window.location="../katmenu";
                    </script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_kategori_menu SET jenis_menu = '$jenismenu', kategori_menu = '$katmenu' WHERE id_kat_menu = '$id_kat_menu'");
        if ($query) {
            $message = '<script>
                        window.location="../katmenu";
                        </script>';
        } else {
            $message = '<script>
                        alert("Category failed to update")
                        window.location="../katmenu";
                        </script>';
        }
    }
}
echo $message;
?>