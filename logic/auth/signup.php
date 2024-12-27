<?php

    include "../../connection.php";
    session_start();

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $role_name = 2;

    if($cpassword == $password) {
        $insert_user_query = "INSERT INTO `user`(`username`, `password`, `role_id`)
        VALUES ('$username', '$password', '$role_name')"; 
        $insert_user = mysqli_query($conn, $insert_user_query);
        
        $sql = "SELECT * FROM `user` WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            // User found, verify password
            $row = mysqli_fetch_assoc($result);
            $_SESSION["USER"] = $row;
        }
    
        header("Location: ../../index.php");
        exit();
    }else{
        echo "<script>alert('Check your password very well!!)</script>";
    }

?>