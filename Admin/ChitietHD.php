<?php

include("dbcon.php");
$tt = new dbcon();
ob_start();
session_start();
if(isset($_SESSION['taikhoan'])){
    if($_SESSION['taikhoan'] == "user"){
        header("location:../../../index.php");
    }
}

if (isset($_GET['IdHD'])) {
    $IdHD = $_GET['IdHD'];
} else {
    $IdHD = '1'; // Giá trị mặc định cho $idLoai
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cheo Tea And Coffee</title>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <ul class="menu">
                <li>
                    <span><b style="font-size: 21px;margin-top:20px">Cheo Tea&Coffee </b></span>
                </li>
                <br>
                <li>
                    <a href="Index.php">
                        <span><b style="font-size: 15px"> Admin </b></span>
                    </a>
                </li>
                <li>
                    <a href="Quanli.php">
                        <span><b style="font-size: 15px"> Quản lí </b></span>
                    </a>
                </li>
                <li class="active">
                    <a href="Catergory.php">
                        <span><b style="font-size: 15px"> Hóa đơn </b> </span>
                    </a>

                    <ul class="sub-menu">
                        <li> <a href="LichsuHD.php" class="sub-item">Lịch sử HĐ </a></li>
                    </ul>

                <li>
                    <a href="Sanpham.php">
                        <span><b style="font-size: 15px"> Drink </b></span>
                    </a>
                </li>
              
            </ul>
        </div>


        <div class="cart-main-left">
            <div class="cart-main-left-text-CTHD">
                <span>Mã CTHĐ </span>
                <span>IDHĐ</span>
                <span>ID sản phẩm</span>
                <span>Số lượng</span>
                <span>Đơn giá </span>
                <span>Ngày Đặt</span>
                <span>Ghi chú</span>
            </div>





            <div class="cart-main-left-list-CTHD">
                <?php
                $kq = $tt->ChiTietHoaDon($IdHD);
                while ($row = $kq->fetch_assoc()) {
                ?>
                    <div class="cart-main-left-list-sp-CTHD">
                        <div class="cart-main-left-list-sp-idcthd"><?php echo $row['IdCTHD']; ?> </div>
                        <div class="cart-main-left-list-sp-idhd"><?php echo $row['IdHD']; ?> </div>
                        <div class="cart-main-left-list-sp-name"><?php echo $row['IdSP']; ?> </div>
                        <div class="cart-main-left-list-sp-sl"><?php echo $row['SoLuong'];  ?> </div>
                        <div class="cart-main-left-list-sp-dg"><?php echo $row['DonGia']; ?>.000 đ </div>
                        <div class="cart-main-left-list-sp-date"><?php echo $row['NgayDat'];  ?> </div>
                        <div class="cart-main-left-list-sp-note"> I<?php echo $row['LuongDa']; ?>% S<?php echo $row['LuongDuong']; ?>% MT<?php echo $row['Them'];  ?> Size <?php echo $row['Size']; ?> </div>
                    </div>
                <?php } ?>
            </div>

        </div>


</body>

</html>