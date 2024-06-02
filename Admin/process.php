<?php
include 'dbcon.php';
$tt = new dbcon();
session_start();
ob_start();
if(isset($_SESSION['taikhoan'])){
    if($_SESSION['taikhoan'] == "user"){
        header("location:../../../index.php");
    }
}
?>

<?php


if (isset($_POST['suatrangthai'])) {
// quan trọng

    $kq_sua = $tt->SuaTrangThai($_POST['status_1'],$_POST['IdHD']);

    if ($kq_sua) {
        header("location: Catergory.php");
    } else {
        echo "Cập nhật trạng thái thất bại!";
    }
}


// Xu ly them 
if (isset($_POST['themsanpham'])) {
    $vitri = 0; // chỉnh sửa lại xíu
    $sp = 5;    // chỉnh sửa lại xíu
    $kq_sp = $tt->Drink($vitri, $sp); // quan trong ne
    $kq_sp = $tt->ThemSanPham($_POST['IdSP'], $_POST['TenSP'], $_POST['IdLoai'],$_POST['gia_S'],$_POST['gia_M'],$_POST['gia_L'] , $_POST['HinhAnh'], $_POST['TinhTrang'],$_POST['PhanTramSPKM']);
    if ($kq_sp)
        header("location:Sanpham.php");
    else echo "Them san pham that bai!";
}


if (isset($_POST['monthem'])) {
    $vitri = 0; // chỉnh sửa lại xíu
    $sp = 5;    // chỉnh sửa lại xíu
    $kq_sp = $tt->More($vitri, $sp); // quan trong ne
    $kq_sp = $tt->MonThem($_POST['IdSP'], $_POST['TenSP'], $_POST['IdLoai'], $_POST['SoLuong'], $_POST['GiaTheoSize'], $_POST['TinhTrang']);
    if ($kq_sp)
        header("location:MonThem.php");
    else echo "Them san pham that bai!";
}


if (isset($_GET['monthemxoa'])) {
    $kq_xoa = $tt->MonThemXoa($_GET['monthemxoa']);
    if ($kq_xoa)
        header("location:MonThem.php");
    else
        echo "Xoa san pham that bai !";
}

if (isset($_GET['xoasanpham'])) {
    $kq_xoa = $tt->XoaSanPham($_GET['xoasanpham']);
    if ($kq_xoa)
        header("location:Sanpham.php");
    else
        echo "Xoa san pham that bai !";
}



if (isset($_GET['xoalichsu'])) {
    $kq_xoa = $tt->XoaLichSu($_GET['xoalichsu']);
    if ($kq_xoa)
        header("location:LichSuHD.php");
    else
        echo "Xoa don that bai !";
}

if (isset($_GET['xoamasp'])) {
    $kq_xoa = $tt->XoaMaSanPham($_GET['xoamasp']);
    if ($kq_xoa)
        header("location:SanphamMa.php");
    else
        echo "Xoa san pham that bai !";
}


if (isset($_POST['suasanpham'])) {

    // Call SuaSanPham function with the formatted GiaTheoSize parameter
    $kq_sua = $tt->SuaSanPham($_POST['IdSP'], $_POST['TenSP'], $_POST['IdLoai'],$_POST['gia_S'],$_POST['gia_M'],$_POST['gia_L'], $_POST['TinhTrang'], $_POST['HinhAnh'],$_POST['PhanTramSPKM']);

    // Check if the update was successful
    if ($kq_sua) {
        header("location: Sanpham.php");
    } else {
        echo "Cập nhật sản phẩm thất bại!";
    }
}

if (isset($_POST['monthemsua'])) {
    $kq_sua = $tt->SuaMonThem($_POST['IdSP'], $_POST['TenSP'], $_POST['IdLoai'], $_POST['SoLuong'], $_POST['GiaTheoSize'] , $_POST['TinhTrang'] );
    if ($kq_sua) {
        header("location: MonThem.php");
    } else {
        echo "Cập nhật sản phẩm thất bại!";
    }
}





if (isset($_POST['themmasanpham'])) {
    $vitri = 0; // chỉnh sửa lại xíu
    $sp = 5;    // chỉnh sửa lại xíu
    $kq_sp = $tt->LoaiSanPham($vitri, $sp); // quan trong ne
    $kq_sp = $tt->ThemMaSanPham($_POST['IdLoai'], $_POST['TenSP']);
    if ($kq_sp)
        header("location:SanphamMa.php");
    else echo "Them ma san pham that bai do trung ten san pham!";
}

if (isset($_POST['suamasanpham'])) {

    $kq_sua = $tt->SuaMaSanPham($_POST['IdLoai'], $_POST['TenLoai']);
    if ($kq_sua)
        header("location:SanphamMa.php");
    else
        echo "Sua ma san pham that bai !";
}


?>

