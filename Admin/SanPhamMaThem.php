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

    <form id="add_form_2" name="add_form_2" method="post" action="process.php">
        <p>
            <label for="IdLoai"><b> Mã loại:</b></label>
            <input type="text" name="IdLoai" id="IdLoai" />
        </p>

        <p>
            <label for="TenLoai"><b>Tên :</b></label>
            <input type="text" name="TenLoai" id="TenLoai" />
        </p>


        <br>
        <br>
        <p>
            <input type="submit" name="themmasanpham" id="themmasanpham" value="+" />
        </p>
    </form>
</body>




</html>