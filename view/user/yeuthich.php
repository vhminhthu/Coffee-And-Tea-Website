<?php
ob_start();
session_start();
include_once("dbconn.php");
$tt = new dbconn;

if (!isset($_SESSION['id'])) {

    echo "<script> alert('Qúy khách vui lòng đăng nhập!'); 
    location.href='./index.php?view=dangnhap'</script>";
}
$idkh = $_SESSION['id'];
$kqyt = $tt->hienthiyeuthich($idkh);
$kqtongyt = $tt->hienthitongyeuthich($idkh);
?>
<!-- Danh sách yêu thích  -->
<div class="like-container">
    <div class="like-text">
        <span> Danh sách yêu thích </span>
        <?php
        if (!($kqtongyt)) {
            die("Kết nối thất bại");
        } else
        if (mysqli_num_rows($kqtongyt) > 0) {
            $rowtong = $kqtongyt->fetch_assoc();
        ?>
            <span> ( <?php echo $rowtong['TongSoLuongThich']; ?> Sản phẩm ) </span> <?php } ?>
    </div>
    <div class="like-menu">

    </div>
    <div class="like-items">
        <?php
        if (!($kqyt)) {
            die("Kết nối thất bại");
        } else
        if (mysqli_num_rows($kqyt) > 0) {
            while ($row = $kqyt->fetch_assoc()) {
                $id = $row["IdSP"];
                $ten = $row["TenSP"];
        ?>
                <a href="../../index.php?view=chitiet&id=<?php echo $id; ?>">
                    <div class="like-item">
                        <div class="like-item-img">
                            <img src="../../assets/img/product/<?php echo $row['HinhAnh']; ?>" alt="" width="100%" height="100%">
                        </div>
                        <div class="like-item-text">
                            <p style="margin-top: 11px;"><?php echo $ten; ?></p>
                            <p style="margin-top: 5px;"><?php echo $row['gia_S']; ?>.000đ</p>
                        </div>
                    </div>
                </a>
        <?php }
        }
        ?>
    </div>
</div>