<?php
include('../includes/db_connect.php');

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Delete the service from the database
    $delete_query = "DELETE FROM services WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();

    // Redirect to the manage services page after deletion
    header("Location: manage_services.php");
    exit();
} else {
    die("Service ID is missing.");
}
?>
