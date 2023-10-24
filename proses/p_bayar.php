<!--  -->
<?php
session_start();
include "connect.php";
$kodeorder = (isset($_POST['kodeorder'])) ? htmlentities($_POST['kodeorder']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";
$uang = (isset($_POST['uang'])) ? htmlentities($_POST['uang']) : "";
$cashback = $uang - $total;
$forcashback = number_format($cashback, 2, ",", ".");

if (!empty($_POST['bayar_validate'])) {
    if ($cashback < 0) {
        $message = '<script>
                    alert("Payment failed, The nominal entered is insufficient")
                    window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                    </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar, nominal_uang, total_bayar) values ('$kodeorder', '$uang', '$total')");
        if (!$query) {
            $message = '<script>
                            alert("Payment failed")
                            window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                            </script>';
        } else {
            $message = '<script>
                            alert("Payment succcess \nReturn : Rp. ' . $forcashback . '")
                            window.location="../?x=orderitem&order=' . $kodeorder . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                            </script>';
        }
    }
}
echo $message;
?>