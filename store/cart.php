<?php
session_start();
include "../connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $product_id => $quantity) {
        if ($quantity > 0) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        } else {
            unset($_SESSION['cart'][$product_id]); // Remove item if quantity is 0
        }
    }
    echo "<script>alert('Cart updated');</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $user_id = $_SESSION['USER']['user_id'] ?? null;

    if (!$user_id) {
        echo "<script>alert('You need to log in to place an order');</script>";
        exit;
    }

    $totalCost = array_reduce($_SESSION['cart'], function ($sum, $item) {
        return $sum + ($item['price'] * $item['quantity']);
    }, 0);

    $status = 'Pending';
    $date = date('Y-m-d H:i:s');

    $orderQuery = "INSERT INTO orders (user_id, orderDate, totalCost, status, date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("isdss", $user_id, $date, $totalCost, $status, $date);

    if ($stmt->execute()) {
        unset($_SESSION['cart']); // Clear the cart after checkout
        echo "<script>alert('Order placed successfully');</script>";
    } else {
        echo "<script>alert('Error placing order');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>

<?php include "../component/backArrow.php"; ?>

    <h1>Your Cart</h1>
    <form method="post" action="./place_order.php">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $product_id => $item) {
                        $itemTotal = $item['price'] * $item['quantity'];
                        $total += $itemTotal;
                        echo "
                        <tr>
                            <td>{$item['name']}</td>
                            <td>\${$item['price']}</td>
                            <td>
                                <input type='number' name='quantities[$product_id]' value='{$item['quantity']}' min='1'>
                            </td>
                            <td>\${$itemTotal}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Your cart is empty.</td></tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total:</strong></td>
                    <td><strong>$<?php echo $total; ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <div style="width: 100%; padding-left: 75px">
            <!-- Hidden field to send the cart data -->
                <input type="hidden" name="cart" value='<?php echo json_encode($_SESSION['cart']); ?>'>
                <!-- Hidden field to send the total cost -->
                <input type="hidden" name="totalCost" value="<?php echo $total; ?>">
            <button type="submit" name="update_cart">Update Cart</button>
            <button type="submit" name="checkout">Checkout</button>
        </div>
    </form>
</body>
</html>
