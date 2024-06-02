<?
session_start();
ob_start();
include('../../process.php');

if (isset($_SESSION['id'])) {
    header("location: ../index.php");
}
?>
<!-- Đăng nhập -->
<div class="form-container">
    <div class="form-dangnhap">
        <form action="../../process.php" method="post" enctype="multipart/form-data">
            <div class="form-dangnhap-text">
                <h2> ĐĂNG NHẬP </h2>
            </div>
            <div class="form-dangnhap-form">
                <input type="text" name="email_dangnhap" required placeholder="Email"> <br>
                <input type="password" name="password_dangnhap" required placeholder="Mật khẩu"> <br>
            </div>
            <div class="form-dangnhap-submit">
                <input type="submit" value="Đăng nhập" name="dangnhap">
            </div>
            <div class="form-dangnhap-hoi">
                <p><a href="../../index.php?view=dangky">Bạn chưa có tài khoản? </a></p>
            </div>
        </form>
    </div>
</div>