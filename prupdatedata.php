<?php
require("dbconnectpr.php");

$id=$_POST["id"];
$datee=$_POST["datee"];
$timee=$_POST["timee"];
$nameinformer=$_POST["nameinformer"];
$namepg=$_POST["namepg"];
$problem=$_POST["problem"];
$cause=$_POST["cause"];
$Solution=$_POST["Solution"];
$datefinish=$_POST["datefinish"];
$timefinish=$_POST["timefinish"];
$timeesm=$_POST["timeesm"];

$sql = "UPDATE programdata SET id = '$id', datee = '$datee',timee = '$timee', nameinformer ='$nameinformer',namepg ='$namepg', problem = '$problem', cause	 = '$cause', Solution = '$Solution', datefinish	 = '$datefinish', timefinish = '$timefinish', timeesm	= '$timeesm'	 WHERE id = $id ";

$result=mysqli_query($connect,$sql);
if ($result) {
    echo '<script>alert("อัปเดตข้อมูลเรียบร้อย"); window.location.href = "prIndex.php";</script>';
} else {
    echo "Error: " . mysqli_error($connect);
}

mysqli_close($connect);
?>