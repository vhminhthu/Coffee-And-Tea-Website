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
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
                <li class="active">
                    <a href="Index.php">
                        <span><b style="font-size: 15px"> Admin </b></span>
                    </a>
                </li>
                <li >
                    <a href="Quanli.php">
                        <span><b style="font-size: 15px"> Quản lí </b></span>
                    </a>
                </li>
                <li>
                    <a href="Catergory.php">
                        <span><b style="font-size: 15px"> Hóa Đơn </b></span>
                    </a>
                </li>
                <li>
                    <a href="chatAdminList.php">
                        <span><b style="font-size: 15px"> Chat </b> </span>
                    </a>
                </li>
                <li>
                    <a href="Sanpham.php">
                        <span><b style="font-size: 15px"> Drink </b></span>
                    </a>
                </li>
                <li class="logout">
                    <span><b style="font-size: 16px"> Logout</b></span>
                </li>
            </ul>
        </div>
    </div>

    <div class="content-admin"  >
        <div class="info-admin">
            <div class="info">
            <span> Xin chào ,<b> <?php echo "" .$_SESSION['hoten'];?> </b> </span> 
             <span> Email:<b> <?php echo "" .$_SESSION['email'];?> </b> </span> 
             <span> SĐT:<b> <?php echo "" .$_SESSION['sdt'];?> </b> </span>
            </div>
        
            <div class="container-calendar">
    <div class="calendar">
      <header>
        <h3></h3>
        <nav>
          <button id="prev"></button>
          <button id="next"></button>
        </nav>
      </header>
      <section>
        <ul class="days">
          <li>Sun</li>
          <li>Mon</li>
          <li>Tue</li>
          <li>Wed</li>
          <li>Thu</li>
          <li>Fri</li>
          <li>Sat</li>
        </ul>
        <ul class="dates"></ul>
      </section>
    </div>
  </div>
    </div>
 <script src="script.js"></script>
        </div>
   
        <div class="container-table-1" >
       <div class="circle" ><p><i class='bx bx-money' style='color:#646262 ;font-size:50px;'  ></i></p></div> 
           <p style="margin-right:20px;color:#646262"><b>Revenue</b></p>
           <p><b><?php echo $tt->TotalRevenue(); ?>   VNĐ </b></p> 
        </div>
      
  </body>
   
</body>

</html>