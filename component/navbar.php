    <!-- header -->

    <?php
    include "./connection.php";
    if(!empty( $_SESSION["USER"])) {
        $user= $_SESSION["USER"];
    }
   

    ?>
    <header class="header-area header-three d-flex justify-content-center" style="background: black">
        <div id="header-sticky" class="menu-area">
            <div class="container mx-0" style='width:100%;'>
                <div class="second-menu">

                    <div class="d-flex justify-content-around align-items-center">

                        <div class="col-xl-4 col-lg-4">
                            <div class="logo">
                                <h3>CampSphere</h3>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">

                            <div class="main-menu text-center text-xl-center">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="has-sub">
                                            <a href="./index.php">Home</a>
                                        </li>
                                        <li><a href="store.php">Store</a></li>
                                        <li class="has-sub">
                                            <a href="./events.php">Events</a>
                                        </li>
                                        <li class="has-sub">
                                            <a href="./about.php">About</a>
                                        </li>
                                        <li class="has-sub">
                                            <a href="./contacts.php">Contacts</a>
                                        </li>
                                       
                                         
                                        
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 text-right d-none d-lg-block mt-30 mb-30">
                            <?php 
                            if(empty($_SESSION["USER"])) {
                                echo "<a href='#' class='btn ss-btn' data-toggle='modal' data-target='#exampleModalCenterSignin'>Login
                                    </a> ";
                            }else {
                                echo "<a href='./logic/auth/signout.php'>Logout</a>";
                            }
                            ?>
                            </div>
                    </div>

                    <div class="col-12">
                        <div class="mobile-menu"></div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->
   