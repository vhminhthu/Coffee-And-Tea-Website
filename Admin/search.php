<?php
ob_start();
session_start();
include_once("chatDbcon.php");
$tt = new chatdbcon();

if(isset($_SESSION['taikhoan'])){
    if($_SESSION['taikhoan'] == "user"){
        header("location:../../../index.php");
    }
}

if (isset($_POST['searchTerm'])) {
    $outgoing_id = "admin"; // Giả sử "admin" là ID của người gửi
    $searchTerm = $_POST['searchTerm']; 
  
    $kq = $tt->search($searchTerm);
    $output = "";

    if (!$kq) {
        die("Kết nối thất bại");
    }

    if (mysqli_num_rows($kq) > 0) {
        while ($row = mysqli_fetch_assoc($kq)) {
            $kq2 = $tt->hienthitinnhancuoicung($row['IdKH'], $outgoing_id);
            $row2 = mysqli_fetch_assoc($kq2);
            $result = (mysqli_num_rows($kq2) > 0) ? $row2['NoiDung'] : "Không có tin nhắn";
            $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;
            $you = (isset($row2['IdNguoiGui']) && $outgoing_id == $row2['IdNguoiGui']) ? "Bạn: " : "";
            $hid_me = ($outgoing_id == $row['IdKH']) ? "hide" : "";

            $time = isset($row2['NgayGio']) && $row2['NgayGio'] != '' ? $row2['NgayGio'] : "";
            $output .= '<a href="chatAdmin.php?user_id=' . $row['IdKH'] . '">
            <div class="details">
                <span><b>' . $row['TenKH'] .  '</b></span>
                <p><b> ' . $you . '</b>' . $msg . '</p>
                <p>' . $time .  '</p>
            </div>
    </a>';
        }
    } else {
        $output .= '<p style="font-size:25px;">Không tìm thấy người dùng liên quan đến từ khóa tìm kiếm của bạn</p>';
    }

    echo $output;
} else {
    echo "Không có dữ liệu tìm kiếm được gửi đi";
}
