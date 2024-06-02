<?php

ob_start();
session_start();
include("dbconn.php");
$tt = new dbconn;
?>
<?php
//------------------------------Dang Ky------------------------------------------------
if (isset($_POST['dangky'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (preg_match('/^\d+$/', $phone)) {

            if (strlen($phone) == 10) {
                $kt = $tt->kiemtradangky($email);
                if (mysqli_num_rows($kt) > 0) {
                    echo "
                    <script>
                    if(confirm('Email này đã được sử dụng! Bạn có muốn đăng nhập?')) {
                        location.href='./index.php?view=dangnhap';
                    } else {
                        location.href='./index.php?view=dangky';
                    }
                    </script>";
                } else {
                    $kqDangKy = $tt->XuLyDangKy($name, $phone, $email, $password);
                    $kqDangKy_sdt = $tt->Xulydangky_sdt($phone);

                    if ($kqDangKy && $kqDangKy_sdt) {
                        header("location: ../index.php?view=taikhoan");
                    } else {
                        echo "<script>alert('Đã xảy ra lỗi khi đăng ký! Vui lòng thử lại sau.'); location.href='./index.php?view=dangky'</script>";
                    }
                }
            } else {
                echo "<script> alert('Số điện thoại phải có 10 chữ số'); 
                location.href='./index.php?view=dangky'</script>";
            }
        } else {
            echo "<script> alert('Số điện thoại chỉ được chứa các chữ số'); 
            location.href='./index.php?view=dangky'</script>";
        }
    } else {
        echo "<script> alert('$email - Email không hợp lệ'); 
        location.href='./index.php?view=dangky'</script>";
    }
}

//------------------------------Dang Nhap------------------------------------------------
//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) {
    $e = $_POST['email_dangnhap'];
    $p = $_POST['password_dangnhap'];
    $kqDangNhap = $tt->XuLyDangNhap($e, $p);

    if (mysqli_num_rows($kqDangNhap) > 0) {
        $row = $kqDangNhap->fetch_assoc();
        $_SESSION['hoten'] = $row['TenKH'];
        $_SESSION['id'] = $row['IdKH'];
        $_SESSION['sdt'] = $row['SDT'];
        $_SESSION['email'] = $row['Email'];
        $_SESSION['pass'] = $row['MatKhau'];
        $_SESSION['diachi'] = $row['DiaChi'];
        $_SESSION['taikhoan'] = $row['TaiKhoan'];

        if ($row['TaiKhoan'] == "user") {
            header("location: index.php");
        } else header("location: admin/index.php");
    } else {
        echo "<script> alert('Email hoặc mật khẩu không chính xác!'); 
                location.href='./index.php?view=dangnhap'</script>";
    }
}

//Lệnh thoát khỏi Session
if (isset($_POST['thoat'])) {
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['pass']);
    unset($_SESSION['hoten']);
    unset($_SESSION['sdt']);
    unset($_SESSION['diachi']);
    unset($_SESSION['taikhoan']);
    header("location:../index.php?view=dangnhap");
}
//------------------------------Gio hang------------------------------------------------
//Xử lý giỏ hàng
if (!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];

//Kiểm tra rồi xóa tất cả sp
if (isset($_GET['xoa']) && ($_GET['xoa'] == 'all')) {
    unset($_SESSION['giohang']);
    header("location:../index.php?view=giohang");
}

//Kiểm tra rồi xóa 1 sp
if (isset($_GET['xoasach']) && ($_GET['xoasach'] >= 0)) {
    array_splice($_SESSION['giohang'], $_GET['xoasach'], 1);
    header("location:../index.php?view=giohang");
}


//lấy dữ liệu từ form
if (isset($_POST['dathang']) && ($_POST['dathang'])) {
    $id = $_POST['id']; //0
    $hinh = $_POST['hinhanh']; //1
    $tensp = $_POST['tensp']; //2
    $giasp = (int)$_POST['giasp']; //3
    $soluong = (int)$_POST['soluong']; //4
    $ice = $_POST['ice']; //5
    $sugar = $_POST['sugar']; //6
    $monthem = $_POST['monthem']; //7
    $size = $_POST['size']; //8
    $tenmonthem = $_POST['tenspmt']; //9
    $giamonthem = (int)$_POST['giaspmt']; //10

    $kiemtra = 0; //kiểm tra sp có trong giỏ hàng hay chưa

    for ($i = 0; $i <= sizeof($_SESSION['giohang']); $i++) {
        if ($_SESSION['giohang'][$i][2] == $tensp && $_SESSION['giohang'][$i][5] == $ice && $_SESSION['giohang'][$i][6] == $sugar && $_SESSION['giohang'][$i][9] == $tenmonthem && $_SESSION['giohang'][$i][8] == $size) {
            $kiemtra = 1;
            $soluongnew = $soluong + $_SESSION['giohang'][$i][4];
            $_SESSION['giohang'][$i][4] = $soluongnew;
            break;
        }
    }

    if ($kiemtra == 0) {
        //thêm mới sp vào giỏ hàng
        $sp = [$id, $hinh, $tensp, $giasp, $soluong, $ice, $sugar, $monthem, $size, $tenmonthem, $giamonthem];
        $_SESSION['giohang'][] = $sp;
    }

    header("location: index.php?view=chitiet&id=$id");
}

