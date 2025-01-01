<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Management Dashboard</title>
  <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>

  <?php include "../../component/sidebar.php"; ?>
  
  <div class="container" style="padding-left: 320px; padding-right: 30px">
    <h1>Product Management Dashboard</h1>
    
    <!-- Form to add new product -->
    <form action="process.php" class="p-4" method="POST" enctype="multipart/form-data">
      <h2>Add New Product</h2>
      <input type="text" name="productName" placeholder="Product Name" required>
      <textarea name="productDesc" placeholder="Description"></textarea>
      <input type="number" name="productPrice" step="0.01" placeholder="Price" required>
      <input type="number" name="stock" placeholder="Stock" required>
      <input type="file" name="image" accept="image/*" required>
      <input type="number" name="category_id" placeholder="Category ID" required>
      <button type="submit" name="submit">Add Product</button>
    </form>
    
    <!-- Table to display products -->
    <h2>All Products</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Image</th>
          <th>Category ID</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php include 'display.php'; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
