<?php
require('dbconnect.php');

$id=$_POST["id"];
$datee=$_POST["datee"];
$time=$_POST["timee"];
$problem=$_POST["problem"];
$cause=$_POST["cause"];
$editproblem=$_POST["editproblem"]; 
$editdate=$_POST["editdate"];
$edittime=$_POST["edittime"];
$smtime=$_POST["smtime"];


$sql = "INSERT INTO dowtimedata(id,datee,timee,problem,cause,editproblem,editdate,edittime,smtime) VALUES('$id','$datee','$time','$problem','$cause','$editproblem','$editdate','$edittime','$smtime')";


$result=mysqli_query($connect,$sql);

if($result){
    echo '<script>alert("บันทึกข้อมูลเรียบร้อย"); window.location.href = "index.php";</script>';
}else{
   // echo mysqli_errors($connect);
}
?>