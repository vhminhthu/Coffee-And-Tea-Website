<?php
ob_start();
include_once("chatDbcon.php");
$tt = new chatdbcon;

if (!isset($_SESSION['id'])) { ?>
    <div class="chat-bar-collapsible">
        <button id="chat-button" type="button" class="collapsible" onclick="show()">Nhắn tin
            <i id="chat-icon" style="color: #fff;" class="fa-regular fa-comments"></i>
        </button>
    </div>
    <script>
        function show() {
            alert('Qúy khách vui lòng đăng nhập để nhắn tin!');
            location.href = './index.php?view=dangnhap';
        }
    </script>
<?php
} else {
?>
    <!-- CHAT BAR BLOCK -->
    <div class="chat-bar-collapsible">
        <button id="chat-button" type="button" class="collapsible">Nhắn tin
            <i id="chat-icon" style="color: #fff;" class="fa-regular fa-comments"></i>
        </button>
        <?php

        $user_id = $_SESSION['id'];
        $kq = $tt->laythongtin($user_id);
        if (!($kq)) {
            die("Kết nối thất bại");
        }
        if (mysqli_num_rows($kq) > 0) {
            $row = mysqli_fetch_assoc($kq);
        }
        ?>
        <div class="content">
            <div class="full-chat-block">
                <!-- Message Container -->
                <div class="outer-container">
                    <div class="chat-container">
                        <!-- Messages -->
                        <div class="chat-box">

                        </div>
                        <!-- User input box -->
                        <div class="chat-bar-input-block">
                            <form action="#" class="typing-area">
                                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                                <input type="text" name="message" class="input-field" placeholder="Nhập câu hỏi..." autocomplete="off">
                                <button class="button-submit"><i class="fa-regular fa-paper-plane"></i></button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="view/chat/chat.js"></script>
<?php } ?>