if (isset($_POST['update']) && ($_POST['update'])) {
    for ($i = 0; $i <= sizeof($_SESSION['giohang']); $i++) {
        if (isset($_POST['SL' . $i]) && $_POST['SL' . $i] !== "") {
            $_SESSION['giohang'][$i][4] = $_POST['SL' . $i];
        }
    }
    header("location:index.php?view=giohang");
}
?>


<?php

if (isset($_POST['thanhtoan']) && ($_POST['thanhtoan']) && isset($_POST['phuongthuc']) && ($_POST['phuongthuc'])) {

    $idkh = $_SESSION['id'];
    $phuongthucthanhtoan = $_POST['phuongthuc'];

    $_SESSION['phuongthuc'] = $phuongthucthanhtoan;

    //Tính tổng đơn hàng
    if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
        $tong = 0;
        if (sizeof($_SESSION['giohang']) > 0) {
            for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                $thanhtien = ((int)$_SESSION['giohang'][$i][3] + (int)$_SESSION['giohang'][$i][10]) * (int)$_SESSION['giohang'][$i][4];
                $tong += $thanhtien;
            }
        }
    }

    $_SESSION['tong'] = $tong;

    $idhd = $tt->themThongtinHoaDon($tong, $phuongthucthanhtoan, $idkh);

    //insert vào table chitiet_hoadon
    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
        $idsp = $_SESSION['giohang'][$i][0];
        $hinhanh = $_SESSION['giohang'][$i][1];
        $tensp = $_SESSION['giohang'][$i][2];
        $gia = (int)$_SESSION['giohang'][$i][3];
        $soluong = (int)$_SESSION['giohang'][$i][4];
        $ice = $_SESSION['giohang'][$i][5];
        $sugar = $_SESSION['giohang'][$i][6];
        $monthem = $_SESSION['giohang'][$i][9];
        $size = $_SESSION['giohang'][$i][8];
        $tenmonthem = $_SESSION['giohang'][$i][9];
        $giamonthem = (int)$_SESSION['giohang'][$i][10];

        $thanhtiencthd = $gia * $soluong;

        $kqChiTiet = $tt->themChitietHoaDon($idhd, $idsp, $size, $soluong, $thanhtiencthd, $ice, $sugar, $monthem);
    }

    echo "<script> alert('Mua hàng thành công'); location.href='./index.php'</script>";

    
    unset($_SESSION['giohang']);
} elseif (isset($_POST['thanhtoan']) && ($_POST['thanhtoan']) && !isset($_POST['phuongthuc']) && !($_POST['phuongthuc'])) {
    echo "<script> alert('Qúy khách vui lòng chọn phương thức thanh toán !'); location.href='./index.php?view=thanhtoan'</script>";
}

if (isset($_POST['muahang']) && ($_POST['muahang']) && !empty($_SESSION['giohang'])) {
    $id = $_SESSION['id']; 

    $kqlaythongtin = $tt->laythongtinkhachhang($id);
    if (!$kqlaythongtin) {
        die("Đã xảy ra lỗi khi lấy thông tin.");
    }

    if (mysqli_num_rows($kqlaythongtin) > 0) {
        $rowlay = mysqli_fetch_assoc($kqlaythongtin);
        if ($rowlay['DiaChi'] == 'Chưa có') {
            echo "<script>
            alert('Vui lòng điền đầy đủ thông tin');
            location.href = 'index.php?view=form'
        </script>";
        } else {
            header("location:index.php?view=thanhtoan");
        }
    }
} elseif (isset($_POST['muahang']) && ($_POST['muahang']) && empty($_SESSION['giohang'])) {
    echo "<script> 
        alert('Giỏ hàng chưa có sản phẩm!'); 
        location.href='index.php?view=giohang'
    </script>";
}
?>



<?php
// Yêu thích
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idspyt'])) {
        $idsp = $_POST['idspyt'];
        $idkh = $_SESSION['id'];

        $kqthem = $tt->themyeuthich($idsp, $idkh);
    }
}
?>

<?php
//Hủy hóa đơn
    if(isset($_POST['idhd'])) {
        $idhd = $_POST['idhd'];
        $result = $tt->huyhoadon($idhd);
    }
?>

<?php
if (isset($_SESSION['id'])) {
    if (isset($_POST['rating-idsp']) && !empty($_POST['rating-idsp'])) {
        $idsp=$_POST['rating-idsp'];
        $idkh=$_POST['rating-idkh'];
        $mota=$_POST['rating-input'];
        $sosao=$_POST['rate'];
        // Validate rating
        if ($sosao == 0) {
            echo "<script>alert('Số sao chưa được chọn');</script>";
        } elseif (empty($mota)) {
            echo "<script>alert('Chưa ghi đánh giá');</script>";
        } else {
            $kq = $tt->thembinhluan($mota, $sosao, $idsp, $idkh);
        }
    }
}

?>