<?php
include "../connection.php";
session_start();

$user_id = $_SESSION['USER']['user_id'] ?? null;

// if (isset($_POST['cart'])) {
//     $cart = json_decode($_POST['cart'], true);
//     echo "<pre>";
//     print_r($cart);
//     echo "</pre>";
// } else {
//     echo "Cart is not set.";
// }

if ($user_id && $_SERVER["REQUEST_METHOD"] === "POST") {
    $cart = $_SESSION['cart'] ?? [];
    $totalCost = array_reduce($cart, function ($sum, $item) {
        return $sum + ($item['price'] * $item['quantity']);
    }, 0);

    $status = "Pending";
    $orderDate = date('Y-m-d');

    // Validate cart and total cost
    if (empty($cart) || $totalCost <= 0) {
        echo "<script>alert('Invalid cart data. Please try again.'); window.location.href = 'cart.php';</script>";
        exit;
    }

    // Insert the order into the orders table
    $orderQuery = "INSERT INTO orders (user_id, orderDate, totalCost, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("isds", $user_id, $orderDate, $totalCost, $status);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id; // Get the newly inserted order ID

        // Loop through the cart items to update stock and insert into the include table
        foreach ($cart as  $product_id => $item) {
            $quantity = $item['quantity'];

            // Check if there's enough stock
            $stockQuery = "SELECT stock FROM products WHERE product_id = ?";
            $stockStmt = $conn->prepare($stockQuery);
            $stockStmt->bind_param("i", $product_id);
            $stockStmt->execute();
            $stockResult = $stockStmt->get_result();

            if ($stockResult->num_rows > 0) {
                $row = $stockResult->fetch_assoc();
                $currentStock = $row['stock'];

                if ($currentStock >= $quantity) {
                    // Deduct the stock
                    $newStock = $currentStock - $quantity;
                    $updateStockQuery = "UPDATE products SET stock = ? WHERE product_id = ?";
                    $updateStockStmt = $conn->prepare($updateStockQuery);
                    $updateStockStmt->bind_param("ii", $newStock, $product_id);
                    $updateStockStmt->execute();

                    // Add to the include table
                    $includeQuery = "INSERT INTO include (order_id, product_id, quantity) VALUES (?, ?, ?)";
                    $includeStmt = $conn->prepare($includeQuery);
                    $includeStmt->bind_param("iii", $order_id, $product_id, $quantity);
                    $includeStmt->execute();
                } else {
                    echo "<script>alert('Not enough stock for product ID: $product_id');</script>";
                }
            }
        }

        // Clear the cart
        unset($_SESSION['cart']);
        echo "<script>alert('Order placed successfully!'); window.location.href = '../store.php';</script>";
    } else {
        echo "<script>alert('Error placing order: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
