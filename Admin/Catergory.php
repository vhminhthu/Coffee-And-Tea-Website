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


if (isset($_POST['IdHD'])) {
    $IdHD = $_POST['IdHD'];
} else {
    $IdHD = '1'; // Giá trị mặc định cho $idHD
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
                </li>
                <li>
                    <a href="chatAdminList.php">
                        <span><b style="font-size: 15px"> Chat </b> </span>
                    </a>
                </li>
                <li>
                    <a href="Sanpham.php">
                        <span><b style="font-size: 15px"> Drink </b></span>
                    </a>
                </li>
               
            </ul>
        </div>


        <div class="cart-main-left">
            <div class="cart-main-left-text">
                <span>IDHĐ </span>
                <span>Mã khách</span>
                <span>Tổng tiền</span>
                <span>Ngày Đặt</span>
                <span>Trạng Thái</span>
                <span>Phương thức TT</span>
                <span>Tình Trạng TT</span>
               
            </div>


            <div class="cart-main-left-list">
                <?php
                $kq = $tt->HoaDon($IdHD);
                while ($row = $kq->fetch_assoc()) {
                ?>
                        <div class="cart-main-left-list-sp">
                            <div><?php echo $row['IdHD']; ?> </div>
                            <div><?php echo $row['IdKH']; ?> </div>
                            <div><?php echo $row['Tong']; ?>.000đ </div>
                            <div><?php echo $row['NgayDat'];  ?> </div>

                            <div>  <?php if ($row['TrangThai'] == 'Chưa giao') { ?>
                                 <form action="process.php" name="status_form" id="status_form" method="post" style="display: inline;">
                                        <input type="hidden" name="IdHD" id="IdHD" value="<?php echo $row['IdHD']; ?>">
                                            <span style="display: inline-block;">
                                                 <select  name="status_1" id="status_1">
                                                     <option value="Chưa giao">Chưa giao</option>
                                                     <option value="Đã giao">Đã giao</option>
                                                     <option value="Đã hủy">Đã hủy</option>
                                                 </select>
                                         <button type="submit" name="suatrangthai" id="suatrangthai" style="border: none; background: none; padding: 0; cursor: pointer;">
                                             <i class='bx bx-caret-right-circle bx-rotate-90' style='color:#712bdc; font-size: 20px; '></i>
                                         </button>
                                            </span>
                                 </form>
                                    <?php } else { ?>
                                        <?php echo $row['TrangThai']; ?>
                                             <?php } ?></div>
                            <div><?php echo $row['PhuongThucThanhToan'];  ?> </div>
                            <div> <?php echo $row['TinhTrang_ThanhToan']; ?></div>
                            <div><a href="ChitietHD.php?IdHD=<?php echo $row['IdHD']; ?>" style="text-decoration: none; color: #828282;">chi tiết</a></div>
                            
                        </div>
                <?php } ?>
            </div>

        </div>
        <script src="script.js"></script>
 
</body>

</html>