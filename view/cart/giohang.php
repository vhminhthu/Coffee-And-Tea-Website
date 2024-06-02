<?php
session_start();
ob_start();
include_once("dbconn.php");
$tt = new dbconn;
?>
<!-- Giỏ hàng -->
<div class="cart">
    <div class="cart-text">
        <h4> GIỎ HÀNG </h4>
    </div>
    <div class="cart-main">
        <div class="cart-main-left">
            <div class="cart-main-left-text">
                <span>Sản phẩm</span>
                <span>Đơn giá</span>
                <span>Số lượng</span>
                <span>Thành tiền</span>
                <button type="button" name="xoa" onclick="location.href='../process.php?xoa=all'" style="border: none; background: none; padding: 0; cursor: pointer;">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
            <div class="cart-main-left-list">
                <form action="../../process.php" name="form-giohang" method="post" enctype="multipart/form-data" style="font-size: 15px;">
                    <?php
                    if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
                        if (sizeof($_SESSION['giohang']) > 0) {
                            $tong = 0;
                            for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                                $idsp = $_SESSION['giohang'][$i][0];
                                $thanhtien = ((int)$_SESSION['giohang'][$i][3] + (int)$_SESSION['giohang'][$i][10]) * (int)$_SESSION['giohang'][$i][4];
                                $tong += $thanhtien;
                    ?>
                                <div class="cart-main-left-list-sp">
                                    <div class="cart-main-left-list-sp-name">
                                        <a href="index.php?view=chitiet"><img src="../../assets/img/product/<?php echo $_SESSION['giohang'][$i][1]; ?>" alt="" width="100%" height="100%" style="border-radius: 15px;"></a>
                                        <a href="index.php?view=chitiet"> <?php echo $_SESSION['giohang'][$i][2]; ?> </a>
                                        <p>Size <?php echo $_SESSION['giohang'][$i][8]; ?><br> Ice <?php echo $_SESSION['giohang'][$i][5]; ?>% Sugar <?php echo $_SESSION['giohang'][$i][6]; ?>% <br> MT <?php echo $_SESSION['giohang'][$i][9];  ?> </p>
                                    </div>
                                    <div class="cart-main-left-list-sp-dg"><?php echo $_SESSION['giohang'][$i][3]; ?>.000 đ</div>
                                    <div class="cart-main-left-list-sp-sl"> <input type="number" name="SL<?php echo $i; ?>" min="1" max="10" value="<?php echo $_SESSION['giohang'][$i][4]; ?>"> </div>
                                    <div class="cart-main-left-list-sp-tt"> <?php echo $thanhtien; ?>.000đ </div>
                                    <div class="cart-main-left-list-sp-trash"> <a href="../process.php?xoasach=<?php echo $i; ?>" class="xoa-giohang"><i class="fa-solid fa-trash"></i></a></div>
                                </div>
                    <?php }
                        }
                    }
                    ?>
            </div>
            <input class="cart-submit" style="margin-top:20px;" type="submit" name="update" value="Cập nhật">
        </div>

        <div class="cart-main-right">
            <div class="cart-main-right-1">
                <?php
                if (!isset($_SESSION['id'])) {
                    echo "<script> alert('Vui lòng đăng nhập tài khoản'); location.href='index.php?view=dangnhap'</script>";
                }
                $id = $_SESSION['id'];
                $kqlaythongtin = $tt->laythongtinkhachhang($id);
                if (!$kqlaythongtin) {
                    die("Đã xảy ra lỗi khi lấy thông tin.");
                }
                if (mysqli_num_rows($kqlaythongtin) > 0) {
                    $row = mysqli_fetch_assoc($kqlaythongtin);
                ?>
                    <div class="cart-main-right-1-text">
                        <p>Giao tới</p>
                        <a href="../../index.php?view=form">Thay đổi</a>
                    </div>

                    <div class="cart-main-right-1-name">
                        <p><b><?php echo  $row['TenKH']; ?></b></p>
                        <p><b><?php echo $row['SDT']; ?></b></p>
                    </div>
                    <div class="cart-main-right-1-address">
                        <p><?php echo $row['DiaChi']; ?></p>
                    </div>
            </div>
        <?php } ?>
        <div class="cart-main-right-2">
            <?php if (!isset($tong)) { ?>
                <div class="cart-main-right-2-text">
                    <p>Tạm tính</p>
                    <p>0</p>
                </div>
                <div class="cart-main-right-2-text">
                    <p>Giam giá</p>
                    <p>0</p>
                </div>
                <div class="cart-main-right-2-text tt">
                    <p>Thành tiền</p>
                    <p>0</p>
                </div>
            <?php } else { ?>
                <div class="cart-main-right-2-text">
                    <p>Tạm tính</p>
                    <p><?php echo $tong; ?>.000đ</p>
                </div>
                <div class="cart-main-right-2-text">
                    <p>Giam giá</p>
                    <p>0</p>
                </div>
                <div class="cart-main-right-2-text tt">
                    <p>Thành tiền</p>
                    <p><b><?php echo $tong; ?>.000đ</b></p>
                </div>
            <?php } ?>
            <input type="submit" name="muahang" class="cart-submit" value="Mua hàng"">
                </form>
            </div>

        </div>
    </div>
</div>