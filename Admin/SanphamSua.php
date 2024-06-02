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
        $kq = $tt->SuaSanPham_id($_GET['idSP']);
        $row = $kq->fetch_assoc()


    ?>

        <form id="edit_form" name="edit_form" method="post" action="process.php">

            <p>
                <label for="IdSP"><b>ID sản phẩm:</b></label>
                <input type="text" name="IdSP" id="IdSP" value="<?php echo $row['IdSP']; ?>" />

            </p>

            <p>
                <label for="TenSP"><b>Tên :</b></label>
                <input type="text" name="TenSP" id="TenSP" value="<?php echo $row['TenSP']; ?>" />
            </p>
            <p>
                <label for="IdLoai"><b> Mã loại:</b></label>
                <input type="text" name="IdLoai" id="IdLoai" value="<?php echo $row['IdLoai']; ?>" />
            </p>
            <br>
    <div >
    <span><label for="gia_S"><b>Size S:</b></label></span>
    <span><input type="text" name="gia_S" id="gia_S" value="<?php echo $row['gia_S']; ?>"/></span>

    <span><label for="gia_M"><b>Size M:</b></label></span>
    <span><input type="text" name="gia_M" id="gia_M" value="<?php echo $row['gia_M']; ?>" /></span>

    <span><label for="gia_L"><b>Size L:</b></label></span>
    <span><input type="text" name="gia_L" id="gia_L" value="<?php echo $row['gia_S']; ?>" /></span>
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
        <input type="text" name="PhanTramSPKM" id="PhanTramSPKM" value="<?php echo $row['PhanTramSPKM']; ?>" />
    </span>
</div>
            <p>
                <label for="HinhAnh"><b>Hình ảnh :</b></label>
                <input type="file" name="HinhAnh" id="HinhAnh" value="<?php echo 'HinhAnh/' . $row['HinhAnh'];  ?> " />
            </p>


            <p>
                <input type="submit" name="suasanpham" id="suasanpham" value="ok" />
            </p>
        </form>
    <?php } ?>
</body>




</html>