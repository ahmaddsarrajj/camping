<head>
    <style>
        .header-area {
            position: block;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 10px 0;
            background-color: #ff8a00; /* Header background */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        }

        .header-area .menu-area {
            display: flex;
            align-items: center;
        }

        .header-area .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

    </style>
</head>

<header class="header-area header-three d-flex justify-content-center" style="background: black">
        <div id="header-sticky" class="menu-area">
            <div class="container mx-0" style='width:100%;'>
                <div class="second-menu">

                    <div class="d-flex justify-content-end align-items-center">

                        <div class="col-xl-2 col-lg-2 text-right d-none d-lg-block mt-30 mb-30">
                                                    <?php 
                                                    if(empty($_SESSION["USER"])) {
                                                        echo "<a href='../index.php' class='btn ss-btn' style='color: white'>Login
                                                            </a> ";
                                                    }else {
                                                        echo "<a href='../logic/auth/signout.php' class='btn btn-danger' style='color: white'>Logout</a>";
                                                    }
                                                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                                </header>

