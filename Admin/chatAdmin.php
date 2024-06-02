<?php 
include("dbcon.php");
$tt = new dbcon();
session_start();
ob_start();

if(isset($_SESSION['taikhoan'])){
    if($_SESSION['taikhoan'] == "user"){
        header("location:../../../index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Admin/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="chatAdmin.css">
    <title>Cheo Tea And Coffee</title>
</head>

<body>

    <div class="container">
        <div class="sidebar">
            <ul class="menu">
                <li>
                <a href="#">
                    <span><b style="font-size: 21px;margin-top:20px">Cheo Tea&Coffee </b></span>
                </li>
                <br>
                <li>
                    <a href="Index.php">
                        <span><b style="font-size: 15px"> ADMIN </b></span>
                    </a>
                </li>
                <li>
                    <a href="Quanli.php">
                        <span><b style="font-size: 15px"> Quản lí </b></span>
                    </a>
                </li>
                <li>
                    <a href="Catergory.php">
                        <span><b style="font-size: 15px"> Hóa đơn </b> </span>
                    </a>
                </li>
                <li class="active">
                    <a href="chatAdminList.php">
                        <span><b style="font-size: 15px"> Chat </b> </span>
                    </a>
                </li>
                <li>
                    <a href="Sanpham.php">
                        <span><b style="font-size: 15px"> Drink </b></span>
                    </a>
                </li>
                </li>
            </ul>
        </div>
        <?php
        $user_id = $_GET['user_id'];
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
                                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                                <button><i class="fa-regular fa-paper-plane"></i></button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
<script>
    const form = document.querySelector(".typing-area"),
        inputField = form.querySelector(".input-field"),
        sendBtn = form.querySelector("button"),
        incoming_id = form.querySelector(".incoming_id").value,
        chatBox = document.querySelector(".chat-box");

    form.onsubmit = (e) => {
        e.preventDefault();
    }

    inputField.focus();
    inputField.onkeyup = () => {
        if (inputField.value != "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    };
    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "chatProcessAdmin.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    }

    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    }
    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "chatProcessAdmin.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id=" + incoming_id);
    }, 500);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>