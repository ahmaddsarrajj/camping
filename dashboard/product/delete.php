<?php
include '../../connection.php';

if (isset($_GET['product_id'])) {
    // Sanitize and validate the product_id
    $product_id = intval($_GET['product_id']);

    // Use a prepared statement to prevent SQL injection
    $sql = "DELETE FROM `products` WHERE `product_id` = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            // Redirect to the dashboard after successful deletion
            header('Location: ./index.php');
            exit();
        } else {
            echo "Error: Unable to delete the product.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Failed to prepare the statement.";
    }
} else {
    echo "Error: Product ID not provided.";
}

// Close the connection
$conn->close();
?>
