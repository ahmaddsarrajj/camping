<?php
include '../../connection.php';

if (isset($_GET['id'])) {
  $site_id = $_GET['id'];
  $sql = "SELECT * FROM campsites WHERE site_id = $site_id";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $location = $_POST['location'];
  $availableSpots = $_POST['availableSpots'];
  $type = $_POST['type'];
  $nightCost = $_POST['nightCost'];
  
  $sql = "UPDATE campsites SET 
          name='$name', description='$description', location='$location', availableSpots='$availableSpots', type='$type', nightCost='$nightCost' 
          WHERE site_id=$site_id";
  
  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    header("Location: index.php");
  } else {
    echo "Error updating record: " . $conn->error;
  }
}

?>
<head>
  
<link rel="stylesheet" href="../../css/dashboard.css">
</head>
<form method="POST" action="edit.php?id=<?php echo $site_id; ?>">
  <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
  <textarea name="description"><?php echo $row['description']; ?></textarea>
  <input type="text" name="location" value="<?php echo $row['location']; ?>" required>
  <input type="number" name="availableSpots" value="<?php echo $row['availableSpots']; ?>" required>
  <input type="text" name="type" value="<?php echo $row['type']; ?>" required>
  <input type="number" step="0.01" name="nightCost" value="<?php echo $row['nightCost']; ?>" required>
  <button type="submit" name="update">Update Campsite</button>
</form>