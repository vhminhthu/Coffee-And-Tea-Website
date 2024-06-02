<?php
ob_start();
session_start();
include("chatDbcon.php");
$tt = new chatdbcon;

if(isset($_SESSION['taikhoan'])){
    if($_SESSION['taikhoan'] == "user"){
        header("location:../../../index.php");
    }
}

$incoming_id = $_POST['incoming_id'];

if (isset($_POST['message']) && !empty($_POST['message'])) {
    // Sử dụng Prepared Statement để ngăn chặn SQL injection
    $message = $_POST['message'];
    $kq = $tt->themtinnhan2($message, $incoming_id);
    if (!$kq) {
        // Xử lý lỗi một cách thông minh hơn
        die("Đã xảy ra lỗi khi gửi tin nhắn.");
    }
}

if (isset($_POST['incoming_id'])) {
    $incoming_id = $_POST['incoming_id'];
    $output = "";
    // Sử dụng Prepared Statement
    $kq2 = $tt->laytinnhan($incoming_id);
    if (!$kq2) {
        die("Đã xảy ra lỗi khi lấy tin nhắn.");
    }
    if (mysqli_num_rows($kq2) > 0) {
        while ($row = mysqli_fetch_assoc($kq2)) {
            if ($row['IdNguoiGui'] === "admin") {
                $output .= '<div class="chat outgoing" style="text-align:right;">
                                    <div class="details">
                                        <p>' . $row['NoiDung'] . '</p>
                                    </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming" style="text-align:left;">
                                    <div class="details">
                                        <p>' . $row['NoiDung'] . '</p>
                                    </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">Không có tin nhắn</div>';
    }
    echo $output;
}
