<?php
// Database connection
include('../../connection.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
  // Get form data
  $name = $_POST['name'];
  $description = $_POST['description'];
  $location = $_POST['location'];
  $availableSpots = $_POST['availableSpots'];
  $type = $_POST['type'];
  $nightCost = $_POST['nightCost'];

  // Handle image upload (optional - ensure directory exists)
  $image = $_FILES['image']['name'];
  $target_dir = "../../images/uploads/";
  $target_file = $target_dir . basename($image);
  move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

  // Insert the new campsite into the 'campsites' table
  $sql = "INSERT INTO campsites (name, description, location, availableSpots, image, type, nightCost) 
          VALUES ('$name', '$description', '$location', '$availableSpots', '$target_file', '$type', '$nightCost')";
  
  if (mysqli_query($conn, $sql)) {
    // Get the ID of the newly inserted campsite (site_id)
    $site_id = mysqli_insert_id($conn);
    
    // Insert a new record in the 'availability' table
    $availability_sql = "INSERT INTO availability (site_id, is_Availability) 
                         VALUES ('$site_id', TRUE)";
    
    if (mysqli_query($conn, $availability_sql)) {
      echo "Campsite and availability record added successfully.";
      header('location: ./index.php');
    } else {
      echo "Error adding availability record: " . mysqli_error($conn);
    }
  } else {
    echo "Error adding campsite: " . mysqli_error($conn);
  }
}
?>
