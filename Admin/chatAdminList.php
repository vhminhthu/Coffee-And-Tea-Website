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

        <div style="width: 100%;">
            <div class="container-fluid">
                <div id="text">
                    <h1> <b> Chat List </b> </h1>
                </div>
                <div class="search">
                    <div class="search-container">
                        <input type="text" placeholder="Nhập tên muốn tìm...">
                        <button><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
                <div class="users-list">

                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    const searchBar = document.querySelector(".search input"),
        searchIcon = document.querySelector(".search button"),
        usersList = document.querySelector(".users-list");
    searchIcon.onclick = () => {
        searchBar.classList.toggle("show");
        searchIcon.classList.toggle("active");
        searchBar.focus();
        if (searchBar.classList.contains("active")) {
            searchBar.value = "";
            searchBar.classList.remove("active");
        }
    }

    searchBar.onkeyup = () => {
        let searchTerm = searchBar.value;
        if (searchTerm != "") {
            searchBar.classList.add("active");
        } else {
            searchBar.classList.remove("active");
        }
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "search.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    usersList.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + searchTerm);
    }

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "AdminList.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (!searchBar.classList.contains("active")) {
                        usersList.innerHTML = data;
                    }
                }
            }
        }
        xhr.send();
    }, 500);
</script>