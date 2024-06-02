<!-- Đăng ký -->
<div class="form-container">
    <div class="form-dangky">
        <form action="../../process.php" method="post" enctype="multipart/form-data">
            <div class="form-dangky-text">
                <h2> ĐĂNG KÝ </h2>
            </div>
            <div class="form-dangky-form">
                <input type="text" name="name" required placeholder="Họ tên"> <br>
                <input type="text" name="phone" required placeholder="Số điện thoại"> <br>
                <input type="text" name="email" required placeholder="Email"> <br>
                <input type="password" name="password" required placeholder="Mật khẩu"> <br>
            </div>
            <div class="form-dangky-submit">
                <input type="submit" value="Đăng ký" name="dangky"> <br>
            </div>
            <div class="form-dangky-hoi">
                <p><a href="../../index.php?view=dangnhap">Bạn đã có tài khoản?</a></p>
            </div>
        </form>
    </div>
</div>