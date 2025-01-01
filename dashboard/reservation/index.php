<?php
include '../../connection.php';  // Include the database connection

// Fetch all reservations from the database
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);  // Execute the query

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservations Management Dashboard</title>
  <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>

  <?php include "../../component/sidebar.php"; ?>  <!-- Sidebar (if exists) -->

  <div class="container" style="padding-left: 320px; padding-right: 30px">
    <h1>Reservations Management Dashboard</h1>
    
    <!-- Table to display all reservations -->
    <h2>All Reservations</h2>
    <table>
      <thead>
        <tr>
          <th>Reservation ID</th>
          <th>User ID</th>
          <th>Site ID</th>
          <th>Reservation Date</th>
          <th>No. of Spots</th>
          <th>Total Cost</th>
          <th>Type</th>
          <th>Start Date</th>
          <th>End Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          // Loop through each reservation and display in a table row
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["reservation_id"] . "</td>
                    <td>" . $row["user_id"] . "</td>
                    <td>" . $row["site_id"] . "</td>
                    <td>" . $row["reservationDate"] . "</td>
                    <td>" . $row["noOfSpots"] . "</td>
                    <td>$" . number_format($row["totalCost"], 2) . "</td>
                    <td>" . $row["type"] . "</td>
                    <td>" . $row["startDate"] . "</td>
                    <td>" . $row["endDate"] . "</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='9'>No reservations found.</td></tr>";
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
