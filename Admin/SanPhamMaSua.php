<?php
include("dbcon.php");
$tt = new dbcon();
session_start();
ob_start();

if(isset($_SESSION['taikhoan'])){
    if($_SESSION['taikhoan'] == "user"){
        header("location:../../../index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cheo Tea And Coffee</title>



</head>

<body>

    <?php

    if (isset($_GET['IdLoai'])) {
        include("dbcon.php");
        $tt = new dbcon;
        $kq = $tt->SuaMaSanPham_id($_GET['IdLoai']);
        $row = $kq->fetch_assoc()


    ?>

        <form id="edit_form_2" name="edit_form_2" method="post" action="process.php">

            <p>
                <label for="IdLoai"><b>Mã loại:</b></label>
                <input type="text" name="IdLoai" id="IdLoai" value="<?php echo $row['IdLoai']; ?>" />

            </p>

            <p>
                <label for="TenLoai"><b>Tên :</b></label>
                <input type="text" name="TenLoai" id="TenLoai" value="<?php echo $row['TenLoai']; ?>" />
            </p>
            <br>
            <br>
            <p>
                <input type="submit" name="suamasanpham" id="suamasanpham" value="ok" />
            </p>
        </form>
    <?php } ?>
</body>




</html>