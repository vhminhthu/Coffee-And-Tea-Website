<?php

ob_start();
session_start();
include_once("chatDbcon.php");
$tt = new chatdbcon;
if(isset($_SESSION['taikhoan'])){
    if($_SESSION['taikhoan'] == "user"){
        header("location:../../../index.php");
    }
}
$idnguoigui = "admin";

$kq = $tt->hienthikhachhang();
$output = "";
if (!$kq) {
    die("Kết nối thất bạn");
}

if (mysqli_num_rows($kq) == 0) {
    $output .= "Không có người dùng nào để trò chuyện";
} else {
    while ($row = mysqli_fetch_assoc($kq)) {
        $kq2 = $tt->hienthitinnhancuoicung($row['IdKH'], $idnguoigui);
        if (!$kq2) {
            die("Kết nối thất bạn");
        }
        $row2 = mysqli_fetch_assoc($kq2);
        $result = (mysqli_num_rows($kq2) > 0) ? $row2['NoiDung'] : "Không có tin nhắn";
        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;
        $you = (isset($row2['IdNguoiGui']) && $idnguoigui == $row2['IdNguoiGui']) ? "Bạn: " : "";
        $hid_me = ($idnguoigui == $row['IdKH']) ? "hide" : "";
        $time = isset($row2['NgayGio']) && $row2['NgayGio'] != '' ? $row2['NgayGio'] : "";
        $output .= '<a href="chatAdmin.php?user_id=' . $row['IdKH'] . '">
            <div class="details">
                <span><b>' . $row['TenKH'] .  '</b></span>
                <p><b> ' . $you . '</b>' . $msg . '</p>
                <p>' . $time .  '</p>
            </div>
    </a>';
    }
}
echo $output;
?>
