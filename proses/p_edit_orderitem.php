<!--  -->
<?php
session_start();
include "connect.php";
$idlistorder = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kodeorder = (isset($_POST['kodeorder'])) ? htmlentities($_POST['kodeorder']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";
$catatan_item = (isset($_POST['catatan_item'])) ? htmlentities($_POST['catatan_item']) : "";

if (!empty($_POST['edit_orderitem_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order = '$kodeorder' && id_list_order != '$idlistorder'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
                    alert("The item entered already exists")
                    window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                    </script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET menu='$menu', jumlah='$jumlah', catatan_item='$catatan_item' WHERE id_list_order='$idlistorder'");
        if (!$query) {
            $message = '<script>
                        alert("Item failed to update")
                        window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                        </script>';
        } else {
            $message = '<script>
                        window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                        </script>';
        }
    }
}
echo $message;
?>