<?php

include "../../connection.php";
session_start();

$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];
$phone = $_POST["phone"]; // Capture the phone number
$role_name = 2;

// Check if the username already exists
$sql_check_username = "SELECT * FROM `user` WHERE username = '$username'";
$result_check = mysqli_query($conn, $sql_check_username);

if (mysqli_num_rows($result_check) > 0) {
    // Username already exists
    echo "<script>alert('Username already exists. Please choose a different username.'); window.location.href='../../register.php';</script>";
    exit();
}

if ($cpassword === $password) {
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user if the username is unique
    $insert_user_query = "INSERT INTO `user`(`username`, `password`, `role_id`, `phone`) 
                          VALUES ('$username', '$hashed_password', '$role_name', '$phone')";
    $insert_user = mysqli_query($conn, $insert_user_query);

    if ($insert_user) {
        // Fetch the user details after inserting
        $sql = "SELECT * FROM `user` WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["USER"] = $row;
        }

        header("Location: ../../index.php");
        exit();
    } else {
        echo "<script>alert('Error inserting user. Please try again later.'); window.location.href='../../signup.php';</script>";
    }
} else {
    echo "<script>alert('Passwords do not match! Please check and try again.'); window.location.href='../../signup.php';</script>";
}

?>
