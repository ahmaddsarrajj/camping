<?php
include '../../connection.php';

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Ensure product_id is an integer

    // Fetch product data from the database
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Product not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $productDesc = mysqli_real_escape_string($conn, $_POST['productDesc']);
    $productPrice = floatval($_POST['productPrice']);
    $stock = intval($_POST['stock']);
    $category_id = intval($_POST['category_id']);

    // Handle file upload (image)
    $imagePath = $product['image']; // Default to the existing image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (in_array($imageExtension, $allowedExtensions)) {
            $imagePath = '../../images/uploads/' . uniqid() . '.' . $imageExtension;
            move_uploaded_file($imageTmpName, $imagePath);
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            exit;
        }
    }

    // SQL query to update the product
    $sql = "UPDATE products SET productName = ?, productDesc = ?, productPrice = ?, stock = ?, image = ?, category_id = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdissi", $productName, $productDesc, $productPrice, $stock, $imagePath, $category_id, $product_id);

    if ($stmt->execute()) {
        // Redirect to the product dashboard after updating
        header('Location: ./index.php');
        exit;
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<!-- Form to edit product -->
<form action="?product_id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
    <input type="text" name="productName" value="<?php echo htmlspecialchars($product['productName']); ?>" required>
    <textarea name="productDesc" required><?php echo htmlspecialchars($product['productDesc']); ?></textarea>
    <input type="number" name="productPrice" value="<?php echo htmlspecialchars($product['productPrice']); ?>" step="0.01" required>
    <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
    <input type="file" name="image" accept="image/*">
    <input type="number" name="category_id" value="<?php echo $product['category_id']; ?>" required>
    <button type="submit">Update Product</button>
</form>


<head>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Form Container */
form {
    background-color: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
}

/* Form Heading */
form h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #444;
    text-align: center;
}

/* Input Fields */
form input[type="text"],
form input[type="number"],
form textarea,
form input[type="file"],
form button {
    width: 100%;
    padding: 10px 15px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Textarea */
form textarea {
    resize: vertical;
    min-height: 100px;
}

/* Buttons */
form button {
    background-color: orangered;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: orangered;
}

/* Input Focus */
form input:focus,
form textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Responsive Design */
@media (max-width: 600px) {
    form {
        padding: 15px 20px;
    }

    form h2 {
        font-size: 20px;
    }
}

    </style>
</head>