<?php
include('../includes/db_connect.php');
session_start();

/*// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit();
}*/

// Get form data
$item_name = $_POST['item_name'];
$price = $_POST['price'];
$service_type = $_POST['service_type'];
$category = $_POST['category'];

// Insert into database
$sql = "INSERT INTO items (item_name, price, service_type, category) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$item_name, $price, $service_type, $category])) {
    header('Location: manage_items.php?status=success');
} else {
    header('Location: add_item.php?status=error');
}
?>