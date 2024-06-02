<?php
ob_start();
session_start();
include("../../view/chat/chatDbcon.php");
$tt = new chatdbcon;

if (isset($_SESSION['id'])) {
    $outgoing_id = $_SESSION['id'];

    if (isset($_POST['message']) && !empty($_POST['message'])) {
        $message = $_POST['message'];
        $kq = $tt->themtinnhan($message, $outgoing_id);
        if (!$kq) {
            die("Đã xảy ra lỗi khi gửi tin nhắn.");
        }
    }

    if (isset($_POST['incoming_id'])) {
        $incoming_id = $_POST['incoming_id'];
        $output = "";
        $kq2 = $tt->laytinnhan($outgoing_id);
        if (!$kq2) {
            die("Đã xảy ra lỗi khi lấy tin nhắn.");
        }
        if (mysqli_num_rows($kq2) > 0) {
            while ($row = mysqli_fetch_assoc($kq2)) {
                if ($row['IdNguoiGui'] === $outgoing_id) {
                    $output .= '<div class="chat outgoing" style="text-align:right; margin-bottom:15px;" >
                                    <div class="details">
                                        <p>' . $row['NoiDung'] . '</p>
                                    </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming" style="text-align:left; margin-bottom:15px;">
                                    <div class="details">
                                        <p>' . $row['NoiDung'] . '</p>
                                    </div>
                                </div>';
                }
            }
        } else {
            $output .= '<div class="text-hoi" style="text-align:left; margin-top:15px;"><p>  Bạn đang cần sự giúp đỡ gì ạ? </p></div>';
        }
        echo $output;
    }
} else {
    header("location: ../../../../index.php?view=dangnhap");
}
