<?php
ob_start();
session_start();
include_once("dbconn.php");
$tt = new dbconn;

?>
<!-- Main  -->
<div class="main" style="height:100%; background-color:white;">
    <div class="main-ads-1"><img src="../../assets/img/web/CHÈO.jpg" alt="" width="100%" height="110%"></div>

    <div class="main-menu">
        <?php
        $kqhienthi = $tt->toploai();
        if (!($kqhienthi)) {
            die("Kết nối thất bại");
        } elseif (mysqli_num_rows($kqhienthi) > 0) {
            while ($row = $kqhienthi->fetch_assoc()) {
                $id = $row['IdLoai']; ?>
                <a href="index.php?view=menu&loai=<?php echo $id; ?>">
                    <div class="main-menu-item">
                        <div class="main-menu-item-1">
                            <i class="fa-solid fa-mug-hot"></i>
                        </div>
                        <div class="main-menu-item-2">
                            <p> <?php echo $row['TenLoai']; ?> </p>
                        </div>

                    </div>
                </a>
        <?php }
        } ?>
    </div>

    <div class="main-bestseller">
        <div class="main-bestseller-text">
            <p> BEST SELLER </p>
        </div>
        <div class="main-bestseller-items">
            <?php
            $kqhienthi2 = $tt->topsp();
            if (!($kqhienthi2)) {
                die("Kết nối thất bại");
            } elseif (mysqli_num_rows($kqhienthi2) > 0) {
                while ($row2 = $kqhienthi2->fetch_assoc()) {
            ?>
                    <a href="index.php?view=chitiet&id=<?php echo $row2['IdSP'] ?>">
                        <div class="main-bestseller-item"> <img width="100%" height="100%" src="../../assets/img/product/<?php echo $row2['HinhAnh']; ?>" alt=""></div>
                    </a>
            <?php }
            } ?>
        </div>
    </div>

    <div class="main-ads-2"><img src="../../assets/img/web/MUST TRY.jpg" alt="" width="100%" height="110%"></div>

    <div class="main-danhgia">
        <div class="main-danhgia-text">
            <p> KHÁCH HÀNG ĐÁNH GIÁ CAO </p>
        </div>
        <div class="main-danhgia-items">
            <?php
            $kqdg = $tt->hienthitopbinhluan();
            if (!($kqdg)) {
                die("Kết nối thất bại");
            } else if (!(mysqli_num_rows($kqdg))) {
                echo "<h2 class='main-chitiet-khongco-chu'> Chưa có bình luận nào cả </h2>";
            } else {
                while ($rowdg = $kqdg->fetch_assoc()) {
                    $iddg = $rowdg['IdSPtop']; ?>
                    <a href="index.php?view=chitiet&id=<?php echo $iddg; ?>">
                        <div class="main-danhgia-item"> <img height="100%" width="100%" src="../../assets/img/product/<?php echo $rowdg['HinhAnh']; ?>" alt=""> </div>
                    </a>
            <?php }
            } ?>

        </div>
    </div>

    <div class="main-ads-3" style="height:500px; background-color:darkgray;"> </div>
    <?php
    if (isset($_SESSION['id'])) {
        $yeuthich = $tt->hienthitopyeuthich($_SESSION['id']);
        if (!($yeuthich)) {
            die("Kết nối thất bại");
        } else
        if (mysqli_num_rows($yeuthich) > 0) { ?>
            <div class="main-yeuthich">
                <div class="main-yeuthich-text">
                    <p> SẢN PHẨM YÊU THÍCH </p>
                </div>
                <div class="main-yeuthich-items">
                    <?php while ($rowyt = $yeuthich->fetch_assoc()) { ?>
                        <a href="index.php?view=chitiet&id=<?php echo $rowyt['IdSP'] ?>">
                            <div class="main-yeuthich-item"> <img width="100%" height="100%" style="border-radius: 100%;" src="../../assets/img/product/<?php echo $rowyt['HinhAnh']; ?>" alt=""></div>
                        </a>
                    <?php } ?>
                </div>
            </div>
    <?php }
    } ?>