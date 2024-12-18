<?php

// Include the database connection file
include "../../connection.php";
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID and password from POST data
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Validate user ID and password (you can add more validation logic here)
    if (empty($username) || empty($password)) {
        // Handle empty fields
        
        $error = "Please enter both user ID and password.";
    } else {
        // Perform database query to check if user credentials are valid
        // Assuming you have a database connection, replace 'your_database' with your actual database name
        // $conn = mysqli_connect("localhost", "username", "password", "your_database");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare SQL statement to fetch user data based on user ID
        $sql = "SELECT * FROM user
        
        WHERE user.username = '$username'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // User found, verify password
            $row = mysqli_fetch_assoc($result);

            $_SESSION["USER"] = $row;

            if ($password == $row["password"]) {
                
                if( $row['role_id'] == 2 ) {   
                    header("Location: ../../index.php");
                    exit();

                } else if( $row['role_id'] == 1 ) {
                    header("Location: ../../index.php");
                    exit();
                    
                } else {
                    header("Location: ../../404.php");
                    exit();
                }
            }else {
                header("Location: ../../401.php");
                    exit();
            }
        }else{
            header("Location: ../../401.php");
                    exit();
        }

        mysqli_close($conn);
    }
}


?>