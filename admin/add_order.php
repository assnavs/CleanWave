<?php
include('../includes/header.php');
?>

<h2>Add New Order</h2>

<!-- Add Order Form -->
<form method="POST" action="process_add_order.php">
    <label for="customer_name">Customer Name:</label>
    <input type="text" id="customer_name" name="customer_name" placeholder="Customer Name" required>
    
    <label for="service">Service:</label>
    <input type="text" id="service" name="service" placeholder="Service" required>
    
    <label for="order_date">Order Date:</label>
    <input type="date" id="order_date" name="order_date" required>
    
    <label for="status">Status:</label>
    <input type="text" id="status" name="status" placeholder="Status" required>
    
    <h3>Select Items:</h3>
    <!-- Loop through items to create checkboxes -->
    <?php
    include('../includes/db_connect.php');
    $query = "SELECT item_name, price FROM items WHERE service_type = 'wash+fold'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as $item) {
        echo "<div>";
        echo "<input type='checkbox' name='items[{$item['item_name']}]' value='{$item['price']}' />";
        echo htmlspecialchars($item['item_name']) . " - ₹" . number_format($item['price'], 2);
        echo "</div>";
    }
    ?>

    <button type="submit">Add Order</button>
</form>

<?php
include('../includes/footer.php');
?>
