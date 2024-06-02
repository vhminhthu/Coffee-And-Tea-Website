<?php
include("dbcon.php");
$tt = new dbcon();
session_start();
ob_start();
if (isset($_POST['idSP'])) {
    $idSP = $_POST['idSP'];
} else {
    $idSP = '1'; // Giá trị mặc định cho $idSP
}

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
    <script src="https://kit.fontawesome.com/7c3b305d2f.js" crossorigin="anonymous"></script>
    <title>Cheo Tea And Coffee</title>


</head>

<body>
    <?php
    $sp = 5;

    //Tính tổng sản phẩm
    $kq_page = $tt->DSSanPham();

    $tsp = mysqli_num_rows($kq_page);

    //Tính tổng số trang
    $tst = ceil($tsp / $sp);  //ceil: hàm làm tròn

    //Tính page hiện hành
    if (isset($_GET['page']))
        $page = $_GET['page'];
    else $page = 1;

    //Tính vị trí lấy sản phẩm
    $vitri = ($page - 1) * $sp;

    ?>
    <div class="container">
        <div class="sidebar">
            <ul class="menu">
                <li>
                <a href="#">
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
                <li class="active">
                    <span><b style="font-size: 15px"> Drink </b></span>
                    <ul class="sub-menu">
                        <li> <a href="SanphamMa.php" class="sub-item">Mã SP</a></li>
                        <li> <a href="SanphamTim.php" class="sub-item">Tìm kiếm</a></li>
                        <li> <a href="MonThem.php" class="sub-item">Món thêm</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div style="width: 100%; ">
            <table class="content1">
                <tr>
                    <th width="50px"> ID </th>
                    <th width="70px">Tên </th>
                    <th width="50px">Mã loại </th>            
                    <th width="75px">Giá </th>
                    <th width="10px">Discount </th>
                    <th width="50px">Hình ảnh</th>
                    <th width="80px">Tình trạng</th>
                    <th width="40px">Views</th>
                    <!--chu y no ne -->
                    <th width="50"><a href="SanphamXuli.php?key=sanphamthem"> <i style="font-size: 25px" class='bx bxs-add-to-queue' style='color:rgba(243,64,139,0.93)'></i></a></th>

                </tr>

                <?php
                $kq = $tt->Drink($vitri, $sp);
                $i = 1;
                while ($row = $kq->fetch_assoc()) { ?>
                    <tr class="data-row">
                        <td><?php echo $row['IdSP']; ?></td>
                        <td><?php echo $row['TenSP']; ?></td>
                        <td><?php echo $row['IdLoai']; ?></td>
                        
                        <td>
                            <b>S:</b> <?php echo $row['gia_S']; ?>.000đ <br>
                            <b>M:</b> <?php echo $row['gia_M']; ?>.000đ <br>
                            <b>L:</b> <?php echo $row['gia_L']; ?>.000đ
                        </td>
                        <td><?php echo $row['PhanTramSPKM']; ?>%</td>
                        <td><?php echo "<img width=120px; height=120px src='HinhAnh/" . $row['HinhAnh'] . "'>"; ?></td>
                        <td>
                            <?php if ($row['TinhTrang'] == 'Đang bán') { ?>
                                <div style="color: green; background-color: #b3ffb3; border-radius: 30px; text-align: center; padding: 5px;">
                                    <?php echo $row['TinhTrang']; ?>
                                </div>
                            <?php } else if ($row['TinhTrang'] == 'Hết hàng') { ?>
                                <div style="color: red; background-color: #ffb3b3; border-radius: 30px; text-align: center; padding: 5px;">
                                    <?php echo $row['TinhTrang']; ?>
                                </div>
                            <?php } ?>
                        </td>
                        <td><?php echo $row['SoLuong']; ?><i class='fa-solid fa-eye' style="margin-left:5px;"></i></td>
                        <td width="100">
                            
                            <a href="SanphamXuli.php?key=sanphamsua&idSP=<?php echo $row['IdSP']; ?>" class="edit-button"><i class='bx bxs-edit' style='color:rgba(243,64,139,0.93)'></i></a>
                            <a href="process.php?xoasanpham=<?php echo $row['IdSP']; ?>" onclick="return confirm('Bạn có chắc chắn không ?');" class="delete-button"><i class='bx bxs-trash' style='color:rgba(243,64,139,0.93)'></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>


            <div class="pagination">

                Trang: <?php for ($i = 1; $i <= $tst; $i++) {
                            if ($i == $page)
                                echo "<div class='page' style=' font-weight:bold;'>" . $i . "</div> &nbsp;";
                            else
                                echo "<a href='Sanpham.php?page=$i'> $i </a> &nbsp;";
                        } ?>



            </div>
        </div>
    </div>
</body>

</html>