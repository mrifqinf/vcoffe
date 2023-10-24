<!--  -->
<?php
session_start();
include "connect.php";
$kodeorder = (isset($_POST['kodeorder'])) ? htmlentities($_POST['kodeorder']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['input_order_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order = '$kodeorder'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
                    alert("Orders are available")
                    window.location="../order";
                    </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_order (id_order, meja, pelanggan, catatan, pelayan) values ('$kodeorder', '$meja', '$pelanggan', '$catatan', '$_SESSION[id_vcoffe]')");
        if (!$query) {
            $message = '<script>
                        alert("Order failed to input")
                        window.location="../order";
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