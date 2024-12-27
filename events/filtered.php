<?php
include "../connection.php";
$type = $_GET['type'] ?? '';
$search = $_GET['search'] ?? '';

// Ensure inputs are safe for SQL query
$type = mysqli_real_escape_string($conn, $type);
$search = mysqli_real_escape_string($conn, $search);

// Fetch campsites filtered by type and search keyword
$query = "SELECT name, description, location, availableSpots, image 
          FROM campsites 
          WHERE type = '$type' AND (name LIKE '%$search%' OR description LIKE '%$search%')";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($type); ?> Campsites</title>
    <link rel="stylesheet" href="../css/events.css">
</head>
<body>
    <main class="filtered-page">
        <h1><?php echo ucfirst($type); ?> Campsites</h1>
         <!-- Search Form -->
         <form action="" method="get" class="search-form">
            <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
            <input type="text" name="search" placeholder="Search campsites..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        <div class="campsites-container">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <div class='campsite-card'>
                        <img src='../img/campsites/{$row['image']}' alt='{$row['name']}'>
                        <h2>{$row['name']}</h2>
                        <p>{$row['description']}</p>
                        <p><strong>Location:</strong> {$row['location']}</p>
                        <p><strong>Available Spots:</strong> {$row['availableSpots']}</p>
                    </div>";
                }
            } else {
                echo "<p>No campsites available for this type.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
