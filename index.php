<?php
if(!empty( $_SESSION["USER"])) {
        $user= $_SESSION["USER"];
    }

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CampSphere</title>
    <style>
    .btn-orange {
        background: #DC4900
    }
    .primary-color {
        color: #191216
    }
    </style>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="font-flaticon/flaticon.css">
    <link rel="stylesheet" href="css/dripicons.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/meanmenu.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/slider.css">
</head>

<body>

    <!-- modal -->
    <?php include "./component/modalSignin.php"; ?>
    <!-- navigation -->
    <?php include "./component/navbar.php"; ?>
    <!-- main-area -->
    <main>

        <!-- slider-area -->
        <section id="home" class="slider-area fix p-relative">

            <div class="slider-active">
                <div class="single-slider slider-bg d-flex align-items-center"
                    style="background-image:url(img/bg/images.png); size: 100%;">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="slider-content s-slider-content text2">
                                    <?php if (!empty($user)) {
                                        echo "
                                            <h3>Welcome " . $user['username'] . "</h3>
                                        ";
                                    } ?>
                                    <h2 data-animation="fadeInUp" data-delay=".4s">Adventure Awaits
                                        <?php echo"<span><br>Gear Up, Get Out!</span>";?>
                                    </h2>
                                    <p data-animation="fadeInUp" data-delay=".6s">Your go-to store for all camping and outdoor gear! From tents to sleeping bags, we’ve got everything you need to make your adventures unforgettable. Gear up and explore with confidence!</p>
                                    <div class="slider-btn mt-40">
                                        <?php
                                        if (empty($user)) {
                                            echo "<a href='#' class='btn btn-orange ss-btn' data-toggle='modal'
                                            data-target='#exampleModalCenterSignin'>Login</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </section>
       
       



    </main>
    <!-- main-area-end -->
    


    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/vendor/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/paroller.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/js_isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.meanmenu.min.js"></script>
    <script src="js/parallax-scroll.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/element-in-view.js"></script>
    <script src="js/main.js"></script>


</body>

</html>