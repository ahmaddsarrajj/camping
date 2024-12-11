    <!-- header -->

    <?php
    include "../connection.php";
    if(!empty( $_SESSION["USER"])) {
        $user= $_SESSION["USER"];
    }
   

    ?>
    <header class="header-area header-three d-flex justify-content-center" style="background: black">
        <div id="header-sticky" class="menu-area">
            <div class="container mx-0" style='width:100%;'>
                <div class="second-menu">

                    <div class="d-flex justify-content-around row align-items-center px-4">

                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="index.html"><img src="../img/logo/logo.png" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">

                            <div class="main-menu text-center text-xl-center">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="has-sub">
                                            <a href="../index.php">Home</a>
                                        </li>
                                        <li><a href="#about_us">About Us</a></li>
                                        <li class="has-sub">
                                            <a href="../plan.php">Plans</a>
                                        </li>
                                        <?php 
                                        if($user['ROLENAME']==2) {
                                            echo "  
                                                <li class='has-sub'>
                                                    <a href='../dashboard/index.php?dashboard=true'>Transactions</a>
                                                </li>";
                                        }?>
                                        <?php 
                                        if($user['ROLENAME']==1) {
                                            echo "  
                                                <li class='has-sub'>
                                                    <a href='../dashboard/index.php?dashboard=true'>Transactions</a>
                                                </li>";
                                        }?>
                                        <?php 
                                        if($user['ROLENAME']==1) {
                                            echo "  
                                                <li class='has-sub'>
                                                    <a href='../dashboard/request.php?dashboard=true'>Withdraw</a>
                                                </li>";
                                        }?>
                                        <?php 
                                        if($_GET['dashboard']) {
                                            echo "  
                                                <li class='has-sub'>
                                                    <a href='../logic/auth/signout.php'>Logout</a>
                                                </li>";
                                        }else{
                                            echo "  
                                                <li class='has-sub'>
                                                    <a href='./logic/auth/signout.php'>Logout</a>
                                                </li>";
                                        }?>
                                         
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 text-right d-none d-lg-block mt-30 mb-30">
                            <?php 
                            if(!empty($user)) {
                                    echo " <a href='../logic/auth/signout.php' class='btn ss-btn'>Sign Out
                                    </a> ";
                            }else {
                                echo "<a href='#' class='btn ss-btn' data-toggle='modal' data-target='#exampleModalCenterSignin'>Login
                                    </a> ";
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