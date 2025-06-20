<?php
include('../includes/db_connect.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $service = $_POST['service'];
    $order_date = $_POST['order_date'];
    $status = $_POST['status'];

    // Insert order details into orders table
    $stmt = $pdo->prepare("INSERT INTO orders (customer_name, service, order_date, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$customer_name, $service, $order_date, $status]);
    $order_id = $pdo->lastInsertId(); // Get the last inserted order ID

    // Insert selected items into order_items table
    foreach ($_POST['items'] as $item_name => $price) {
        $quantity = 1; // You can modify this to get quantities if needed
        $total = $price * $quantity;

        $item_stmt = $pdo->prepare("INSERT INTO order_items (order_id, item_name, quantity, price, total) VALUES (?, ?, ?, ?, ?)");
        $item_stmt->execute([$order_id, $item_name, $quantity, $price, $total]);
    }

    echo "New order added successfully";
    // Redirect or render a message
    header("Location: manage_orders.php");
    exit();
}
?>
