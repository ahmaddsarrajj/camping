<?php
include '../../connection.php';  // Include the database connection

// Check if the order_id is provided in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Update the order's status to "delivered"
    $sql = "UPDATE orders SET status = 'delivered' WHERE order_id = ?";
    
    // Prepare the statement and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);  // "i" means the parameter is an integer
    
    // Execute the query
    if ($stmt->execute()) {
        // If the query is successful, redirect back to the orders dashboard
        header("Location: index.php");
        exit();
    } else {
        // If there was an error, display an error message
        echo "Error updating order status.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
