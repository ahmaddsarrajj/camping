<html>
<?php
include "./connection.php";

?>

<head>
    
<title>Signup</title>
    <!-- CSS here -->
    <link rel="stylesheet" href="css/signup.css">
</head>

<body 
class="d-flex align-items-center"
style="height: 100vh;background-image: url('./img/bg/bigback.jpeg')">
    
    <main class="d-flex justify-content-center col-md-12 flex-column p-4">
        <div class=" p-4" >
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="section-title center-align mb-30">
                    <h3 style="color: #fff; text-align:center">
                        Hello, please register here to start your investment journey
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <form method="post" action="./Logic/auth/signup.php">
                    <div class="form-group">
                       <input type="text" class="form-control" id="exampleInputEmail1" name="username" required
                          placeholder="Enter the username" style="width: 100%">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required
                            placeholder="Enter your password" style="width: 100%">
                    </div>
                    <div class="form-group">

                        <input type="password" class="form-control" id="exampleInputPassword2" name="cpassword" required
                            placeholder="Confirm your password" style="width: 100%">
                    </div>
                    
                    <div class="modal-footer d-flex flex-column">
                        <button type="submit" class="btn btn-orange" style="background-color:orange; border: radius 40px;">Signup</button>
                        <div>
                            <p>Do you have an account?
                                <a href="./index.php">Login</a>
                            </p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</div>
</main>
</body>
</html>