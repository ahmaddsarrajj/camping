<?php
include '../../connection.php';  // Include the database connection

// Fetch all orders from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);  // Execute the query

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders Management Dashboard</title>
  <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>

  <?php include "../../component/sidebar.php"; ?>  <!-- Sidebar (if exists) -->

  <div class="container" style="padding-left: 320px; padding-right: 30px">
    <h1>Orders Management Dashboard</h1>
    
    <!-- Table to display all orders -->
    <h2>All Orders</h2>
    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>User ID</th>
          <th>Order Date</th>
          <th>Total Cost</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          // Loop through each order and display in a table row
          while ($row = $result->fetch_assoc()) {
            // Check if the order's status is "pending" to show the button
            $status = $row["status"];
            echo "<tr>
                    <td>" . $row["order_id"] . "</td>
                    <td>" . $row["user_id"] . "</td>
                    <td>" . $row["orderDate"] . "</td>
                    <td>$" . number_format($row["totalCost"], 2) . "</td>
                    <td>" . $status . "</td>
                    <td>";
            if ($status == "Pending") {
              // Only show the button if the order status is "pending"
              echo "<a href='update_status.php?order_id=" . $row["order_id"] . "' class='btn btn-primary'>Mark as Delivered</a>";
            }
            echo "</td></tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No orders found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>
</html>

<?php
$conn->close();  // Close the connection to the database
?>
