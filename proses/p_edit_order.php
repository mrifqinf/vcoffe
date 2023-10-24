<!--  -->
<?php
session_start();
include "connect.php";
$kodeorder = (isset($_POST['kodeorder'])) ? htmlentities($_POST['kodeorder']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['edit_order_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_order SET meja = '$meja', pelanggan = '$pelanggan', catatan = '$catatan' WHERE id_order = '$kodeorder'");
    if (!$query) {
        $message = '<script>
                        alert("Order failed to update")
                        window.location="../order";
                        </script>';
    } else {
        $message = '<script>
                    window.location="../order";
                    </script>';
    }
}

echo $message;
?>