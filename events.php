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
    <link rel="stylesheet" href="css/events.css">

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
                <div class="single-slider  d-flex align-items-center"
                    style="background-image:url(img/bg/images.jpeg); background-size: 100%; background-position: center; height: 300px">
                    <div class="container">
                        <div class="row">
                            <div class="col pt-4">
                                <h2 class="text-center">Camping Collections</h2>
                                <p class="text-center">
                                Choose the perfect camping experience that suits your style!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="card-containerr d-flex flex-row"
            style="
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;"
            >
                <div class="card">
                    <img src="img/bg/bangalow.jpeg" alt="Bangalo">
                    <h2>Bangalow</h2>
                    <p>Experience luxury in a cozy bangalo surrounded by nature.</p>
                   <a class="button" href="./events/filtered.php?type=bangalow">Book Now</a>
                </div>
                <div class="card">
                    <img src="img/bg/tent.jpeg" alt="Tent">
                    <h2>Tent</h2>
                    <p>Enjoy the simplicity of camping with our comfortable tents.</p>
                   <a class="button" href="./events/filtered.php?type=tent">Book Now</a>
                </div>
                <div class="card">
                    <img src="img/bg/caravan.jpeg" alt="Caravan">
                    <h2>Caravan</h2>
                    <p>Travel in style with our fully-equipped caravans.</p>
                    <a class="button" href="./events/filtered.php?type=caravan">Book Now</a>
                </div>
            </div>
        </section>
    </main>
</body>

</html>