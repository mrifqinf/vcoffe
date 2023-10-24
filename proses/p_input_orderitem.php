<!--  -->
<?php
session_start();
include "connect.php";
$kodeorder = (isset($_POST['kodeorder'])) ? htmlentities($_POST['kodeorder']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";
$catatan_item = (isset($_POST['catatan_item'])) ? htmlentities($_POST['catatan_item']) : "";

if (!empty($_POST['input_orderitem_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order = '$kodeorder'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
                    alert("The item entered already exists")
                    window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                    </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_list_order (menu, kode_order, jumlah, catatan_item) values ('$menu', '$kodeorder', '$jumlah', '$catatan_item')");
        if (!$query) {
            $message = '<script>
                        alert("Item failed to input")
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