<?php
session_start();
require_once 'bootstrap.php';
if (isset($_SESSION['connected'])) {
    header('location: '.URLROOT.'/admin_home.php');
    exit();
}
require_once 'includes/header.php';

?>

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
                </ul>
            </nav><!-- .navbar -->

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2>Welcome to <span>King Tech</span></h2>
                    <p>This web-app allows you to handle in the best way your shops</p>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#Login" class="btn-get-started">Login</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <img src="assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
                </div>
            </div>
        </div>
        <div class="icon-boxes position-relative">
            <div class="container position-relative">
                <div class="row gy-4 mt-5">

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-easel"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Selling</a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-gem"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Suppling</a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-geo-alt"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Phone Repair</a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-command"></i></div>
                            <h4 class="title"><a href="#hero" class="stretched-link" disabled>Consultation</a></h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <main id="main">
        <!-- ======= Contact Section ======= -->
        <section id="Login" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Login From</h2>
                    <p>Please enter correctly your information.</p>
                </div>

                <div class="row gx-lg-0 gy-4">

                    <div class="col-lg-4">

                        <div class="info-container d-flex flex-column align-items-center justify-content-center">
                            <div class="info-item d-flex">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h4>Location:</h4>
                                    <p>Marouana, Batna, Algeria</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h4>Email:</h4>
                                    <p>King_tech@Gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <i class="bi bi-phone flex-shrink-0"></i>
                                <div>
                                    <h4>Call:</h4>
                                    <p>+213 673 398 327</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex">
                                <i class="bi bi-clock flex-shrink-0"></i>
                                <div>
                                    <h4>Open Hours:</h4>
                                    <p>Mon-Sun: 09AM - 23PM</p>
                                </div>
                            </div><!-- End Info Item -->
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <form action="<?php echo URLROOT; ?>/actions/__login.php"" method="post"  class="php-email-form">
                            <div class="service-item position-relative mt-3">
                                <h3>User Name</h3>
                            </div>
                            <div class="row form-group">
                                <input type="text" name="id" class="form-control" id="id" placeholder="Your User Name" required>
                            </div>

                            <div class="service-item position-relative mt-3">
                                <h3>Password</h3>
                            </div>
                            <div class="form-group mt-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            </div>
                            <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                            <div class="text-center"><button type="submit" name="submit" value="LOGIN">Log-in</button></div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

   <?php require_once 'includes/footer.php';
