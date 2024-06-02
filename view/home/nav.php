<?php
include_once("dbconn.php");
$tt = new dbconn;
?>
<!-- Nav  -->
<nav>
    <!-- Thanh điều hướng  -->
    <ul>
        <li> <a href="index.php">HOME</a></li>
        <li> <a href="index.php?view=menu&page=1">MENU</a></li>
        <li> <a href="index.php?view=lienhe">LIÊN HỆ</a></li>
    </ul>

    <div class="nav-logo"> <i class="fa-solid fa-seedling"></i> </div>

    <!-- Tìm kiếm  -->
    <div class="search"> <i class="fa-solid fa-magnifying-glass"></i>
        <form method="post" action="../../index.php?view=menu">
            <input type="text" class="tim_kiem" name="tim_kiem" placeholder="Tìm kiếm ... " autocomplete="on">
            <input type="submit" class="find" name="find" value="Tìm">
        </form>
    </div>

</nav>