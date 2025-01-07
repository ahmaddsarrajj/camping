<?php
include "../connection.php";

$type = $_GET['type'] ?? '';
$search = $_GET['search'] ?? '';

// Ensure inputs are safe for SQL query
$type = mysqli_real_escape_string($conn, $type);
$search = mysqli_real_escape_string($conn, $search);

// Fetch campsites filtered by type and search keyword, joined with availability table
$query = "SELECT campsites.site_id, campsites.nightCost, campsites.name, campsites.description, campsites.location, campsites.availableSpots, campsites.image, availability.is_Availability 
          FROM campsites 
          LEFT JOIN availability ON campsites.site_id = availability.site_id
          WHERE campsites.type = '$type' AND (campsites.name LIKE '%$search%' OR campsites.description LIKE '%$search%')";

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

<?php include "../component/backArrow.php"; ?>
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
                        <p><strong>Night Cost:</strong> {$row['nightCost']}</p>
                        ";

                    
                    // Check availability and display appropriate button/label
                    if ($row['is_Availability'] == 1) {
                        echo "<a class='button' href='./reserve.php?site_id={$row['site_id']}'>Reserve</a>";
                    } else {
                        echo "<span class=''>Reserved</span>";
                    }

                    echo "</div>";
                }
            } else {
                echo "<p>No campsites available for this type.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
