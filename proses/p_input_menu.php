<!--  -->
<?php
include "connect.php";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stock = (isset($_POST['stock'])) ? htmlentities($_POST['stock']) : "";

$random_code = rand(10, 9999999) . "-";
$target_dir = "../assets/images/" . $random_code;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['input_menu_validate'])) {

    $check = getimagesize($_FILES['foto']['tmp_name']);
    if ($check == false) {
        $message = "Insert image files";
        $statusupload = 0;
    } else {
        $statusupload = 1;
        if (file_exists($target_file)) {
            $message = "Files are available";
            $statusupload = 0;
        } else {
            if ($_FILES['foto']['size'] > 5000000) {
                $message = "File too big";
                $statusupload = 0;
            } else {
                if ($image_type != "jpg" && $image_type != "jpeg" && $image_type != "png" && $image_type != "gif") {
                    $message = "Only format .jpg .jpeg .png .gif are Allowed";
                    $statusupload = 0;
                }
            }
        }
    }
    if ($statusupload == 0) {
        $message = '<script>
                    alert("' . $message . ', Image cannot be uploaded")
                    window.location="../menu";
                    </script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$nama_menu'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>
                        alert("The menu name already exists")
                        window.location="../menu";
                        </script>';
        } else {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $query = mysqli_query($conn, "INSERT INTO tb_daftar_menu (foto, nama_menu, keterangan, kategori, harga, stock) values ('" . $random_code . $_FILES['foto']['name'] . "','$nama_menu', '$keterangan', '$kat_menu', '$harga', '$stock')");
                if ($query) {
                    $message = '<script>window.location="../menu";
                                </script>';
                } else {
                    $message = '<script> alert("Data failed to enter")
                                window.location="../menu";
                                </script>';
                }
            } else {
                $message = '<script> alert("An error occurred, File could not be uploaded")
                            window.location="../menu";
                            </script>';
            }
        }
    }
}
echo $message;
?>