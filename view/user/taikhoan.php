<?php
session_start();
ob_start();
if (!isset($_SESSION['id'])) {
    header("location:../index.php?view=dangnhap");
}
?>
<!-- Tài khoản -->
<div class="main" id="main">
    <div class="taikhoan-dangnhap">
        <div class="taikhoan-dangnhap-left">
            <div class="taikhoan-dangnhap-left-avata"><img width="100%" height="100%" src="../../assets/img/logo.jpg" alt=""></div>
            <div class="taikhoan-dangnhap-left-nav">
                <div class="taikhoan-dangnhap-left-nav-item"><a href="../../index.php?view=taikhoan&src=profile">Tài khoản của tôi</a></div>
                <div class="taikhoan-dangnhap-left-nav-item"><a href="../../index.php?view=taikhoan&src=order">Đơn mua</a></div>
            </div>
            <div class="box-thoat">
                <form action="../process.php" method="post" name="formThoat" id="formThoat">
                    <input type="submit" name="thoat" value="Thoát" id="thoat">
                </form>
            </div>
        </div>

        <div class="taikhoan-dangnhap-right">
            <?php
            if (isset($_GET['src'])) {
                if ($_GET['src'] == 'profile') { ?>
                    <div class="top">
                        <?php
                        $id = $_SESSION['id'];
                        $kqlaythongtin = $tt->laythongtinkhachhang($id);
                        if (!$kqlaythongtin) {
                            die("Đã xảy ra lỗi khi lấy thông tin.");
                        }
                        if (mysqli_num_rows($kqlaythongtin) > 0) {
                            $row = mysqli_fetch_assoc($kqlaythongtin);
                        ?>
                            <div class="box">
                                <p> Xin chào <b> <?php echo "" . $row['TenKH']; ?> </b> </p>
                            </div>
                            <div class="box">
                                <p> Email của bạn là <b> <?php echo "" .  $row['Email']; ?> </b> </p>
                            </div>
                            <div class="box">
                                <p> Số điện thoại của bạn <b> <?php echo "" .  $row['SDT']; ?> </b> </p>
                            </div>
                            <div class="box">
                                <p> Địa chỉ của bạn <b> <?php echo "" .  $row['DiaChi']; ?> </b> </p>
                            </div>

                    </div>
                    <div class="box thaydoi" style="color:black; display:flex; justify-content: center;">
                        <a href="../../index.php?view=formThayDoi" style="color:black;">Thay đổi</a>
                    </div>
                    <?php
                        }
                    } elseif ($_GET['src'] == 'order') {
                        $id = $_SESSION['id'];
                        $kqht = $tt->hienthihoadon($id);
                        if (!$kqht) {
                            die("Đã xảy ra lỗi khi lấy thông tin.");
                        }
                        if (mysqli_num_rows($kqht) > 0) {
                            while ($rowht = mysqli_fetch_assoc($kqht)) {
                    ?>
                        <div class="taikhoan-dangnhap-right-item">
                            <div class="taikhoan-dangnhap-right-item-top">
                                <p><?php echo $rowht['NgayGio']; ?></p>
                                <p class="trangthai" style="color:#ff93be"><b><?php echo $rowht['TrangThai'];  ?></b> </p>
                            </div>
                            <div class="taikhoan-dangnhap-right-item-between">
                                <p>Thanh toán: <?php echo $rowht['PhuongThucThanhToan'];  ?> (<?php echo $rowht['TinhTrang_ThanhToan'];  ?>)</p>
                                <p>Tổng: <?php echo $rowht['Tong'];  ?>.000đ</p>
                            </div>
                            <div class="taikhoan-dangnhap-right-item-bottom">
                                <?php
                                $kqhtct = $tt->hienthichitiethoadon($rowht['IdHD']);
                                if (!$kqhtct) {
                                    die("Đã xảy ra lỗi khi lấy thông tin.");
                                }
                                if (mysqli_num_rows($kqhtct) > 0) {
                                    while ($rowhtct = mysqli_fetch_assoc($kqhtct)) {
                                ?>
                                        <a href="index.php?view=chitiet&id=<?php echo $rowhtct['IdSP']; ?>" style="text-decoration: none; color:black;">
                                            <div class="row-taikhoan-main">
                                                <span class="row-taikhoan-img"><img width="100%" height="100%" src="../../assets/img/product/<?php echo $rowhtct['HinhAnh']; ?>" alt=""></span>
                                                <span class="row-taikhoan">
                                                    <span class="col-taikhoan"> <b> <?php echo $rowhtct['TenSP']; ?></b> </span>
                                                    <span class="col-taikhoan" style="padding:3px 0; font-size: 15px;"> Size <?php echo $rowhtct['Size']; ?> </span>
                                                    <span class="col-taikhoan" style="padding:3px 0 3px 0;font-size: 13px; color:#414141;"> Món thêm: <?php echo $rowhtct['Them']; ?> </span>
                                                    <span class="col-taikhoan"> x<?php echo $rowhtct['soluongmua']; ?> </span>
                                                </span>
                                                <span class="row-taikhoan-dg"><?php echo $rowhtct['DonGia']; ?>.000đ</span>
                                            </div>
                                        </a>

                                <?php }
                                } ?>
                            </div>
                            <?php if (isset($rowht['TrangThai']) && $rowht['TrangThai'] != 'Đã Hủy') { ?>
                                <div class="taikhoan-dangnhap-right-item-huy">
                                    <input class="idhd" type="hidden" value="<?php echo $rowht['IdHD']; ?>">
                                    <button class="huyButton">
                                        Hủy
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                <?php
                            }
                        } else {
                            echo 'Hiện tại chưa có đơn hàng nào';
                        }
                ?>
        </div>
<?php
                    }
                }
?>
    </div>
</div>


<script>
    var huyButtons = document.getElementsByClassName("huyButton");
    for (var i = 0; i < huyButtons.length; i++) {
        huyButtons[i].addEventListener("click", function(event) {
            event.stopPropagation();
            var confirmCancel = confirm("Bạn có chắc muốn hủy hóa đơn?");
            if (confirmCancel) {
                var idhd = this.parentNode.querySelector('.idhd').value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var cancelButton = document.querySelector('.idhd[value="' + idhd + '"]').closest('.taikhoan-dangnhap-right-item-huy').querySelector('.huyButton');
                        cancelButton.disabled = true;
                        var trangthai = cancelButton.closest('.taikhoan-dangnhap-right-item').querySelector('.trangthai');
                        trangthai.textContent = "Đã hủy";
                        alert("Hủy hóa đơn thành công!");
                    }
                };

                xhttp.open("POST", "process.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idhd=" + idhd);
            }
        });
    }
</script>