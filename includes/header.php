<!doctype html>
<?php require_once './bootstrap.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="rofi">
    <meta name="keywords" content="stock management system">


    <!-- assets -->
    <link rel="stylesheet" href="./assets/bootstrap-5.2.0/css/bootstrap.min.css">
    <!--link rel="stylesheet" href="./assets/font-awesome-6.1.2/css/fontawesome.min.css"-->

    <link rel="stylesheet" href="./assets/DataTables-1.12.1/datatables.min.css">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="assets/fromInternet/googleapsis.css" rel="stylesheet">
    <link href="assets/fromInternet/fontawsome.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <title><?php echo SITENAME; ?></title>
    <script src="assets/jquery-3.6.0/jquery-3.6.0.js"></script>
    <script src="assets/DataTables-1.12.1/datatables.min.js"></script>
    <script src="assets/fromInternet/fontawsome-422978ac6d.js"></script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- what I added manualy -->
</head>
<style>
    

    /* Height for devices larger than 576px */
    @media (min-width: 992px) {
        #intro {
            margin-top: -58.59px;
        }
    }

    .navbar .nav-link {
        color: #fff !important;
    }
</style>

<body>
    <?php session_start();
    if (isset($_SESSION['connected'])) {
        require_once 'includes/main_header.php';
    }?>
    <div class="container-fluid main_div" id="main_div">

    
