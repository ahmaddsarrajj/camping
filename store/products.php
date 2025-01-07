<?php
include "../connection.php"; // Include database connection
session_start();

// Get the selected category ID
$category_id = $_GET['category_id'] ?? null;

if (!$category_id) {
    echo "<script>alert('Invalid category ID'); window.location.href = 'categories.php';</script>";
    exit;
}

// Fetch products for the selected category
$query = "SELECT * FROM products WHERE category_id =".$category_id;
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Fetch category name for display
$categoryQuery = "SELECT name FROM categories WHERE category_id = ". $category_id;
$categoryStmt = $conn->prepare($categoryQuery);
$categoryStmt->execute();
$categoryResult = $categoryStmt->get_result();
$categoryName = $categoryResult->fetch_assoc()['name'] ?? "Unknown";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products in <?php echo htmlspecialchars($categoryName); ?></title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>

    
    <?php include "../component/specificNav.php"; ?>

    <section class="cont">
        <div class="container">
            <h1 class="pb-4">Products in "<?php echo htmlspecialchars($categoryName); ?>"</h1>
            <div class="products">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='product-card'>
                            <img stlye='width: 100px; height: 100px' src='../img/products/{$row['image']}' alt='{$row['productName']}'>
                            <h2>{$row['productName']}</h2>
                            <p><strong>Price:</strong> \${$row['productPrice']}</p>
                            <p>{$row['productDesc']}</p>
                            <p><strong>Stock:</strong> {$row['stock']}</p>
                            
                            <form method='post' action=''>
                                <input type='hidden' name='product_id' value='{$row['product_id']}'>
                                <input type='hidden' name='product_name' value='{$row['productName']}'>
                                <input type='hidden' name='product_price' value='{$row['productPrice']}'>
                                <input type='number' name='quantity' value='1' min='1' max='{$row['stock']}'>
                                <button type='submit' name='add_to_cart'>Add to Cart</button>
               
                            </form>
                        </div>";
                    }
                } else {
                    echo "<p>No products found in this category.</p>";
                }
                ?>
            </div>
        </div>
    </section>
</body>
</html>


<?php
// Handle "Add to Cart" action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    // Initialize cart in session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Add or update the product in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity,
        ];
    }
    echo "<script>alert('Product added to cart');</script>";
}
?>