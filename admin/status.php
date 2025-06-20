<?php
include('../includes/header.php');
include('../includes/db_connect.php'); // Include your DB connection

// Check if the form has been submitted to update order status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = intval($_POST['order_id']);
    $action = $_POST['action'];

    // Sanitize the input to prevent SQL injection
    $order_id = $conn->real_escape_string($order_id);
    $action = $conn->real_escape_string($action);

    // Update the order status in the database
    if ($action === 'accepted' || $action === 'declined') {
        $sql = "UPDATE orders SET status = '$action' WHERE id = '$order_id'";
        if ($conn->query($sql) === TRUE) {
            // Optionally, you can set a success message in a session variable or redirect
            header("Location: manage_orders.php"); // Redirect to the same page to avoid resubmission
            exit();
        } else {
            echo "Error updating order status: " . $conn->error;
        }
    }
}

// Initialize query for fetching orders
$sql = "SELECT * FROM orders";

// Check if a filter is applied based on Order ID
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $order_id = $_POST['id'];
    // Sanitize the input to prevent SQL injection
    $order_id = $conn->real_escape_string($order_id);
    
    // Modify the query to filter by Order ID
    $sql .= " WHERE id = '$order_id'";
}

// Execute the query
$result = $conn->query($sql);
?>