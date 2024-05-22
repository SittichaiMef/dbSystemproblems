<?php
require("dbconnect.php");
$id=$_GET["id"];
$sql="SELECT * FROM dowtimedata WHERE id = $id";
$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มบันทึกปัญหา Dowtime</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy7Q1z4uug1JwAfuI1DTtmebLKBVbA" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js">
    </script>
    <link rel="icon"
        href="https://png.pngtree.com/png-clipart/20230801/original/pngtree-office-reports-icon-color-flat-picture-image_7811628.png"
        type="image/png">

    <!-- ... ส่วนอื่น ๆ ... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="container my-3">
        <h2 class="text-center">แบบฟอร์มบันทึกปัญหา Dowtime</h2>
        <form action="updatedata.php" method="POST">
            <input type="hidden" value="<?php echo $row["id"];?>" name="id">

            <div class="form-group">
                <label for="">วันที่แก้ไข</label>
                <input type="date" name="datee" id="" class="form-control" value="<?php echo $row["datee"];?>">
            </div>
            <div class="form-group">
                <label for="">เวลาที่แก้ไข</label>
                <input type="time" name="timee" id="timee" class="form-control" value="<?php echo $row["timee"];?>">
            </div>
            <div class="form-group">
                <label for="">ปัญหาระบบ</label>
                <input type="text" name="problem" class="form-control" required value="<?php echo $row["problem"];?>">
            </div>
            <div class="form-group">
                <label for="">สาเหตุที่ทำให้เกิดปัญหา</label>
                <input type="text" name="cause" class="form-control" required value="<?php echo $row["cause"];?>">
            </div>
            <div class="form-group">
                <label for="">วิธีแก้ไขปัญหา</label>
                <input type="text" name="editproblem" class="form-control" required
                    value="<?php echo $row["editproblem"];?>">
            </div>
            <div class="form-group">
                <label for="">วันที่แก้ไขเสร็จ</label>
                <input type="date" name="editdate" id="" class="form-control" required
                    value="<?php echo $row["editdate"];?>">
            </div>
            <div class="form-group">
                <label for="">เวลาที่แก้ไขเสร็จ</label>
                <input type="time" name="edittime" id="" class="form-control" required
                    value="<?php echo $row["edittime"];?>">
            </div>

            <div class="form-group">
                <label for="">ใช้เวลาแก้ไข (ชั่วโมง:นาที)</label>
                <input type="text" name="smtime" id="edittime" class="form-control" required readonly
                    value="<?php echo $row["smtime"];?>">
            </div>

            <script>
            // ใช้ JavaScript เพื่อคำนวณและแสดงผลในช่องเวลาที่แก้ไข
            document.getElementById('editTime').addEventListener('input', updateTotalTime);
            document.getElementById('timee').addEventListener('input', updateTotalTime);

            function updateTotalTime() {
                var editTimeInput = document.getElementById('editTime').value;
                var timeeInput = document.getElementById('timee').value;

                // ถ้าทั้งสองช่องมีข้อมูล
                if (editTimeInput && timeeInput) {
                    var editTime = new Date('2000-01-01T' + editTimeInput);
                    var timee = new Date('2000-01-01T' + timeeInput);

                    // คำนวณเวลาที่ใช้แก้ไข
                    var totalTimeInMilliseconds = editTime - timee;
                    var totalMinutes = Math.floor(totalTimeInMilliseconds / (1000 * 60));

                    // แปลงเวลาเป็น ชั่วโมง และ นาที
                    var hours = Math.floor(totalMinutes / 60);
                    var minutes = totalMinutes % 60;

                    // แสดงผลลัพธ์ในช่อง "ใช้เวลาแก้ไข"
                    document.getElementById('edittime').value = hours + ' ชม. ' + minutes + ' นาที';
                } else {
                    // ถ้ามีช่องใดช่องหนึ่งไม่มีข้อมูลให้ล้างค่าช่อง "ใช้เวลาแก้ไข"
                    document.getElementById('edittime').value = '';
                }
            }
            </script>
<!-- 
            <div class="form-group">
                <label for="">ผู้ดำเนินการ</label>
                <input type="text" name="operator" class="form-control" required value="<?php echo $row["operator"];?>">
            </div> -->

            <input type="submit" value="อัปเดตข้อมูล" class="btn btn-success">
            <input type="reset" value="ล้างข้อมูล" class="btn btn-danger">
            <a href="index.php" class="btn btn-primary">กลับหน้าแรก</a>
        </form>
    </div>
</body>

</html>