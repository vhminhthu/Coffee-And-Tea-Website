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


    <form id="add_form_more" name="add_form_more" method="post" action="process.php">

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
        <p>
            <label for="SoLuong"><b>Số lượng:</b></label>
            <input type="text" name="SoLuong" id="SoLuong" />
        </p>

        <p>
            <label for="GiaTheoSize"><b>Giá thêm:</b></label>
            <input type="text" name="GiaTheoSize" id="GiaTheoSize" />
        </p>
     


<p> 
    <b><label for="TinhTrang">Tình Trạng:</label></b> 
        <select name="TinhTrang" id="TinhTrang">
            <option value="Đang bán">Đang bán</option>
            <option value="Hết hàng">Hết hàng</option>
        </select>

</p>

<br>
<br>
        <p>
            <input type="submit" name="monthem" id="monthem" value="+" />
        </p>
    </form>
</body>




</html>