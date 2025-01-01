<?php
include '../../connection.php';  // Include the database connection

// Fetch all products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);  // Execute the query

// Check if any rows were returned
if ($result->num_rows > 0) {
  // Loop through each product and display in a table row
  while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . htmlspecialchars($row["productName"]) . "</td>
            <td>" . htmlspecialchars($row["productDesc"]) . "</td>
            <td>" . number_format($row["productPrice"], 2) . "</td>
            <td>" . $row["stock"] . "</td>
            <td><img src='../../images/uploads/" . htmlspecialchars($row["image"]) . "' width='100'></td>
            <td>" . $row["category_id"] . "</td>
            <td>
              <a href='edit.php?product_id=" . $row["product_id"] . "'>Edit</a> |
              <a href='delete.php?product_id=" . $row["product_id"] . "' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>
            </td>
          </tr>";
  }
} else {
  echo "<tr><td colspan='7'>No products found.</td></tr>";
}

// Close the connection
$conn->close();
?>
