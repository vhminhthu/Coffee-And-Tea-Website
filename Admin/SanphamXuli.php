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
<div class="container">
        <div class="sidebar">
            <ul class="menu">
                <li>
                    <span><b style="font-size: 21px;margin-top:20px">Cheo Tea&Coffee </b></span>
                </li>
                <br>
                <li>
                    <a href="Quanli.php">
                        <span><b style="font-size: 15px"> ADMIN </b></span>
                    </a>
                </li>
                <li>
                    <a href="Catergory.php">
                        <span><b style="font-size: 15px"> Category </b> </span>
                    </a>
                </li>
                <li><a href="Sanpham.php">
                        <span><b style="font-size: 15px"> Drink </b></span>
                    </a>
                    <ul class="sub-menu">
                        <li> <a href="SanphamMa.php" class="sub-item">Mã sản phẩm</a></li>
                        <li class="active"> <a href="#" class="sub-item">Tìm kiếm</a></li>
                    </ul>
                </li>
                </li>
                <li class="logout">
                    <span><b style="font-size: 15px"> Logout</b></span>
                </li>
            </ul>
        </div>

        <?php
    if (isset($_GET['key'])) {
        switch ($_GET['key']) {
            case "sanpham":
                include("Sanpham.php");
                break;
            case "sanphamthem":
                include("SanphamThem.php");
                break;
            case "sanphamsua":
                include("SanphamSua.php");
                break;
            case "maspthem":
                include("SanPhamMaThem.php");
                break;
            case "maspsua":
                include("SanPhamMaSua.php");
                break;
            case "monthemadd":
                include("MonthemAdd.php");
                break;
            case "monthemedit":
                include("MonthemEdit.php");
                break;
        }
    }
    ?>
</body>




</html>