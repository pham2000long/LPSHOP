<?php require_once 'Helpers/Helper.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LPSHOP</title>
    <link rel="canonical" href="http://localhost"/>
    <link rel="alternate" href="http://localhost" hreflang="vi-vn"/>
    <meta name="robots" content="index,follow,noodp">
    <meta name="author" content="http://localhost">
    <meta name="copyright" content="http://localhost"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="LPSHOP"/>
    <meta property="og:url" content="http://localhost"/>
    <meta property="og:site_name" content="http://localhost"/>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/ajax.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>


    <?php require_once 'header.php';?>
<div class="message">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($this->error)): ?>
        <div class="alert alert-danger">
            <?php
            echo $this->error;
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>
</div>
    <!--    hiển thị nội dung động -->
    <?php echo $this->content; ?>

<?php require_once 'footer.php';?>


</html>
