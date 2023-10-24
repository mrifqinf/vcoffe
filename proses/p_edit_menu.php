<!--  -->
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stock = (isset($_POST['stock'])) ? htmlentities($_POST['stock']) : "";

if (!empty($_POST['input_menu_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_daftar_menu SET kategori='$kat_menu', nama_menu='$nama_menu', keterangan='$keterangan', harga='$harga', stock='$stock' WHERE id='$id'");
    if ($query) {
        $message = '<script>
                    window.location="../menu";
                    </script>';
    } else {
        $message = '<script>alert("Data failed to update")</script>';
    }
}
echo $message;
?>