<!--  -->
<?php
include "connect.php";
$rname = (isset($_POST['rname'])) ? htmlentities($_POST['rname']) : "";
$rusername = (isset($_POST['rusername'])) ? htmlentities($_POST['rusername']) : "";
$rpassword = (isset($_POST['rpassword'])) ? md5(htmlentities($_POST['rpassword'])) : "";
$rnohp = (isset($_POST['rnohp'])) ? htmlentities($_POST['rnohp']) : "";
$rlevel = 5;

if (!empty($_POST['register_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$rusername'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
                    alert("Username already in use")
                    window.location="../register";
                    </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_user (name, username, nohp, level, password) values ('$rname', '$rusername', '$rnohp', '$rlevel', '$rpassword')");
        if (!$query) {
            $message = '<script>
                        alert("User failed to added")
                        window.location="../register";
                        </script>';
        } else {
            $message = '<script>
                        alert("Register Successfully")
                        window.location="../login";
                        </script>';
        }
    }
}
echo $message;
?>