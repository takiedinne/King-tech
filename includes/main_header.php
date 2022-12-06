
<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>King<span>Tech</span></h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="admin_home.php">Home</a></li>
                <li class="dropdown"><a href="#"><span>History</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="invoices.php">Invoices</a></li>
                        <li><a href="supplyOpt.php">Supply operations</a></li>
                    </ul>
                </li>
                <li><a href="items.php">Items</a></li>
                <li><a href="suppliers.php">Suppliers</a></li>
                <li class="dropdown"><a href="#"><span>Dashboard</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="Dashboard.php?type=day">Daily</a></li>
                        <li><a href="Dashboard.php?type=week">Weekly</a></li>
                        <li><a href="Dashboard.php?type=month">Monthly</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Welcome <?php echo $_SESSION['user_name'];  echo '&nbsp;&nbsp; '.date('h:i:sa');?></span></a>
                    <ul>
                        <li>
                            <div class="container d-flex justify-content-center align-items-center">
                                <div class="card ">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="round-image">
                                            <img src="assets/img/kingtech/profileIcon.png" class="rounded-circle" width="97">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h4 class="mt-3"><?php echo $_SESSION['user_name'] .' '. $_SESSION['user_surname'];?><br/> <?php echo '@'.$_SESSION['user_psudoname'];?></h4>
                                        
                                        <span>Manager</span>
                        
                                        <div class="px-5">
                                            
                                            <div class="d-flex justify-content-center" ><a href="change_pass.php">change password ?</a></div>  
                                            <div class="d-flex justify-content-center"><a href="logout.php" role="button">Logout</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav><!-- .navbar -->

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
    <!-- ======= Toasts containers ======= -->
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div id="toasts_container" class="toasts_container position-absolute top-0 end-0 p-3" >
            
        </div>
    </div>
</header><!-- End Header -->
<!-- End Header -->
