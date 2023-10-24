<?php
// session_start();
if (empty($_SESSION['username_vcoffe'])) {
    header('location:login');
}

include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_vcoffe]'");
$hasil = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="icon" href="assets/images/icon_title.png" type="png" sizes="16x16">
    <title>Cafe V-Coffe</title>
    <?php
    $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
    ?>
</head>

<body style="background-color: #E4D0D0;">
    <!-- HEADER -->
    <?php include "header.php"; ?>
    <!-- END HEADER -->
    <div class="contrainer-lg p-3">
        <div class="row mb-3">
            <!-- SIDEBAR -->
            <?php include "sidebar.php"; ?>
            <!-- END SIDEBAR -->

            <!-- CONTENT -->
            <?php include $page; ?>
            <!-- END CONTENT -->
        </div>
    </div>
    <!-- MAINTENANCE WARNING -->
    <!-- <div class="text-center"> -->
    <!-- <h6><i class="bi bi-exclamation-triangle"></i> WEBSITE IS UNDER MAINTENANCE <i class="bi bi-exclamation-triangle"></i></h6> -->
    <!-- </div> -->
    <!-- END MAINTENANCE WARNING -->
    <!-- FOOTER -->
    <div class="fixed-bottom text-center p-2 text-light" style="background-color: #85586F; font-size: 12px;">
        Copryright&copy;2023 Muhammad Rifqi Nurfadillah
    </div>
    <!-- END FOOTER -->

    <!-- SCRIPT FOR FORM VALIDATION FROM BOOTSTRAP -->
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <!-- END SCRIPT FOR FORM VALIDATION FROM BOOTSTRAP -->
</body>

</html>