<?php
include '../../connection.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Fetch product data from the database
    $sql = "SELECT * FROM product WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':product_id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['productName'];
    $productDesc = $_POST['productDesc'];
    $productPrice = $_POST['productPrice'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];

    // Handle file upload (image)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = 'uploads/' . basename($imageName);
        move_uploaded_file($imageTmpName, $imagePath);
    } else {
        $imagePath = $product['image']; // Keep the existing image if no new image is uploaded
    }

    // SQL query to update the product
    $sql = "UPDATE product SET productName = :productName, productDesc = :productDesc, 
            productPrice = :productPrice, stock = :stock, image = :image, category_id = :category_id 
            WHERE product_id = :product_id";
    
    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':productName' => $productName,
        ':productDesc' => $productDesc,
        ':productPrice' => $productPrice,
        ':stock' => $stock,
        ':image' => $imagePath,
        ':category_id' => $category_id,
        ':product_id' => $product_id
    ]);

    // Redirect to the product dashboard after updating
    header('Location: product_dashboard.php');
    exit;
}
?>

<!-- Form to edit product -->
<form action="edit_product.php?product_id=<?php echo $product['product_id']; ?>" method="POST" enctype="multipart/form-data">
    <input type="text" name="productName" value="<?php echo htmlspecialchars($product['productName']); ?>" required>
    <textarea name="productDesc"><?php echo htmlspecialchars($product['productDesc']); ?></textarea>
    <input type="number" name="productPrice" value="<?php echo htmlspecialchars($product['productPrice']); ?>" step="0.01" required>
    <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
    <input type="file" name="image" accept="image/*">
    <input type="number" name="category_id" value="<?php echo $product['category_id']; ?>" required>
    <button type="submit">Update Product</button>
</form>