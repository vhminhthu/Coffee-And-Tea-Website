<?php
session_start();
ob_start();
include_once("dbconn.php");
$tt = new dbconn;

$id = $_SESSION['id'];

$kqlaythongtin = $tt->laythongtinkhachhang($id);
if (!$kqlaythongtin) {
    die("Đã xảy ra lỗi khi lấy thông tin.");
}

if (mysqli_num_rows($kqlaythongtin) > 0) {
    $row = mysqli_fetch_assoc($kqlaythongtin);
?>
    <!-- Thay đổi thông tin  -->
    <div class="giohang-thongtin" align="center">
        <form action="#" method="post">
            <h1 style="font-size:35px; margin-bottom: 10px; font-weight: bold; text-align:center; "> Thay đổi thông tin giao hàng </h1>
            <table width="70%">
                <tr>
                    <td class="thongtin label"> <label for="hoten"><b>Họ tên:</b></label></td>
                    <td class="thongtin input"> <input type="text" name="hoten" value="<?php echo $row['TenKH']; ?>"></td>
                </tr>
                <tr>
                    <td class="thongtin label"> <label for="email"><b>Email:</b></label></td>
                    <td class="thongtin input"> <input type="email" name="email" value="<?php echo $row['Email']; ?>"></td>
                </tr>
                <tr>
                    <td class="thongtin label"> <label for="diachi"><b>Địa chỉ:</b></label></td>
                    <td class="thongtin input"> <input type="text" name="diachi" value="<?php echo $row['DiaChi']; ?>"></td>
                </tr>
                <tr>
                    <td class="thongtin label"> <label for="sodt"><b>Số điện thoại:</b></label></td>
                    <td class="thongtin input"> <input type="text" name="sodt" value="<?php echo $row['SDT']; ?>"></td>
                </tr>
            </table>
            <input type="submit" name="capnhat" class="cart-submit" value="Cập nhật">
        </form>
    </div>
<?php
}

if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
    $id = $_SESSION['id'];
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sodt'];
    $kq_sua = $tt->suathongtinkhachhangkhigiaohangdaydu($id, $email, $hoten, $sdt, $diachi);
    if ($kq_sua) {
        header("location:index.php?view=taikhoan&src=profile");
    }
}
?>