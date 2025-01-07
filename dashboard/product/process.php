<?php
include '../../connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get form data
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $productDesc = mysqli_real_escape_string($conn, $_POST['productDesc']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    
    // Handle file upload (image)
    $imagePath = ''; // Default value for the image path
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (in_array($imageExtension, $allowedExtensions)) {
            $imagePath = '../../images/uploads/' . uniqid() . '.' . $imageExtension; // Unique filename
            if (!move_uploaded_file($imageTmpName, $imagePath)) {
                echo "Error uploading file!";
                exit;
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            exit;
        }
    }

  // SQL query using prepared statements for security
  $query = "INSERT INTO `products`(`productName`, `productPrice`, `productDesc`, `stock`, `image`, `category_id`) 
  VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("sdsiss", $productName, $productPrice, $productDesc, $stock, $imagePath, $category_id);

if ($stmt->execute()) {
echo "Product added successfully!";
// Redirect to the dashboard page after insertion
header('Location: ./index.php');
exit;
} else {
echo "Database error: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
}
?>