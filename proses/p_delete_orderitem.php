<!--  -->
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kodeorder = (isset($_POST['kodeorder'])) ? htmlentities($_POST['kodeorder']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";

if (!empty($_POST['delete_orderitem_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_list_order WHERE id_list_order = '$id'");
    if ($query) {
        $message = '<script>
                    window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                    </script>';
    } else {
        $message = '<script>
                    alert("Item failed to delete")
                    window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                    </script>';
    }
}
echo $message;
?>