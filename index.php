
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="view/chat/chat.css">

    <title> Cheo Tea and Coffee </title>

    <!--font-->
    <link rel="stylesheet" href="assets/css/fonts.css">

    <!--icon-->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    
</head>

<body>
    <?php
    set_include_path(get_include_path() . PATH_SEPARATOR . 'D:\xampp\htdocs\k2');
    include_once('view/home/header.php');
    include_once('view/home/nav.php');

    if (isset($_GET['view'])) {
        switch ($_GET['view']) {
            case 'menu':
                include_once('view/nav/menu.php');
                break;
            case 'lienhe':
                include_once('view/nav/lienhe.php');
                break;
            case 'giohang':
                include_once('view/cart/giohang.php');
                break;
            case 'form':
                include('view/cart/form.php');
                break;
            case 'thanhtoan':
                include_once('view/cart/thanhtoan.php');
                break;

            case 'dangky':
                include_once('view/user/dangky.php');
                break;
            case 'dangnhap':
                include_once('view/user/dangnhap.php');
                break;
            case 'taikhoan':
                include_once('view/user/taikhoan.php');
                break;
            case 'formThayDoi':
                include_once('view/user/formThayDoi.php');
                break;

            case 'yeuthich':
                include_once('view/user/yeuthich.php');
                break;
            case 'chitiet':
                include_once('view/product/chitiet.php');
                break;
            case 'form':
                include_once('view/cart/form.php');
                break;
        }
    } else
        include_once('view/home/main.php');
    include_once('view/chat/chatUser.php');

    include_once('view/home/footer.php');
    ?>

</body>

</html>
