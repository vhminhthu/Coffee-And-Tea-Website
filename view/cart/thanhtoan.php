<?php
ob_start();
session_start();
include_once("dbconn.php");
$tt = new dbconn;
?>
<!-- Thanh toán giỏ hàng  -->
<div class="giohang-thongtin-thanhtoan" align="center">
    <h1>PHƯƠNG THỨC THANH TOÁN</h1>
    <div class="phuongthucthanhtoan">
        <form action="../process.php" method="post">
            <label>
                <input type="radio" name="phuongthuc" value="nganhang">
                <span>
                    <b>Chuyển khoản ngân hàng </b>
                    <p style="margin-left: 20px;">STK: xxxxxxxxxxxx</p>
                    <p style="margin-left: 20px;">Ngân hàng: MB</p>
                </span>
            </label>

            <label>
                <input type="radio" name="phuongthuc" value="momo">
                <span>
                    <b>Ví Momo</b> <br>
                    <p style="margin-left: 20px;">SDT: XXXXXXXXXX</p>

                </span>
            </label>

            <label>
                <input type="radio" name="phuongthuc" value="cod">
                <span>
                    <b>Thanh toán khi nhận hàng (COD)</b>
                </span>
            </label>

    </div>
    <input type="submit" class="cart-submit" name="thanhtoan" value="Đặt hàng">
    </form>
</div>