<?php
require("dbconnect.php");

$id=$_POST["id"];
$datee=$_POST["datee"];
$timee=$_POST["timee"];
$problem=$_POST["problem"];
$cause=$_POST["cause"];
$editproblem=$_POST["editproblem"];
$editdate=$_POST["editdate"];
$edittime=$_POST["edittime"];
$smtime=$_POST["smtime"];


$sql = "UPDATE dowtimedata SET id = '$id', datee = '$datee',timee = '$timee', problem ='$problem',cause ='$cause', editproblem = '$editproblem', editdate = '$editdate', edittime = '$edittime' WHERE id = $id ";

$result=mysqli_query($connect,$sql);
if ($result) {
    echo '<script>alert("อัปเดตข้อมูลเรียบร้อย"); window.location.href = "index.php";</script>';
} else {
    echo "Error: " . mysqli_error($connect);
}

mysqli_close($connect);
?>