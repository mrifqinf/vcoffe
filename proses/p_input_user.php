<!--  -->
<?php
include "connect.php";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";

if (!empty($_POST['input_user_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
                    alert("Username already in use")
                    window.location="../user";
                    </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_user (name, username, nohp, level, password) values ('$nama', '$username', '$nohp', '$level', '$password')");
        if (!$query) {
            $message = '<script>
                        alert("User failed to added")
                        window.location="../user";
                        </script>';
        } else {
            $message = '<script>
                        window.location="../user";
                        </script>';
        }
    }
}
echo $message;
?>