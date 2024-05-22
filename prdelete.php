<?php
require('dbconnectpr.php');
$id = $_GET["idemp"];

$sql = "DELETE FROM programdata WHERE id = $id";
$result = mysqli_query($connect, $sql);

if ($result) {
    echo '<script>alert("ลบข้อมูลเรียบร้อย"); window.location.href = "prindex.php";</script>';
} else {
    echo "Error: " . mysqli_error($connect);
}

mysqli_close($connect);
?>
