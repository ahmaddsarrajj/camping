<?php
include '../../connection.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Delete the product from the database
    $sql = "DELETE FROM product WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':product_id' => $product_id]);

    // Redirect to the dashboard after deletion
    header('Location: product_dashboard.php');
    exit;
}
?>
