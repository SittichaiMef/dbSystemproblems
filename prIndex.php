<?php
require('dbconnectpr.php');
if (isset($_POST["empname"])) {
    if (isset($_POST["year"]) && isset($_POST["month"])) {
        $sql = "SELECT * FROM programdata WHERE namepg like '$_POST[empname]%' AND datee LIKE '$_POST[year]-$_POST[month]%'";
    } else {
        $sql = "SELECT * FROM programdata WHERE namepg like '$_POST[empname]%';";
    }
    // $key = $_POST["empname"];
} else {
    if (isset($_POST["year"]) && isset($_POST["month"])) {
        $sql = "SELECT * FROM programdata WHERE datee LIKE '$_POST[year]-$_POST[month]%'";
    } else {
        $sql = "SELECT * FROM programdata ;";
    }
}

$result = mysqli_query($connect, $sql);


?>

<?php
if (isset($_POST['signaturesubmit'])) {
    $signature = $_POST['signature'];

    // Get current timestamp
    $currentTimestamp = time();

    // Generate filename with current date and unique identifier
    $formattedDate = date('Ymd_His', $currentTimestamp);
    $uniqueId = uniqid();
    $signatureFileName = "{$formattedDate}_{$uniqueId}.png";

    // Process signature
    $signature = str_replace('data:image/png;base64,', '', $signature);
    $signature = str_replace(' ', '+', $signature);
    $data = base64_decode($signature);
    $file = 'signatures/' . $signatureFileName;

    // Save file
    if (file_put_contents($file, $data)) {
        $msg = "<div class='alert alert-success'>Signature Uploaded</div>";
    } else {
        // Handle file saving error
        $msg = "<div class='alert alert-danger'>Error saving the signature</div>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มบันทึกปัญหาที่เดิกจากโปรแกรม</title>
    <link rel="icon"
        href="https://png.pngtree.com/png-clipart/20230801/original/pngtree-office-reports-icon-color-flat-picture-image_7811628.png"
        type="image/png">
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="header_img">
        <img src="assets\bg1.png" alt="" style="width:100%; height: 280px;">
    </div>

    <div class="container-fluid">

        <ul class="nav nav-tabs nav-tabs_custom">
            <li><a href="index.php"><i class="fa-solid fa-floppy-disk"></i> ปัญหาที่เกิดจากโปรแกรม</a></li>
            <li class="active"><a data-toggle="tab" href="prindex.php"><i class="fa-solid fa-circle-exclamation"></i>
                    ปัญหาที่เกิดจากโปรแกรม</a></li>

        </ul>
        <!--<form action="index.php" class="form-group d-flex" method="POST">
            <input type="text" placeholder="กรุณากรอบข้อมูลเพื่อค้นหา" name="empname" class="form-control">
            <input type="submit" name="dowtimedata" value="ค้นหา" class="btn btn-primary ml-2">
        </form> -->
        <div class="d-flex justify-content-between align-items-center bg-light header_config ">

            <form id="app-cover" class="d-flex col-12" action="prindex.php" method="post">
                <div class="row">
                    <div class="input-group col-md-2 col-lg-3 col-sm-12 ">
                        <a href="prInsertForm.php" class="btn btn-success"
                            style="width: 75%;"><i class="fa-solid fa-plus"></i> &nbsp เพิ่มปัญหาที่เกิดจากโปรแกรม</a>
                    </div>
                    <div class="input-group col-md-4 col-lg-3 col-sm-12">
                        <label for="select_year" class="col-form-label">เลือกปี:</label>
                        <div class="select">
                            <select name="year" id="select_year" class="select_c">
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                            <span class="focus"></span>
                        </div>
                    </div>


                    <div class="input-group col-md-4 col-lg-3 col-sm-12">
                        <label for="select_month" class="col-form-label">เลือกเดือน:</label>
                        <div class="select">
                            <select name="month" id="select_month">
                                <option value="01">มกราคม</option>
                                <option value="02">กุมภาพันธ์</option>
                                <option value="03">มีนาคม</option>
                                <option value="04">เมษายน</option>
                                <option value="05">พฤษภาคม</option>
                                <option value="06">มิถุนายน</option>
                                <option value="07">กรกฎาคม</option>
                                <option value="08">สิงหาคม</option>
                                <option value="09">กันยายน</option>
                                <option value="10">ตุลาคม</option>
                                <option value="11">พฤศจิกายน</option>
                                <option value="12">ธันวาคม</option>
                                <!-- เพิ่มตัวเลือกเดือนตามความต้องการ -->
                            </select>
                            <span class="focus"></span>
                        </div>
                    </div>

                    <div class="input-group col-md-2 col-lg-2 col-sm-12">
                        <button class="btn btn-primary " type="submit" style="width: 75%;"><i class="fa-solid fa-magnifying-glass"></i> &nbsp ค้นหา</button>
                    </div>


                </div>
            </form>

            <div class="row" style="margin:5px;">
                <div class="input-group col-md-8 col-sm-8 col-lg-8">
                    <form action="prindex.php" class="search-container" method="POST" style="width: 100%;">
                        <input type="text" id="search-bar" placeholder="กรุณากรอกชื่อโปรแกรมเพื่อค้นหา" name="empname"
                            class="form-control">
                            <button type="submit" name="programdata" value="ค้นหา" id="search-button" style="padding: 5px;width: 120px;"><i class="fa-solid fa-magnifying-glass"></i> &nbsp ค้นหา</button>

                    </form>
                </div>
                <div class="input-group col-md-4 col-sm-4 col-lg-4">
                    <form action="" method="post" style="width: 100%;">
                        <button class="btncle" type="submit" name="clear">ล้างการค้นหาข้อมูล</button>
                    </form>
                </div>


            </div>

            <!--<form action="index.php">
                    <div class="search-container">
                        <input type="text" id="search-bar" name="empname" placeholder="ค้นหาปัญหาระบบของระบบ....">
                        <button type="button"type="submit" name="dowtimedata"value="ค้นหา" id="search-button">ค้นหา</button>
                    </div>
                </form>-->

        </div>


    </div>



    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ลำดับ</th>
                <th>แจ้งปัญหา</th>
                <th>ชื่อผู้แจ้ง</th>
                <th>ชื่อโปรแกรม</th>
                <th>ปัญหา</th>
                <th>สาเหตุของปัญหา</th>
                <th>วิธีแก้ไขปัญหา</th>
                <th>วันที่แก้ไขเสร็จ</th>
                <th>ใช้เวลาแก้ไขทั้งหมด</th>
                <th>ผู้ดำเนินการ</th>
                <th>ผู้ตรวจสอบ</th>
                <th>แก้ไขข้อมูล</th>
                <th>ลบข้อมูล</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $u = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $operator = $row["signature_operator"];
                $inspector = $row["signature_inspector"];
                $u++;
            ?>
            <tr>
                <td><?php echo $u; ?></td>
                <td><?php
                        $data_date = $row["datee"] . '  ' . $row["timee"];
                        $date = date_create($data_date);
                        echo date_format($date, "d/M/Y "); echo "<br>".$row["timefinish"];
                        ?>


                <td><?php echo $row["nameinformer"]; ?></td>
                <td><?php echo $row["namepg"]; ?></td>
                <td><?php echo $row["problem"]; ?></td>
                <td><?php echo $row["cause"];?></td>

                <td><?php echo $row["Solution"];?></td>
                <td><?php
                        $data_date = $row["datefinish"] . ' ' . $row["timefinish"];
                        $date = date_create($data_date);
                        echo date_format($date, "d/M/Y"); echo "<br>".$row["timefinish"];
                        ?>

                <td><?php
                        $data_date = $row["datee"] . ' ' . $row["timee"];
                        $data_date2 = $row["datefinish"] . '' . $row["timefinish"];


                        $date1 = new DateTime($data_date);
                        $date2 = new DateTime($data_date2);
                        $interval = $date1->diff($date2);
                        echo $interval->d . " วัน " . $interval->h . " ชม. " . $interval->i . " นาที.";
                        ?>



                <td>

                    <?php if (!$row["signature_operator"]) : ?>
                    <a href="signaturepr.php?id=<?= $row["id"] ?>&act=A" role="button" class="btn btn-info"
                        data-bs-toggle="modal" data-bs-target="#operatorModal<?= $operator ?>">
                        <i class="fas fa-edit"></i>
                    </a>

                    <?php else : ?>
                    <img src="signatures/<?= $operator ?>.png" alt="" style="max-width: 100px; height: 50px;">
                    <?php endif; ?>

                </td>
               <td>

                    <?php if (!$row["signature_inspector"]) : ?>
                    <a href="signaturepr.php?id=<?= $row["id"] ?>&act=B" role="button" class="btn btn-info"
                        data-bs-toggle="modal" data-bs-target="#operatorModal<?= $operator ?>">
                        <i class="fas fa-edit"></i>
                    </a>

                    <?php else : ?>
                    <img src="signatures/<?= $inspector ?>.png" alt="" style="max-width: 100px; height: 50px;">
                    <?php endif; ?>

                </td> 





                <td>
                    <a href="preditform.php?id=<?php echo $row["id"] ?>" class="btn btn-primary">แก้ไข</a>
                </td>
                <td>
                    <a href="prdelete.php?idemp=<?php echo $row["id"]; ?>" class="btn btn-danger"
                        onclick="return confirm('คุญต้องการลบหรือไหม ?')">ลบข้อมูล</a>
                </td>

            </tr>

            <?php } ?>

        </tbody>
    </table>




</body>

</html>