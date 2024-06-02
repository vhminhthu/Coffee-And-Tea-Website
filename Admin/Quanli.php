<?php
include("dbcon.php");
$tt = new dbcon();
session_start();
ob_start();
if (isset($_POST['IdHD'])) {
    $IdHD = $_POST['IdHD'];
} else {
    $IdHD = '1'; // Giá trị mặc định cho $idHD
}


if(isset($_SESSION['taikhoan'])){
    if($_SESSION['taikhoan'] == "user"){
        header("location:../../../index.php");
    }
}

$id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/7c3b305d2f.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="script.js"></script>

  
  
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
                <li >
                    <a href="Index.php">
                        <span><b style="font-size: 15px"> Admin </b></span>
                    </a>
                </li>
                <li class="active" >
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
            </ul>
        </div>
    </div>


    <main>
        <div class="cards">
            <div class="card">
                <div class="card-icon">
                    <span><i class='bx bxs-message-square-dots' style='color:#f779ad'></i></span>
                </div>
                <div class="card-info">
                     <h2 class="order" style="text-align: center;"><?php echo $tt->TotalComments(); ?></h2> 
                    <small class="order-label">Comments</small>
                    
                </div>
                <div class="card-image">
                    <div style="background-image: url(2.jpg);"></div>
                    <div style="background-image: url(2.jpg);"></div>
                    <div style="background-image: url(2.jpg);"></div>
                    <div style="background-image: url(2.jpg);"></div>
                    <div style="background-image: url(2.jpg);"></div>
                </div>
            </div>


            <div class="card">
                <div class="card-icon">
                    <span><i class='bx bxs-group' style='color:#f779ad'></i></span>
                </div>
                <div class="card-info">
                <h2 class="order" style="text-align: center;"><?php echo $tt->TotalUsers(); ?></h2> 
                    <small class="order-label">Customers</small>
                </div>
            </div>

            <div class="card">
                <div class="card-icon">
                    <span><i class='bx bx-shopping-bag' style='color:#f779ad'  ></i></span>
                </div>
                <div class="card-info">
                    <h2 class="order" style="text-align: center;"><?php echo $tt->TotalOrders(); ?></h2>
                    <div style="display: inline-block;margin-left:85px">
                    <span ><small  class="order-label">Orders</small></span>
                       <i><span class="incr"><i class='bx bxs-up-arrow-circle' style='color:#78e786; font-size:15px; ' ></i>  <?php echo $tt->TotalOrdersX(); ?></span></i> 
                </div>    
                </div>
                
                <div class="card-image">
                    <div style="background-image: url(2.jpg);"></div>
                    <div style="background-image: url(2.jpg);"></div>
                    <div style="background-image: url(2.jpg);"></div>
                    <div style="background-image: url(2.jpg);"></div>
                    <div style="background-image: url(2.jpg);"></div>
                </div>
            </div>

        </div>
    </main>
   <!--<div id="chart_div"> </div> -->
   <div id="scrollbar">
   <?php
                $kq = $tt->LienHe();
                while ($row = $kq->fetch_assoc()) {
                ?>
                        <div class="scrollbar-content"> 
                            <p><b><?php echo $row['Ten'];  ?></b> <span style="color: #f779ad; font-size:14px;">(<?php echo $row['Email'];  ?>)</span></p>
                            
                            <p style="font-size: 12px;"><?php echo $row['ThoiGian'];  ?></p>
                            <p> <?php echo $row['NoiDung'];  ?></p>
                        </div>
                        <?php } ?>
    </div>

    <div class="leaderboard">
    <h3 style="text-align: center;"> top thức uống bán chạy</h3>
    <div class="block">
    <?php
    // Assigning value to variable top_sp
    $kq = $tt->leaderboard();
    while ($row = $kq->fetch_assoc()) {
    
        echo '<div class="img" style="background-color: #f779ad"></div>';
        echo '<div class="tensp">' . $row['TenSP'] . '</div>';
        echo "<div class='giathanh'>" . $row['SoLuong']  .  "<i style='margin-left:5px;' class='fa-solid fa-eye'></i></div>";


    } 
?>
    </div>
</div>

</body>

</html>