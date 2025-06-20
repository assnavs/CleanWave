<?php
include('../includes/db_connect.php'); // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor_name = $_POST['donor_name'];
    $item_description = $_POST['item_description'];
    $quantity = $_POST['quantity'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO donations (donor_name, item_description, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $donor_name, $item_description, $quantity);

    if ($stmt->execute()) {
        echo "New donation added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
$conn->close(); // Close the database connection

// Redirect back to the manage donations page
header("Location: manage_donations.php");
exit();
?>
