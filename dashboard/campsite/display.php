<?php
include '../../connection.php';

$sql = "SELECT * FROM campsites";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["name"] . "</td>
            <td>" . $row["description"] . "</td>
            <td>" . $row["location"] . "</td>
            <td>" . $row["availableSpots"] . "</td>
            <td><img src='../../images/uploads/" . $row["image"] . "' width='100'></td>
            <td>" . $row["type"] . "</td>
            <td>$" . $row["nightCost"] . "</td>
            <td>
              <a href='edit.php?id=" . $row["site_id"] . "'>Edit</a>
              <a href='delete.php?id=" . $row["site_id"] . "'>Delete</a>
            </td>
          </tr>";
  }
} else {
  echo "<tr><td colspan='8'>No records found</td></tr>";
}

$conn->close();
?>
