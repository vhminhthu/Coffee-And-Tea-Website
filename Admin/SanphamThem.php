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


    <form id="add_form" name="add_form" method="post" action="process.php">

        <p>
            <label for="IdSP"><b>ID sản phẩm:</b></label>
            <input type="text" name="IdSP" id="IdSP" />

        </p>

        <p>
            <label for="TenSP"><b>Tên :</b></label>
            <input type="text" name="TenSP" id="TenSP" />
        </p>
        <p>
            <label for="IdLoai"><b> Mã loại:</b></label>
            <input type="text" name="IdLoai" id="IdLoai" />
        </p>
        <br>
        <div >
    <span><label for="gia_S"><b>Size S:</b></label></span>
    <span><input type="text" name="gia_S" id="gia_S" /></span>

    <span><label for="gia_M"><b>Size M:</b></label></span>
    <span><input type="text" name="gia_M" id="gia_M" /></span>

    <span><label for="gia_L"><b>Size L:</b></label></span>
    <span><input type="text" name="gia_L" id="gia_L" /></span>
</div>

   <br>


<div>
    <span>
        <b><label for="TinhTrang">Tình Trạng:</label></b> 
        <select name="TinhTrang" id="TinhTrang">
            <option value="Đang bán">Đang bán</option>
            <option value="Hết hàng">Hết hàng</option>
        </select>
    </span>
    <span>
        <label for="PhanTramSPKM"><b>Discount:</b></label>
    </span>
    <span>
        <input type="text" name="PhanTramSPKM" id="PhanTramSPKM" />
    </span>
</div>

        <p>
            <label for="HinhAnh"><b>Hình ảnh :</b></label>
            <input type="file" name="HinhAnh" id="HinhAnh" />
        </p>


        <p>
            <input type="submit" name="themsanpham" id="themsanpham" value="+" />
        </p>
    </form>
</body>




</html>