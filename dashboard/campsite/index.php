<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Campsite Management Dashboard</title>
  <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>

  <?php include "../../component/sidebar.php"; ?>
  <div class="container" style="padding-left: 320px; padding-right: 30px">
    <h1>Campsite Management Dashboard</h1>
    
    <!-- Form to add new campsite -->
    <form action="process.php" class="p-4" method="POST" enctype="multipart/form-data">
      <h2>Add New Campsite</h2>
      <input type="text" name="name" placeholder="Campsite Name" required>
      <textarea name="description" placeholder="Description"></textarea>
      <input type="text" name="location" placeholder="Location" required>
      <input type="number" name="availableSpots" placeholder="Available Spots" required>
      <input type="file" name="image" accept="image/*" required>
      <input type="text" name="type" placeholder="Type (e.g. Tent, Cabin)" required>
      <input type="number" step="0.01" name="nightCost" placeholder="Night Cost" required>
      <button type="submit" name="submit">Add Campsite</button>
    </form>
    
    <!-- Table to display campsites -->
    <h2>All Campsites</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Location</th>
          <th>Available Spots</th>
          <th>Image</th>
          <th>Type</th>
          <th>Night Cost</th>
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
