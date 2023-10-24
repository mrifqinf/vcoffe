<!--  -->
<?php
$conn = mysqli_connect("localhost", "Rifqi", "Rifqimuhammad", "db_vcoffe");
// $conn = mysqli_connect("sql206.epizy.com", "epiz_34003841", "BebTEs83cSb", "epiz_34003841_db_vcoffe");
if (!$conn) {
    echo "<div class='alert alert-danger'>Database connection failed</div>";
}
?>