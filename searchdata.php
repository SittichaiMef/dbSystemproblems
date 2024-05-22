<?php
require("dbconnect.php");

// ตรวจสอบการส่งข้อมูลจากฟอร์มค้นหา
if(isset($_POST["dowtimedata"])) {
    $name = $_POST["empname"];

    // สร้าง SQL สำหรับค้นหาข้อมูล
    echo $sql = "SELECT * FROM dowtimedata WHERE problem LIKE '%$name%' ORDER BY problem ASC";

    // ทำการคิวรีฐานข้อมูล
    $result = mysqli_query($connect, $sql);

    // นับจำนวนแถวที่ค้นพบ
    $count = mysqli_num_rows($result);
} else {
    // ถ้าไม่มีการส่งข้อมูลมาจากฟอร์ม ให้แสดงข้อมูลทั้งหมด
    echo $sql = "SELECT * FROM dowtimedata ORDER BY problem ASC";
    $result = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($result);
}

$order = 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกปัญหา Dowtime ระบบ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20230801/original/pngtree-office-reports-icon-color-flat-picture-image_7811628.png" type="image/png">

</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center">ข้อมูลบันทึก Dowtime ระบบ</h1>
        <hr>
        <form action="searchdata.php" class="form-group" method="POST">
            <label for="">ค้นหาปัญหาระบบ</label>
            <input type="text" placeholder="กรุณากรอกข้อมูลเพื่อค้นหา" name="dowtimedata" class="form-control">
            <input type="submit" value="ค้นหา" class="btn btn-primary my-2">
        </form>
        <a href="insertForm.php" class="btn btn-success">บันทึกปัญหา Dowtime ระบบ</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ลำดับ</th>
                    <th>วันที่</th>
                    <th>ปัญหาระบบ</th>
                    <th>สาเหตุที่ทำให้เกิดปัญหา</th>
                    <th>วิธีแก้ไขปัญหา</th>
                    <th>วันที่แก้ไขเสร็จ</th>
                    <th>ใช้เวลาแก้ไข</th>
                    <th>ผู้ดำเนินการ</th>
                    <th>แก้ไขข้อมูล</th>
                    <th>ลบข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $order++; ?></td>
                        <td><?php echo $row["datee"]; ?></td>
                        <td><?php echo $row["problem"]; ?></td>
                        <td><?php echo $row["cause"]; ?></td>
                        <td><?php echo $row["editproblem"]; ?></td>
                        <td><?php echo $row["editdate"]; ?></td>
                        <td><?php echo $row["edittime"]; ?></td>
                        <td><?php echo $row["operator"]; ?></td>
                        <td>
                            <a href="editform.php?id=<?php echo $row["id"] ?>" class="btn btn-primary">แก้ไข</a>
                        </td>
                        <td>
                            <a href="delete.php?idemp=<?php echo $row["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบหรือไม่ ?')">ลบข้อมูล</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
