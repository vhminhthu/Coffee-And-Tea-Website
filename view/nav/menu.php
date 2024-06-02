<?php
ob_start();
session_start();
include_once("dbconn.php");
$tt = new dbconn;
?>
<!-- Menu -->
<div class="menu">
    <div class="menu-main">
        <div class="menu-text1">
            <a href="../../index.php">Trang chủ</a>
            <span> > </span>
            <a href="../../index.php?view=menu&page=1"> Tất cả sản phẩm</a>
            <?php
            if (isset($_GET['loai']) && ($_GET['loai'] > 0)) {
                $idloai = $_GET['loai'];
                $kqht = $tt->hienthisptentheloai($idloai);
                if (!($kqht)) {
                    die("Kết nối thất bại");
                } else
                    if (mysqli_num_rows($kqht) > 0) {
                    $rowht = $kqht->fetch_assoc();
                    echo '<span> > </span>';
                    echo '<a href="../../index.php?view=menu&loai=' . $rowht['IdLoai'] . '&page=1">' . $rowht['TenLoai'] . '</a>';
                }
            } elseif (isset($_GET['sosao']) && ($_GET['sosao'] > 0)) {
                echo '<span> > </span>';
                if ($_GET['sosao'] == '5') {
                    echo '<a href="../../index.php?view=menu&sosao=5&page=1">5 SAO</a>';
                }
                if ($_GET['sosao'] == '4') {
                    echo '<a href="../../index.php?view=menu&sosao=4&page=1">4 SAO</a>';
                }
                if ($_GET['sosao'] == '3') {
                    echo '<a href="../../index.php?view=menu&sosao=3&page=1">3 SAO</a>';
                }
                if ($_GET['sosao'] == '2') {
                    echo '<a href="../../index.php?view=menu&sosao=2&page=1">2 SAO</a>';
                }
                if ($_GET['sosao'] == '1') {
                    echo '<a href="../../index.php?view=menu&sosao=1&page=1">1 SAO</a>';
                }
            } elseif (isset($_GET['tu']) && ($_GET['tu'] > 0) && (isset($_GET['den'])) && ($_GET['den'] > 0)) {
                echo '<span> > </span>';
                if ($_GET['tu'] == '10.000' && $_GET['den'] == '20.000') {
                    echo '<a href="../index.php?view=menu&tu=10.000&den=20.000&page=1">10.000 - 20.000</a>';
                }
                if ($_GET['tu'] == '20.000' && $_GET['den'] == '30.000') {
                    echo '<a href="../index.php?view=menu&tu=20.000&den=30.000&page=1">20.000 - 30.000</a>';
                }
                if ($_GET['tu'] == '30.000' && $_GET['den'] == '40.000') {
                    echo '<a href="../index.php?view=menu&tu=30.000&den=40.000&page=1">30.000 - 40.000</a>';
                }
                if ($_GET['tu'] == '40.000' && $_GET['den'] == '50.000') {
                    echo '<a href="../index.php?view=menu&tu=40.000&den=50.000&page=1">40.000 - 50.000</a>';
                }
                if ($_GET['tu'] == '50.000' && $_GET['den'] == '100.000') {
                    echo '<a href="../index.php?view=menu&tu=50.000&den=100.000&page=1">50.000 trở lên</a>';
                }
            } ?>
        </div>

        <div class="menu-all">
            <div class="menu-all-left">
                <div class="menu-all-left-text1">
                    Danh mục sản phẩm
                </div>
                <div class="menu-all-left-text2">
                    <ul>
                        <?php
                        $kqhienthi2 = $tt->hienthitatcaloai();
                        if (!($kqhienthi2)) {
                            die("Kết nối thất bại");
                        } else
                        if (mysqli_num_rows($kqhienthi2) > 0) {
                            while ($row2 = $kqhienthi2->fetch_assoc()) {
                                $tenTL = $row2['TenLoai'];
                                $idloai = $row2['IdLoai'] ?>
                                <li>
                                    <a href="../index.php?view=menu&loai=<?php echo $idloai ?>&page=1"><?php echo $tenTL; ?> </a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="menu-all-left-text1">
                    Đánh giá
                </div>
                <div class="menu-all-left-text2">
                    <ul>
                        <li><a href="../index.php?view=menu&sosao=5&page=1">5 SAO</a></li>
                        <li><a href="../index.php?view=menu&sosao=4&page=1">4 SAO</a></li>
                        <li><a href="../index.php?view=menu&sosao=3&page=1">3 SAO</a></li>
                        <li><a href="../index.php?view=menu&sosao=2&page=1">2 SAO</a></li>
                        <li><a href="../index.php?view=menu&sosao=1&page=1">1 SAO</a></li>
                    </ul>
                </div>

                <div class="menu-all-left-text1">
                    Giá
                </div>
                <div class="menu-all-left-text2">
                    <ul>
                        <li><a href="../index.php?view=menu&tu=10.000&den=20.000&page=1">10.000 - 20.000</a></li>
                        <li><a href="../index.php?view=menu&tu=20.000&den=30.000&page=1">20.000 - 30.000</a></li>
                        <li><a href="../index.php?view=menu&tu=30.000&den=40.000&page=1">30.000 - 40.000</a></li>
                        <li><a href="../index.php?view=menu&tu=40.000&den=50.000&page=1">40.000 - 50.000</a></li>
                        <li><a href="../index.php?view=menu&tu=50.000&den=100.000&page=1">50.000 trở lên</a></li>
                    </ul>
                </div>
            </div>

            <div class="menu-all-right">
                <div class="menu-all-right-items">
                    <?php
                    if (isset($_GET['loai']) && ($_GET['loai'] > 0)) {
                        $idl = $_GET['loai'];
                        $kqhienthi3 = $tt->hienthisanphamtheotheloai($idl);

                        $soSPTrenMotTrang = 12;
                        $TongsoSP = mysqli_num_rows($kqhienthi3);
                        $tst = ceil($TongsoSP / $soSPTrenMotTrang);
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        // Tính vị trí lấy sp
                        $batdautu = ($page - 1) * $soSPTrenMotTrang;
                        $i = 1;
                        $kqtrang = $tt->hienthisanphamtheotheloaitheotrang($idl, $batdautu, $soSPTrenMotTrang);

                        if (!($kqtrang)) {
                            die("Kết nối thất bại");
                        } elseif (mysqli_num_rows($kqtrang) > 0) {
                            while ($row3 = $kqtrang->fetch_assoc()) {
                                $id3 = $row3['IdSP']; ?>
                                <div class="menu-all-right-item">
                                    <div class="menu-all-right-item-img">
                                        <a href="index.php?view=chitiet&id=<?php echo $id3; ?>">
                                            <img src="../../assets/img/product/<?php echo $row3['HinhAnh']; ?>" alt="" width="100%" height="100%" style="border-radius: 10px;">
                                        </a>
                                    </div>
                                    <div class="menu-all-right-item-main">
                                        <div class="menu-all-right-item-text">
                                            <a href="index.php?view=chitiet&id=<?php echo $id3; ?>">
                                                <?php
                                                $gia_S_KM = round($row3['gia_S'] * (1 - ($row3['PhanTramSPKM']) / 100)); ?>
                                                <?php if ($gia_S_KM == $row3['gia_S']) { ?>
                                                    <p><?php echo $row3['TenSP']; ?></p>
                                                    <p><b><?php echo $row3['gia_S']; ?>.000 đ</b></p>
                                                <?php } else { ?>
                                                    <span><?php echo $row3['TenSP']; ?></span>
                                                    <span class="icon-sale">-<?php echo $row3['PhanTramSPKM']; ?>%</span> <br>
                                                    <span style="color: #f04388;"><b><?php echo $gia_S_KM; ?>.000 đ</b></span>
                                                    <span style="text-decoration: line-through; font-size:10px;"><b><?php echo $row3['gia_S']; ?>.000 đ</b></span>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="menu-all-right-item-icon">
                                            <?php
                                            $isLiked = false;
                                            if (isset($_SESSION['id'])) {
                                                $idsp = $row3['IdSP'];
                                                $idkh = $_SESSION['id'];
                                                $kiemtra_yeuthich = $tt->kiemtrayeuthich($idsp, $idkh);
                                                if (mysqli_num_rows($kiemtra_yeuthich) > 0) {
                                                    $isLiked = true;
                                                }
                                            }
                                            ?>
                                            <button class="likebutton" data-value="<?php echo $row3['IdSP']; ?>">
                                                <i class="heart-icon <?php echo ($isLiked ? 'fas' : 'far'); ?> fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    } elseif (isset($_GET['sosao']) && ($_GET['sosao'] > 0)) {
                        $sosao = $_GET['sosao'];
                        $kqhienthi5 = $tt->hienthisanphamtheososao($sosao);
                        $soSPTrenMotTrang = 12;
                        $TongsoSP = mysqli_num_rows($kqhienthi5);
                        $tst = ceil($TongsoSP / $soSPTrenMotTrang);
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        // Tính vị trí lấy sp
                        $batdautu = ($page - 1) * $soSPTrenMotTrang;
                        $i = 1;
                        $kqtrang = $tt->hienthisanphamtheososaotheotrang($sosao, $batdautu, $soSPTrenMotTrang);

                        if (!($kqtrang)) {
                            die("Kết nối thất bại");
                        } elseif (mysqli_num_rows($kqtrang) > 0) {
                            while ($row5 = $kqtrang->fetch_assoc()) {
                                $id5 = $row5['IdSP']; ?>
                                <div class="menu-all-right-item">
                                    <div class="menu-all-right-item-img">
                                        <a href="index.php?view=chitiet&id=<?php echo $id5; ?>">
                                            <img src="../../assets/img/product/<?php echo $row5['HinhAnh']; ?>" alt="" width="100%" height="100%" style="border-radius: 10px;">
                                        </a>
                                    </div>
                                    <div class="menu-all-right-item-main">
                                        <div class="menu-all-right-item-text">
                                            <a href="index.php?view=chitiet&id=<?php echo $id5; ?>">
                                                <?php
                                                $gia_S_KM = round($row5['gia_S'] * (1 - ($row5['PhanTramSPKM']) / 100)); ?>
                                                <?php if ($gia_S_KM == $row5['gia_S']) { ?>
                                                    <p><?php echo $row5['TenSP']; ?></p>
                                                    <p><b><?php echo $row5['gia_S']; ?>.000 đ</b></p>
                                                <?php } else { ?>
                                                    <span><?php echo $row5['TenSP']; ?></span>
                                                    <span class="icon-sale">-<?php echo $row5['PhanTramSPKM']; ?>%</span> <br>
                                                    <span style="color: #f04388;"><b><?php echo $gia_S_KM; ?>.000 đ</b></span>
                                                    <span style="text-decoration: line-through; font-size:10px;"><b><?php echo $row5['gia_S']; ?>.000 đ</b></span>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="menu-all-right-item-icon">
                                            <?php
                                            $isLiked = false;
                                            if (isset($_SESSION['id'])) {
                                                $idsp = $row5['IdSP'];
                                                $idkh = $_SESSION['id'];
                                                $kiemtra_yeuthich = $tt->kiemtrayeuthich($idsp, $idkh);
                                                if (mysqli_num_rows($kiemtra_yeuthich) > 0) {
                                                    $isLiked = true;
                                                }
                                            }
                                            ?>
                                            <button class="likebutton" data-value="<?php echo $row5['IdSP']; ?>">
                                                <i class="heart-icon <?php echo ($isLiked ? 'fas' : 'far'); ?> fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    } elseif (isset($_GET['tu']) && ($_GET['tu'] > 0) && isset($_GET['den']) && ($_GET['den'] > 0)) {
                        $tien1 = $_GET['tu'];
                        $tien2 = $_GET['den'];
                        $kqhienthi6 = $tt->hienthisanphamtheogiatien($tien1, $tien2);
                        $soSPTrenMotTrang = 12;
                        $TongsoSP = mysqli_num_rows($kqhienthi6);
                        $tst = ceil($TongsoSP / $soSPTrenMotTrang);
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        // Tính vị trí lấy sp
                        $batdautu = ($page - 1) * $soSPTrenMotTrang;
                        $i = 1;

                        $kqtrang = $tt->hienthisanphamtheogiatientheotrang($tien1, $tien2, $batdautu, $soSPTrenMotTrang);



                        if (!($kqtrang)) {
                            die("Kết nối thất bại");
                        } elseif (mysqli_num_rows($kqtrang) > 0) {
                            while ($row6 = $kqtrang->fetch_assoc()) {
                                $id6 = $row6['IdSP']; ?>
                                <div class="menu-all-right-item">
                                    <div class="menu-all-right-item-img">
                                        <a href="index.php?view=chitiet&id=<?php echo $id6; ?>">
                                            <img src="../../assets/img/product/<?php echo $row6['HinhAnh']; ?>" alt="" width="100%" height="100%" style="border-radius: 10px;">
                                        </a>
                                    </div>
                                    <div class="menu-all-right-item-main">
                                        <div class="menu-all-right-item-text">
                                            <a href="index.php?view=chitiet&id=<?php echo $id6; ?>">
                                                <?php if ($row6['gia_S_giam'] == $row6['gia_S']) { ?>
                                                    <span><?php echo $row6['TenSP']; ?></span>
                                                    <p><b><?php echo $row6['gia_S']; ?>.000 đ</b></p>
                                                <?php } else { ?>
                                                    <span><?php echo $row6['TenSP']; ?></span>
                                                    <span class="icon-sale">-<?php echo $row6['PhanTramSPKM']; ?>%</span> <br>
                                                    <span style="color: #f04388;"><b><?php echo $row6['gia_S_giam']; ?>.000 đ</b></span>
                                                    <span style="text-decoration: line-through; font-size:10px;"><b><?php echo $row6['gia_S']; ?>.000 đ</b></span>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="menu-all-right-item-icon">
                                            <?php
                                            $isLiked = false;
                                            if (isset($_SESSION['id'])) {
                                                $idsp = $row6['IdSP'];
                                                $idkh = $_SESSION['id'];
                                                $kiemtra_yeuthich = $tt->kiemtrayeuthich($idsp, $idkh);
                                                if (mysqli_num_rows($kiemtra_yeuthich) > 0) {
                                                    $isLiked = true;
                                                }
                                            }
                                            ?>
                                            <button class="likebutton" data-value="<?php echo $row6['IdSP']; ?>">
                                                <i class="heart-icon <?php echo ($isLiked ? 'fas' : 'far'); ?> fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    } elseif (isset($_POST['find'])) {
                        $kq_find = $tt->Search($_POST['tim_kiem']);
                        $soSPTrenMotTrang = 12;
                        $TongsoSP = mysqli_num_rows($kq_find);
                        $tst = ceil($TongsoSP / $soSPTrenMotTrang);
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        // Tính vị trí lấy sp
                        $batdautu = ($page - 1) * $soSPTrenMotTrang;
                        $i = 1;

                        $kqtrang_find = $tt->Searchtheotrang($_POST['tim_kiem'], $batdautu, $soSPTrenMotTrang);

                        if (!($kqtrang_find)) {
                            die("Kết nối thất bại");
                        } elseif (mysqli_num_rows($kqtrang_find) > 0) {
                            while ($row7 = $kqtrang_find->fetch_assoc()) {
                            ?>
                                <div class="menu-all-right-item">
                                    <div class="menu-all-right-item-img">
                                        <a href="index.php?view=chitiet&id=<?php echo $row7['IdSP']; ?>">
                                            <img src="../../assets/img/product/<?php echo $row7['HinhAnh']; ?>" alt="" width="100%" height="100%" style="border-radius: 10px;">
                                        </a>
                                    </div>
                                    <div class="menu-all-right-item-main">
                                        <div class="menu-all-right-item-text">
                                            <a href="index.php?view=chitiet&id=<?php echo  $row7['IdSP'];  ?>">
                                                <?php
                                                $gia_S_KM = round($row7['gia_S'] * (1 - ($row7['PhanTramSPKM']) / 100)); ?>
                                                <?php if ($gia_S_KM == $row7['gia_S']) { ?>
                                                    <p><?php echo $row7['TenSP']; ?></p>
                                                    <p><b><?php echo $row7['gia_S']; ?>.000 đ</b></p>
                                                <?php } else { ?>
                                                    <span><?php echo $row7['TenSP']; ?></span>
                                                    <span class="icon-sale">-<?php echo $row7['PhanTramSPKM']; ?>%</span> <br>
                                                    <span style="color: #f04388;"><b><?php echo $gia_S_KM; ?>.000 đ</b></span>
                                                    <span style="text-decoration: line-through; font-size:10px;"><b><?php echo $row7['gia_S']; ?>.000 đ</b></span>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="menu-all-right-item-icon">
                                            <?php
                                            $isLiked = false;
                                            if (isset($_SESSION['id'])) {
                                                $idsp = $row7['IdSP'];
                                                $idkh = $_SESSION['id'];
                                                $kiemtra_yeuthich = $tt->kiemtrayeuthich($idsp, $idkh);
                                                if (mysqli_num_rows($kiemtra_yeuthich) > 0) {
                                                    $isLiked = true;
                                                }
                                            }
                                            ?>
                                            <button class="likebutton" data-value="<?php echo $row7['IdSP']; ?>">
                                                <i class="heart-icon <?php echo ($isLiked ? 'fas' : 'far'); ?> fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        }
                    } else {
                        $kqhienthi = $tt->hienthitatcasanpham();
                        $soSPTrenMotTrang = 12;
                        $TongsoSP = mysqli_num_rows($kqhienthi);
                        $tst = ceil($TongsoSP / $soSPTrenMotTrang);
                        if (isset($_GET['page']))
                            $page = $_GET['page'];
                        else $page = 1;

                        //Tính vị trí lấy sp
                        $batdautu = ($page - 1) * $soSPTrenMotTrang;
                        $i = 1;
                        $kqtrang = $tt->hienthitatcasanphamtheotrang($batdautu, $soSPTrenMotTrang);
                        if (!($kqtrang)) {
                            die("Kết nối thất bại");
                        } elseif (mysqli_num_rows($kqtrang) > 0) {
                            while ($row = $kqtrang->fetch_assoc()) {
                                $id = $row['IdSP']; ?>
                                <div class="menu-all-right-item">
                                    <div class="menu-all-right-item-img">
                                        <a href="index.php?view=chitiet&id=<?php echo $id; ?>">
                                            <img src="../../assets/img/product/<?php echo $row['HinhAnh']; ?>" alt="" width="100%" height="100%" style="border-radius: 10px;">
                                        </a>
                                    </div>
                                    <div class="menu-all-right-item-main">
                                        <div class="menu-all-right-item-text">
                                            <a href="index.php?view=chitiet&id=<?php echo $id; ?>">
                                                <?php
                                                $gia_S_KM = round($row['gia_S'] * (1 - ($row['PhanTramSPKM']) / 100)); ?>
                                                <?php if ($gia_S_KM == $row['gia_S']) { ?>
                                                    <p><?php echo $row['TenSP']; ?></p>
                                                    <p><b><?php echo $row['gia_S']; ?>.000 đ</b></p>
                                                <?php } else { ?>
                                                    <span><?php echo $row['TenSP']; ?></span>
                                                    <span class="icon-sale">-<?php echo $row['PhanTramSPKM']; ?>%</span> <br>
                                                    <span style="color: #f04388;"><b><?php echo $gia_S_KM; ?>.000 đ</b></span>
                                                    <span style="text-decoration: line-through; font-size:10px;"><b><?php echo $row['gia_S']; ?>.000 đ</b></span>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="menu-all-right-item-icon">
                                            <?php
                                            $isLiked = false;
                                            if (isset($_SESSION['id'])) {
                                                $idsp = $row['IdSP'];
                                                $idkh = $_SESSION['id'];
                                                $kiemtra_yeuthich = $tt->kiemtrayeuthich($idsp, $idkh);
                                                if (mysqli_num_rows($kiemtra_yeuthich) > 0) {
                                                    $isLiked = true;
                                                }
                                            }
                                            ?>
                                            <button class="likebutton" data-value="<?php echo $row['IdSP']; ?>">
                                                <i class="heart-icon <?php echo ($isLiked ? 'fas' : 'far'); ?> fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>

                </div>

                <div class="manu-all-right-bottom">
                    <div class="manu-all-right-bottom-text">
                        <p align="center">Trang</p>
                        <span align="center">
                            <?php
                            for ($i = 1; $i <= $tst; $i++) {
                                if ($i == $page) {
                                    echo "<span class='phantrang'>$i</span> &nbsp;";
                                } elseif (isset($_GET['loai']) && $_GET['loai'] > 0) {
                                    $idloai = $_GET['loai'];
                                    echo '<a href="index.php?view=menu&loai=' . $idloai . '&page=' . $i . '">' . $i . '</a>&nbsp;';
                                } elseif (isset($_GET['sosao']) && ($_GET['sosao'] > 0)) {
                                    if ($_GET['sosao'] == '5') {
                                        echo '<a href="../../index.php?view=menu&sosao=5&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                    if ($_GET['sosao'] == '4') {
                                        echo '<a href="../../index.php?view=menu&sosao=4&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                    if ($_GET['sosao'] == '3') {
                                        echo '<a href="../../index.php?view=menu&sosao=3&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                    if ($_GET['sosao'] == '2') {
                                        echo '<a href="../../index.php?view=menu&sosao=2&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                    if ($_GET['sosao'] == '1') {
                                        echo '<a href="../../index.php?view=menu&sosao=1&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                } elseif (isset($_GET['tu']) && ($_GET['tu'] > 0) && (isset($_GET['den'])) && ($_GET['den'] > 0)) {
                                    if ($_GET['tu'] == '10.000' && $_GET['den'] == '20.000') {
                                        echo '<a href="../index.php?view=menu&tu=10.000&den=20.000&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                    if ($_GET['tu'] == '20.000' && $_GET['den'] == '30.000') {
                                        echo '<a href="../index.php?view=menu&tu=20.000&den=30.000&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                    if ($_GET['tu'] == '30.000' && $_GET['den'] == '40.000') {
                                        echo '<a href="../index.php?view=menu&tu=30.000&den=40.000&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                    if ($_GET['tu'] == '40.000' && $_GET['den'] == '50.000') {
                                        echo '<a href="../index.php?view=menu&tu=40.000&den=50.000&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                    if ($_GET['tu'] == '50.000' && $_GET['den'] == '100.000') {
                                        echo '<a href="../index.php?view=menu&tu=50.000&den=100.000&page=' . $i . '">' . $i . '</a>&nbsp;';
                                    }
                                } else
                                    echo "<a href='index.php?view=menu&page=$i'>$i</a>&nbsp;";
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".likebutton").forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var value = this.getAttribute("data-value");
            var clickedButton = this;
            var formData = new FormData();
            formData.append("idspyt", value);
            fetch("../../process.php", {
                    method: "POST",
                    body: formData
                })
                .then(function(response) {
                    if (response.ok) {
                        response.json().then(function(data) {
                            toggleLike(clickedButton, data.liked);
                        });
                    } else {
                        console.error("Request failed with status:", response.status);
                    }
                })
                .catch(function(error) {
                    console.error("Request failed with error:", error);
                });
        });
    });

    function toggleLike(button) {
        var icon = button.querySelector('.heart-icon');
        if (icon.classList.contains('far')) {
            icon.classList.remove('far');
            icon.classList.add('fas');
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
        }
    }
</script>