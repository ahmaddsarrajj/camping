<?php
include "./connection.php"; // Include database connection

// Fetch categories from the database
$query = "SELECT * FROM categories";
$result = $conn->query($query);

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
    <link rel="stylesheet" href="./css/store.css">
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
                            <div class="col">
                                <h2 class="text-white text-center">Camping Collections</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cont">     
            <div class="container">
                <h1 class='pb-4'>Explore Categories</h1>
                <div class="categories">
                    <?php
                    if($result){
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <div class='category-card'>
                                <h2>{$row['name']}</h2>
                                <a href='./store/products.php?category_id={$row['category_id']}'>View Products</a>
                            </div>";
                        }
                    } else {
                        echo "<p>No categories found.</p>";
                    }}
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>