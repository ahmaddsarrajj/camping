<?php
include '../../connection.php';

if (isset($_GET['id'])) {
  $site_id = $_GET['id'];
  
  // First, retrieve the image path to delete it from the server
  $sql = "SELECT image FROM campsites WHERE site_id = $site_id";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $imagePath = "uploads/" . $row['image'];
  
  // Delete the campsite record
  $sql = "DELETE FROM campsites WHERE site_id = $site_id";
  
  if ($conn->query($sql) === TRUE) {
    // Delete the image file from the server
    if (file_exists($imagePath)) {
      unlink($imagePath);
    }
    echo "Record deleted successfully";
    header("Location: index.php");
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

$conn->close();
?>