<?php
ob_start();
session_start();
include_once("dbconn.php");
$tt = new dbconn;

if (isset($_GET['id']) && ($_GET['id'] > 0)) {
    $lay = $tt->laysoluongnguoixem($_GET['id']);
    if (!($lay)) {
        die("Kết nối thất bại");
    } else
        if (mysqli_num_rows($lay) > 0) {
        $rowlay = $lay->fetch_assoc();
        $soluong = $rowlay['SoLuong'];
        $soluong++;
        $capnhat = $tt->capnhatsoluongnguoixem($_GET['id'], $soluong);
    }
}

if (isset($_GET['id']) && ($_GET['id'] > 0)) {
    $id = $_GET['id'];
    $kqhienthi = $tt->hienthisanpham($id);
    $kqhienthi2 = $tt->hienthitentheloai($id);
    $kqmt = $tt->hienthimonthemsanpham();
    if (!($kqhienthi) && !($kqhienthi2) && !($kqmt)) {
        die("Kết nối thất bại");
    } else
        if (mysqli_num_rows($kqhienthi) > 0 && mysqli_num_rows($kqhienthi2) > 0 && mysqli_num_rows($kqmt) > 0) {
        $row = $kqhienthi->fetch_assoc();
        $row2 = $kqhienthi2->fetch_assoc();
        $idsp = $row['IdSP'];
        $idloai = $row['IdLoai'];
?>
        <!-- Chi tiết sản phẩm  -->
        <div class="product">
            <div class="product-main">
                <div class="product-main-text">
                    <a href="../../index.php">Trang chủ</a>
                    <span> > </span>
                    <a href="../../index.php?view=menu"> Tất cả sản phẩm</a>
                    <span> > </span>
                    <a href="index.php?view=menu&loai=<?php echo $idloai ?>"><?php echo $row2['ten_the_loai']; ?></a>
                    <span> > </span>
                    <a href="#"><?php echo $row['TenSP']; ?></a>
                </div>

                <div class="product-main-all">
                    <div class="product-main-all-top">
                        <div class="product-main-all-top-left">
                            <img src="../../assets/img/product/<?php echo $row['HinhAnh']; ?>" alt="" width="100%" height="100%">
                        </div>
                        <div class="product-main-all-top-right">
                            <div class="product-main-all-top-right-ten">
                                <h4 style="font-size: 25px;"> <?php echo $row['TenSP']; ?> </h4>
                                <?php if ($row['PhanTramSPKM'] > 0) { ?>
                                    <span class="icon-sale">-<?php echo $row['PhanTramSPKM']; ?>%</span>
                                <?php } ?>
                            </div>
                            <?php
                            $gia_S_KM = round($row['gia_S'] * (1 - ($row['PhanTramSPKM']) / 100));
                            $gia_M_KM = round($row['gia_M'] * (1 - ($row['PhanTramSPKM']) / 100));
                            $gia_L_KM = round($row['gia_L'] * (1 - ($row['PhanTramSPKM']) / 100)); ?>
                            <h5 id="giasaukhigiam" class="giagiam"></h5>
                            <h5 id="giabandau" class="giabandau"></h5>
                            <p id="displayNames"></p>
                            <div class="chitiet">
                                <form action="../process.php" method="post" enctype="multipart/form-data">
                                    <div class="chitiet size">
                                        <input type="radio" id="S" name="size" value="S" onchange="updateHiddenPrice('<?php echo $gia_S_KM; ?>', '<?php echo $gia_M_KM; ?>', '<?php echo $gia_L_KM; ?>')" checked>
                                        <label for="sizeS">S</label>
                                        <input type="radio" id="M" name="size" value="M" onchange="updateHiddenPrice('<?php echo $gia_S_KM; ?>', '<?php echo $gia_M_KM; ?>', '<?php echo $gia_L_KM; ?>')">
                                        <label for="sizeM">M</label>
                                        <input type="radio" id="L" name="size" value="L" onchange="updateHiddenPrice('<?php echo $gia_S_KM; ?>', '<?php echo $gia_M_KM; ?>', '<?php echo $gia_L_KM; ?>')">
                                        <label for="sizeL">L</label>
                                    </div>
                                    <div class="chitiet sl">
                                        <label for="soluong">Số lượng</label>
                                        <input type="number" id="soluong" name="soluong" min="1" max="100" value="1">
                                    </div>
                                    <div class="chitiet ice-sugar">
                                        <div class="chitiet ice">
                                            <label for="ice">ICE-%</label>
                                            <select class="select ice" name="ice" id="ice">
                                                <option value="100">100</option>
                                                <option value="70">70</option>
                                                <option value="50">50</option>
                                                <option value="30">30</option>
                                                <option value="10">10</option>
                                                <option value="0">Không đá</option>
                                            </select>
                                        </div>
                                        <div class="chitiet sugar">
                                            <label for="sugar">SUGAR-%</label>
                                            <select class="select sugar" name="sugar" id="sugar">
                                                <option value="100">100</option>
                                                <option value="70">70</option>
                                                <option value="50">50</option>
                                                <option value="38">30</option>
                                                <option value="10">10</option>
                                                <option value="0">Không đường</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="monthem container">
                                        <div class="select-btn">
                                            <span class="btn-text">Món thêm</span>
                                            <span class="arrow-dwo">
                                                <i class="fa-solid fa-angle-down"></i>
                                            </span>
                                        </div>
                                        <div class="list-items">
                                            <?php
                                            while ($rowmt = $kqmt->fetch_assoc()) {
                                                $idmt = $rowmt["IdSP"];
                                                $tenmt = $rowmt["TenSP"];
                                                $giamt = $rowmt['GiaTheoSize']; 
                                            ?>
                                                <li class="item" data-giasp="<?php echo $giamt; ?>" data-tensp="<?php echo $tenmt; ?>" value="<?php echo $idmt; ?>">
                                                    <span class="checkbox">
                                                        <i class="fa-solid fa-check check-icon"></i>
                                                    </span>
                                                    <span class="item-text"><?php echo $tenmt; ?> </span>
                                                    <span class="item-text price"> (+<?php echo $giamt; ?>000) </span>
                                                    <input type="number" class="soluongmonthem" name="soluongmonthem" min="1" max="20" value="1" onclick="event.stopPropagation()">
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="chitiet-submit">
                                        <input type="hidden" name="id" value="<?php echo $row['IdSP']; ?>">
                                        <input type="hidden" name="hinhanh" value="<?php echo $row['HinhAnh']; ?>">
                                        <input type="hidden" name="tensp" value="<?php echo $row['TenSP']; ?>">
                                        <input type="hidden" id="giasp" name="giasp">
                                        <input type="hidden" id="tenspmt" name="tenspmt" value="<?php echo isset($tenspmt) ? $tenspmt : ''; ?>">
                                        <input type="hidden" name="giaspmt" value="<?php echo isset($totalPrice) ? $totalPrice : ''; ?>">
                                        <input type="submit" name="dathang" value="CHỌN" onclick="thongbaothanhcong()">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="product-main-all-bottom">
                        <div class="product-main-all-bottom-1">
                            <div class="product-main-all-bottom1-text">
                                <p> Sản phẩm tương tự </p>
                            </div>
                            <div class="product-main-all-bottom1-main">
                                <?php
                                $kqhienthilienquan = $tt->hienthisanphamlienquan($idloai, $idsp);
                                if (!($kqhienthilienquan)) {
                                    die("Kết nối thất bại");
                                } else if (!(mysqli_num_rows($kqhienthilienquan))) {
                                    echo "<h2 class='main-chitiet-khongco-chu'> Hiện tại, Không có sản phẩm nào có cùng thể loại ấy! </h2>"; ?>
                                    <?php
                                } else {
                                    while ($rowlq = $kqhienthilienquan->fetch_assoc()) {
                                        $idlq = $rowlq['IdSP']; ?>

                                        <div class="product-main-all-bottom1-main-item">
                                            <div class="product-main-all-bottom1-main-item-img">
                                                <a href="index.php?view=chitiet&id=<?php echo $rowlq['IdSP']; ?>">
                                                    <img src="../../assets/img/product/<?php echo $rowlq['HinhAnh']; ?>" alt="" width="100%" height="100%" style="border-radius: 10px;">
                                                </a>
                                            </div>
                                            <div class="product-main-all-bottom1-main-item-main">
                                                <div class="product-main-all-bottom1-main-item-text">
                                                    <a href="index.php?view=chitiet&id=<?php echo $rowlq['IdSP']; ?>">
                                                        <?php
                                                        $gia_S_KM2 = round($rowlq['gia_S'] * (1 - ($rowlq['PhanTramSPKM']) / 100)); ?>
                                                        <?php if ($gia_S_KM2 == $rowlq['gia_S']) { ?>
                                                            <p><?php echo $rowlq['TenSP']; ?></p>
                                                            <p><b><?php echo $rowlq['gia_S']; ?>.000 đ</b></p>
                                                        <?php } else { ?>
                                                            <span><?php echo $rowlq['TenSP']; ?></span>
                                                            <span class="icon-sale">-<?php echo $rowlq['PhanTramSPKM']; ?>%</span> <br>
                                                            <span style="color: #f04388;"><b><?php echo $gia_S_KM2; ?>.000 đ</b></span>
                                                            <span style="text-decoration: line-through; font-size:10px;"><b><?php echo $rowlq['gia_S']; ?>.000 đ</b></span>
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                                <div class="product-main-all-bottom1-main-item-icon">
                                                    <?php
                                                    $isLiked = false;
                                                    if (isset($_SESSION['id'])) {
                                                        $kiemtra_yeuthich = $tt->kiemtrayeuthich($rowlq['IdSP'], $_SESSION['id']);
                                                        if (mysqli_num_rows($kiemtra_yeuthich) > 0) {
                                                            $isLiked = true;
                                                        }
                                                    }
                                                    ?>
                                                    <button class="likebutton" data-value="<?php echo $rowlq['IdSP']; ?>">
                                                        <i class="heart-icon <?php echo ($isLiked ? 'fas' : 'far'); ?> fa-heart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="product-main-all-bottom-2">
                            <div class="product-main-all-bottom-2-danhgia-text">
                                <p> Đánh giá của khách hàng </p>
                            </div>
                            <div class="product-main-all-bottom-2-danhgia">
                                <div class="product-main-all-bottom-2-danhgia-main" style="background-color: #ffe0ed;">
                                    <?php
                                    if (!isset($_SESSION['id'])) {
                                        echo '                                
                                        <div class="rating-text">
                                            <p>Vui lòng <a href="../../index.php?view=dangnhap" style="text-decoration: none; color:blue;">Đăng nhập</a> để đánh giá</p>
                                        </div>
                                        ';
                                    } else {
                                        $kiemtramuahang = $tt->kiemtradamuaspchua($idsp, $_SESSION['id']);
                                        if (!($kiemtramuahang)) {
                                            die("Kết nối thất bại");
                                        }
                                        if (!(mysqli_num_rows($kiemtramuahang))) {
                                            echo '                                
                                        <div class="rating-text">
                                            <p>Vui lòng mua sản phẩm mới được đánh giá</p>
                                        </div>
                                        ';
                                        } else {
                                            $kiemtrabinhluan = $tt->kiemtradebinhluan($idsp, $_SESSION['id']);
                                            if (!($kiemtrabinhluan)) {
                                                die("Kết nối thất bại");
                                            }
                                            if ((mysqli_num_rows($kiemtrabinhluan))) {
                                                echo '                                
                                        <div class="rating-text">
                                            <p>Bạn đã đánh giá sản phẩm rồi</p>
                                        </div>
                                        ';
                                            } else {
                                    ?>

                                                <form action="#" class="rating-form">
                                                    <input type="text" class="rating-idsp" name="rating-idsp" value="<?php echo $idsp; ?>" hidden>
                                                    <input type="text" class="rating-idkh" name="rating-idkh" value="<?php echo $_SESSION['id']; ?>" hidden>
                                                    <div class="rating-text">
                                                        <p><b>WRITE A REVIEW</b></p>
                                                    </div>
                                                    <div class="rating-text-2">
                                                        <p>Score:</p>
                                                    </div>
                                                    <div class="rating">
                                                        <input value="1" name="rate" id="star1" type="radio" class="rating-star">
                                                        <label title="text" for="star1">★</label>
                                                        <input value="2" name="rate" id="star2" type="radio" class="rating-star">
                                                        <label title="text" for="star2">★</label>
                                                        <input value="3" name="rate" id="star3" type="radio" class="rating-star">
                                                        <label title="text" for="star3">★</label>
                                                        <input value="4" name="rate" id="star4" type="radio" class="rating-star">
                                                        <label title="text" for="star4">★</label>
                                                        <input value="5" name="rate" id="star5" type="radio" class="rating-star">
                                                        <label title="text" for="star5">★</label>
                                                    </div>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function() {
                                                            const stars = document.querySelectorAll('.rating-star');
                                                            stars.forEach(function(star) {
                                                                star.addEventListener('change', function() {
                                                                    const currentValue = parseInt(this.value);
                                                                    stars.forEach(function(innerStar) {
                                                                        const innerValue = parseInt(innerStar.value);
                                                                        if (innerValue <= currentValue) {
                                                                            innerStar.nextElementSibling.style.color = '#ff93be';
                                                                        } else {
                                                                            innerStar.nextElementSibling.style.color = '#999';
                                                                        }
                                                                    });
                                                                });
                                                            });
                                                        });
                                                    </script>
                                                    <div class="rating-text-3">
                                                        <p>Review:</p>
                                                    </div>
                                                    <div class="rating-input">
                                                        <textarea class="rating-input" name="rating-input" id="rating-input" cols="100%" rows="5"></textarea>
                                                    </div>
                                                    <div class="rating-button-style">
                                                        <button class="rating-button" class="ratingbutton">Gửi</button>
                                                    </div>
                                                </form>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                                <div class="product-main-all-bottom-2-danhgia-all">
                                    <?php
                                    $kqhtbl = $tt->hienthibinhluan($idsp);
                                    if (!($kqhtbl)) {
                                        die("Kết nối thất bại");
                                    }
                                    if (!(mysqli_num_rows($kqhtbl))) {
                                        echo "<h2 class='main-chitiet-khongco-chu'> Sản phẩm chưa có bình luận nào cả </h2>";
                                    } ?>
                                    <?php while ($rowbl = $kqhtbl->fetch_assoc()) { ?>
                                        <div class="rating-item">
                                            <div class="rating-item-avata">
                                                <div class="rating-item-avata-main"></div>
                                            </div>
                                            <div class="rating-item-text">
                                                <span style="font-size: 20px;"><b><?php echo $rowbl['TenKH']; ?></b></span>
                                                <span class="rating-stars">
                                                    <?php
                                                    $soSao = intval($rowbl['SoSao']);
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $soSao) {
                                                            echo '<span  style="font-size: 30px;" class="star filled">&#9733;</span>';
                                                        } else {
                                                            echo '<span  style="font-size: 30px;" class="star">&#9734;</span>';
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                                <span  style="font-size: 15px;"><?php echo $rowbl['ThoiGianBinhLuan']; ?></span>
                                                <span  style="font-size: 15px;"><?php echo $rowbl['MoTa']; ?></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>




                <script>
                    function thongbaothanhcong() {
                        alert("Đã thêm món vào giỏ hàng")
                    }

                    // Xử lý giá cho từng size
                    function updateHiddenPrice(gia_S_KM, gia_M_KM, gia_L_KM) {
                        var giabandau;
                        var giasaukhigiam;
                        if (gia_S_KM == <?php echo $row['gia_S']; ?> &&
                            gia_M_KM == <?php echo $row['gia_M']; ?> &&
                            gia_L_KM == <?php echo $row['gia_L']; ?>) {

                            if (document.getElementById('M').checked) {
                                giabandau = <?php echo $row['gia_M']; ?>;
                            } else if (document.getElementById('L').checked) {
                                giabandau = <?php echo $row['gia_L']; ?>;
                            } else { 
                                giabandau = <?php echo $row['gia_S']; ?>;
                                document.getElementById('S').checked = true; 
                            }
                        } else {
                            if (document.getElementById('M').checked) {
                                giabandau = <?php echo $row['gia_M']; ?>;
                                giasaukhigiam = gia_M_KM;
                            } else if (document.getElementById('L').checked) {
                                giabandau = <?php echo $row['gia_L']; ?>;
                                giasaukhigiam = gia_L_KM;
                            } else {
                                giabandau = <?php echo $row['gia_S']; ?>;
                                giasaukhigiam = gia_S_KM;
                                document.getElementById('S').checked = true; 
                            }
                        }
                        if (giabandau !== undefined && giabandau !== null) {
                            document.getElementById('giabandau').innerHTML = giabandau + ".000 đ";
                        }

                        if (giasaukhigiam !== undefined && giasaukhigiam !== null) {
                            document.getElementById('giasaukhigiam').innerHTML = giasaukhigiam + ".000 đ";
                            var giaElements = document.getElementsByClassName('giabandau');
                            for (var i = 0; i < giaElements.length; i++) {
                                if (!giaElements[i].classList.contains('giam')) {
                                    giaElements[i].classList.add('giam');
                                }
                            }
                        }

                        var giaspValue = giasaukhigiam !== undefined && giasaukhigiam !== null ? giasaukhigiam : giabandau;
                        document.getElementById('giasp').value = giaspValue;
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        updateHiddenPrice(<?php echo $gia_S_KM; ?>, <?php echo $gia_M_KM; ?>, <?php echo $gia_L_KM; ?>);
                    });



                    //Xử lý giá món thêm
                    document.addEventListener("DOMContentLoaded", function() {
                        var monthemSelect = document.querySelector('select[name="monthem"]');
                        var tenspmtInput = document.querySelector('input[name="tenspmt"]');
                        var giaspmtInput = document.querySelector('input[name="giaspmt"]');

                        monthemSelect.addEventListener("change", function() {
                            var selectedOption = monthemSelect.options[monthemSelect.selectedIndex];
                            tenspmtInput.value = selectedOption.text;
                            giaspmtInput.value = selectedOption.getAttribute("data-giasp");
                        });
                        updateHiddenPrice();
                    });

                    //Xử lý dropdown checkbox của món thêm
                    const selectBtn = document.querySelector(".select-btn"),
                        items = document.querySelectorAll(".item");

                    selectBtn.addEventListener("click", () => {
                        selectBtn.classList.toggle("open");
                    });

                    items.forEach(item => {
                        item.addEventListener("click", () => {
                            item.classList.toggle("checked");

                            let checked = document.querySelectorAll(".checked"),
                                btnText = document.querySelector(".btn-text"),
                                totalPrice = 0;
                            checked.forEach(checkedItem => {
                                let pricePerItem = parseInt(checkedItem.getAttribute("data-giasp"));
                                let quantityInput = checkedItem.querySelector(".soluongmonthem");
                                let quantity = parseInt(quantityInput.value); 
                                totalPrice += pricePerItem * quantity;
                            });
                            document.querySelector('input[name="giaspmt"]').value = totalPrice;


                            if (checked && checked.length > 0) {
                                btnText.innerText = `${checked.length} Món thêm`;
                                btnText.innerText += ` - Tổng giá: ${totalPrice}000 đ`;
                            } else {
                                btnText.innerText = "Món thêm";
                            }

                            const displayNamesElement = document.getElementById('displayNames');

                            const itemsData = [];

                            checked.forEach(checkedItem => {
                                const price = parseInt(checkedItem.getAttribute("data-giasp"));
                                const productName = checkedItem.getAttribute("data-tensp");
                                const quantityInput = checkedItem.querySelector(".soluongmonthem");
                                const quantity = parseInt(quantityInput.value); 

                                const existingItem = itemsData.find(item => item.productName === productName);
                                if (!existingItem) {
                                    itemsData.push({
                                        productName,
                                        price: price * quantity,
                                        quantity
                                    });
                                }
                            });

                            const tong = itemsData.reduce((acc, item) => acc + item.price, 0);
                            const itemsText = itemsData.map(item => `${item.productName} (${item.quantity}) - ${item.price}000 đ`).join(', ');

                            displayNamesElement.innerText = itemsText;

                            const hiddenNamesInput = document.getElementById('tenspmt');
                            hiddenNamesInput.value = itemsText;

                            // Hiển thị tổng giá
                            document.querySelector('.btn-text').innerText = `${itemsData.length} Món thêm - Tổng giá: ${tong}000 đ`;

                        });
                    });
                </script>


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

                <script>
                    //Xử lý đánh giá sản phẩm
                    const form = document.querySelector(".rating-form"),
                        idsp = form.querySelector(".rating-idsp").value,
                        idkh = form.querySelector(".rating-idkh").value,
                        input = form.querySelector(".rating-input"),
                        button = form.querySelector("button");

                    form.onsubmit = (e) => {
                        e.preventDefault();
                    };

                    input.focus();

                    button.onclick = () => {

                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "../../process.php", true);
                        xhr.onload = () => {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    input.value = "";
                                    alert("Cảm ơn đã đánh giá sản phẩm");
                                    location.reload(); //Load lại trang
                                } else {
                                    alert("Error: " + xhr.statusText);
                                }
                            }
                        };
                        let formData = new FormData(form);
                        xhr.send(formData);
                    };
                </script>
        <?php
    }
}
        ?>