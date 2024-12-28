<?php
include "../connection.php";
session_start();

$user_id = $_SESSION['USER']['user_id'] ?? null;

if($user_id != null) {
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle new reservation
    $noOfSpots = $_POST['noOfSpots'];
    $type = $_POST['type'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $site_id = $_GET['site_id'];
    $reservationDate = date('Y-m-d');

    // Fetch the price per spot from the campsites table
    $query = "SELECT nightCost FROM campsites WHERE site_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $site_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pricePerSpot = $row['nightCost'];
        $totalCost = $noOfSpots * $pricePerSpot;

        // Prepare the SQL query
        $insertQuery = "INSERT INTO reservations (user_id, site_id, reservationDate, noOfSpots, totalCost, type, startDate, endDate) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Initialize prepared statement
        $insertStmt = $conn->prepare($insertQuery);

        // Bind parameters
        $insertStmt->bind_param("iisidsss", $user_id, $site_id, $reservationDate, $noOfSpots, $totalCost, $type, $startDate, $endDate);

        // Execute the query
        if ($insertStmt->execute()) {
              // Reservation inserted successfully, now update the campsite availability
                // Update the availability status to "not available" in the availability table
                $updateQuery = "UPDATE availability SET is_Availability = 0, updated_at = NOW() WHERE site_id =".$site_id;             $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->execute();
              
            
              echo "<script>Reservation added successfully!</script>";
        } else {
        echo "Error: " . $insertStmt->error;
        }

        // Close the statement and connection
        $insertStmt->close();
        $updateStmt->close();
        $conn->close();
    } else {
        echo "<script>alert('Invalid site ID.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="../css/reservation.css">
</head>
<body>
    <main class="reservation-page">
        <h1>Make a Reservation</h1>

        <!-- New Reservation Form -->
        <form action="" method="post" class="reservation-form">
            <label for="noOfSpots">Number of Spots:</label>
            <input type="number" name="noOfSpots" id="noOfSpots" required>

            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="bangalow">Bangalow</option>
                <option value="tent">Tent</option>
                <option value="caravan">Caravan</option>
            </select>

            <label for="startDate">Start Date:</label>
            <input type="date" name="startDate" id="startDate" required>

            <label for="endDate">End Date:</label>
            <input type="date" name="endDate" id="endDate" required>

            <button type="submit">Reserve</button>
        </form>

        <h2>Your Reservations</h2>
        <div class="reservations-container">
    <?php
    // Display user reservations
    $query = "SELECT reservations.*, campsites.name AS campsite_name 
              FROM reservations 
              JOIN campsites ON reservations.site_id = campsites.site_id
              WHERE reservations.user_id = ?";  // Corrected the query to use a parameter placeholder
    
    if($query){
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id); // Safely bind the user_id as an integer
        $stmt->execute();
        $result = $stmt->get_result();
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='reservation-card'>
                <h3>{$row['campsite_name']}</h3>
                <p><strong>Type:</strong> {$row['type']}</p>
                <p><strong>Number of Spots:</strong> {$row['noOfSpots']}</p>
                <p><strong>Total Cost:</strong> \${$row['totalCost']}</p>
                <p><strong>Start Date:</strong> {$row['startDate']}</p>
                <p><strong>End Date:</strong> {$row['endDate']}</p>
            </div>";
        }
    } else {
        echo "<p>No reservations found.</p>";
    }
    ?>
</div>

    </main>
</body>
</html>

<?php   } else {
    
    echo "
    <script>
        alert('You should be logged in to continue this process');
        window.location.href = '../index.php';
    </script>";
    
}?>