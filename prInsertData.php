<?php
require('dbconnectpr.php');

$id=$_POST["id"];

$datee=$_POST["datee"];   //วันที่
$timee=$_POST["timee"];   //เวลา
$nameinformer=$_POST["nameinformer"]; //ชื่อผู้แจ้ง
$namepg=$_POST["namepg"]; //ชื่อโปรแกรท
$problem=$_POST["problem"]; //ปัญหา
$cause=$_POST["cause"]; // สาเหตุของปัญหา
$Solution=$_POST["Solution"]; // วิธีแก้ไขปัญหา
$datefinish=$_POST["datefinish"]; // วันที่เสร็จ
$timefinish=$_POST["timefinish"]; //เวลาที่เสร็จ
$timeesm=$_POST["timeesm"]; //รวมเวลาที่เสร็จ


$sql = "INSERT INTO programdata(id,datee,timee,nameinformer,namepg,problem,cause,Solution,datefinish,timefinish,timeesm) VALUES('$id','$datee','$timee','$nameinformer','$namepg','$problem','$cause','$Solution','$datefinish','$timefinish','$timeesm')";


$result=mysqli_query($connect,$sql);

if($result){
    echo '<script>alert("บันทึกข้อมูลเรียบร้อย"); window.location.href = "prIndex.php";</script>';
}else{
    echo mysqli_errors($connect);
}
?>
