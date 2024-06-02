<?php
ob_start();
include_once("dbconn.php");
$tt = new dbconn;
?>
<!-- Liên hệ  -->
<div class="main-lienhe">
    <div class="main-lienhe-left">

        <div class="main-lienhe-left-top">
            <div class="main-lienhe-left-top-item">
                <span><i class="fa-solid fa-location-dot"></i></span>
                <span>1 Đ. Cộng Hòa, Phường 4, Tân Bình, Thành phố Hồ Chí Minh, Việt Nam</span>
            </div>
            <div class="main-lienhe-left-top-item">
                <span><i class="fa-solid fa-phone"></i></span>
                <span>028 3844 2251</span>
            </div>
            <div class="main-lienhe-left-top-item">
                <span><i class="fa-solid fa-earth-americas"></i></span>
                <span>www.vaa.edu.vn</span>
            </div>
        </div>

        <div class="main-lienhe-left-bottom">
            <div class="main-lienhe-left-bottom-text">
                <p style="font-size: 20px;">Liên hệ với chúng tôi</p>
            </div>
            <form action="" method="post">
                <input type="text" name="hotenlienhe" placeholder="Họ và tên">
                <input type="email" name="emaillienhe" placeholder="Email">
                <textarea name="noidunglienhe" cols="30" rows="10" placeholder="Nội dung"></textarea>
                <input type="submit" name="submitlienhe" value="Gửi liên hệ">
            </form>
        </div>

    </div>
    <div class="main-lienhe-right">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.1473248572024!2d106.65184127573619!3d10.800026358756547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175292976c117ad%3A0x5b3f38b21051f84!2zSOG7jWMgdmnhu4duIEjDoG5nIGtow7RuZyBWaeG7h3QgTmFtIC0gQ1My!5e0!3m2!1svi!2s!4v1711375150524!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<?php
//Thêm liên hệ
if (isset($_POST['submitlienhe'])) {
    $Email = $_POST['emaillienhe'];
    $NoiDung = $_POST['noidunglienhe'];
    $Ten = $_POST['hotenlienhe'];
    $them = $tt->themlienhe($Ten, $Email, $NoiDung);
}
?>