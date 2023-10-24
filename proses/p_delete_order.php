<!--  -->
<?php
include "connect.php";
$kodeorder = (isset($_POST['kodeorder'])) ? htmlentities($_POST['kodeorder']) : "";

if (!empty($_POST['delete_order_validate'])) {
    $select = mysqli_query($conn, "SELECT kode_order FROM tb_list_order WHERE kode_order = '$kodeorder'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
                    alert("The order has multiple items, Please clear the item menu first")
                    window.location="../order";
                    </script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_order WHERE id_order = '$kodeorder'");
        if ($query) {
            $message = '<script>
                        window.location="../order"; </script>';
        } else {
            $message = '<script>
                        alert("Order failed to delete")
                        window.location="../order"; </script>';
        }
    }
}
echo $message;
?>