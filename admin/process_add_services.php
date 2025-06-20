<?php
include('../includes/db_connect.php'); // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO services (service_name, price, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $service_name, $price, $description);

    if ($stmt->execute()) {
        echo "New service added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();

// Redirect back to the service list or admin dashboard
header("Location: manage_services.php"); // Adjust as necessary
exit();
?>
