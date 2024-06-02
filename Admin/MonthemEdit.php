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

if (isset($_GET['idSP'])) {
    include("dbcon.php");
    $tt = new dbcon;
    $kq = $tt->SuaMonThem_id($_GET['idSP']);
    $row = $kq->fetch_assoc()


?>


        <form id="edit_form_more" name="edit_form_more" method="post" action="process.php">

            <p>
                <label for="IdSP"><b>ID sản phẩm:</b></label>
                <input type="text" name="IdSP" id="IdLoai" value="<?php echo $row['IdSP']; ?>" />

            </p>
            <p>
                <label for="TenSP"><b>Tên :</b></label>
                <input type="text" name="TenSP" id="TenSP" value="<?php echo $row['TenSP']; ?>" />
            </p>
            <p>
                <label for="IdLoai"><b>Mã Loại :</b></label>
                <input type="text" name="IdLoai" id="IdLoai" value="<?php echo $row['IdLoai']; ?>" />
            </p>
            <p>
                <label for="SoLuong"><b>Số Lượng :</b></label>
                <input type="text" name="SoLuong" id="SoLuong" value="<?php echo $row['SoLuong']; ?>" />
            </p>
            <p>
                <label for="GiaTheoSize"><b>Giá :</b></label>
                <input type="text" name="GiaTheoSize" id="GiaTheoSize" value="<?php echo $row['GiaTheoSize']; ?>" />
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
                <input type="submit" name="monthemsua" id="monthemsua" value="ok" />
            </p>
        </form>
        <?php } ?>
</body>
</html>