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
                <li>
                    <a href="Catergory.php">
                        <span><b style="font-size: 15px"> Hóa đơn </b> </span>
                    </a>
                </li>
                <li>
                    <a href="chatAdminList.php">
                        <span><b style="font-size: 15px"> Chat </b> </span>
                    </a>
                </li>
                <li><a href="Sanpham.php">
                        <span><b style="font-size: 15px"> Drink </b></span>
                    </a>
                    <ul class="sub-menu">
                        <li> <a href="SanphamMa.php" class="sub-item">Mã sản phẩm</a></li>
                        <li class="active"> <a href="#" class="sub-item">Tìm kiếm</a></li>
                        <li> <a href="MonThem.php" class="sub-item">Món thêm</a></li>
                    </ul>
                </li>
                </li>
                
            </ul>
        </div>
        <div style="width: 100%;">
            <table class="content1">
                <tr>
                    <th width="70%" colspan="10">
                        <form method="post" action="SanphamTim.php">
                            <i style="font-size: 20px;" class='bx bx-search'></i>
                            <input type="text" class="tim_kiem" name="tim_kiem" placeholder="Type here..." autocomplete="off">
                            <input type="submit" class="find" name="find" value="Find">
                        </form>
                    </th>
                </tr>

                <?php
                if (isset($_POST['find'])) {
                    $kq_find = $tt->Search($_POST['tim_kiem']);
                    if ($kq_find) {
                        while ($row = $kq_find->fetch_assoc()) {
                ?>

                            <tr class="data-row">
                                <td><?php echo $row['IdSP']; ?></td>
                                <td><?php echo $row['TenSP']; ?></td>
                                <td><?php echo $row['IdLoai']; ?></td>
                                <td><?php echo $row['SoLuong']; ?></td>
                                <td>
                                    <b>S:</b> <?php echo $row['gia_S']; ?>.000đ <br>
                                     <b>M:</b> <?php echo $row['gia_M']; ?>.000đ <br>
                                     <b>L:</b> <?php echo $row['gia_L']; ?>.000đ
                                </td>
                                <td><?php echo "<img width=120px; height=120px src='HinhAnh/" . $row['HinhAnh'] . "'>"; ?></td>
                                <td width="100">
                                    <a href="process.php?xoasanpham=<?php echo $row['IdSP']; ?>" onclick="return confirm('Bạn có chắc chắn không ?');" class="delete-button"><i class='bx bxs-trash' style='color:rgba(243,64,139,0.93)'></i></a>
                                    <a href="SanphamXuli.php?key=sanphamsua&idSP=<?php echo $row['IdSP']; ?>" class="edit-button"><i class='bx bxs-edit' style='color:rgba(243,64,139,0.93)'></i></a>
                                </td>
                            </tr>
                <?php }
                    } else {
                        echo "khong tim kiếm duoc !";
                    }
                } ?>
            </table>
        </div>