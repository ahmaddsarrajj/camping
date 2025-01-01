<?php
include '../../connection.php';
// Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Get form data
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
        $imagePath = ''; // Default to no image if upload fails
    }

    // SQL query to insert a new product
    $sql = "INSERT INTO product (productName, productDesc, productPrice, stock, image, category_id) 
            VALUES (:productName, :productDesc, :productPrice, :stock, :image, :category_id)";
    
    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':productName' => $productName,
        ':productDesc' => $productDesc,
        ':productPrice' => $productPrice,
        ':stock' => $stock,
        ':image' => $imagePath,
        ':category_id' => $category_id
    ]);
    
    // Redirect to the dashboard page after insertion
    header('Location: product_dashboard.php');
    exit;
}
?>
