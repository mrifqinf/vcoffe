<!--  -->
<?php
session_start();
include "connect.php";
$idlistorder = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$catatan_item = (isset($_POST['catatan_item'])) ? htmlentities($_POST['catatan_item']) : "";

if (!empty($_POST['siapsaji_orderitem_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_list_order SET catatan_item='$catatan_item', status=2 WHERE id_list_order='$idlistorder'");
    if (!$query) {
        $message = '<script>
                    alert("Failed to be accepted by the kitchen")
                    window.location="../dapur";
                    </script>';
    } else {
        $message = '<script>
                    window.location="../dapur";
                    </script>';
    }
}
echo $message;
?>