<?php
// Include the database connection file
include('includes/db_connect.php');
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $customer_name = $_POST['customer_name'];
    $items = $_POST['items'] ?? []; // Selected items
    $quantity = $_POST['quantity'] ?? []; // Corresponding quantities

    // Capture the service name from the form
    if (isset($_POST['service']) && !empty($_POST['service'])) {
        $service_name = $_POST['service']; // Use the service name passed in the form
    } else {
        // If service name is not provided, return an error message
        die("Error: No service selected.");
    }

    // Insert data into the orders table
    try {
        $pdo->beginTransaction();

        // Insert into orders table
        $query = "INSERT INTO orders (customer_name, service, order_date, status) 
                  VALUES (:customer_name, :service, CURDATE(), 'booked')";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':customer_name' => $customer_name,
            ':service' => $service_name
        ]);

        // Get the last inserted order ID
        $order_id = $pdo->lastInsertId();

        // Insert each item into the order_items table
        foreach ($items as $item_name) {
            if (!empty($quantity[$item_name])) {
                $item_quantity = intval($quantity[$item_name]);

                // Fetch the price of the item from the database
                $price_query = "SELECT price FROM items WHERE item_name = :item_name";
                $price_stmt = $pdo->prepare($price_query);
                $price_stmt->execute([':item_name' => $item_name]);
                $item = $price_stmt->fetch(PDO::FETCH_ASSOC);

                if ($item) {
                    $item_price = floatval($item['price']);
                    $total = $item_price * $item_quantity;

                    // Insert into order_items table
                    $query = "INSERT INTO order_items (order_id, username, item_name, quantity, price, total) 
                              VALUES (:order_id, :username, :item_name, :quantity, :price, :total)";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([
                        ':order_id' => $order_id,
                        ':username' => $customer_name, // Add customer name as username
                        ':item_name' => $item_name,
                        ':quantity' => $item_quantity,
                        ':price' => $item_price,
                        ':total' => $total
                    ]);
                }
            }
        }

        // Commit the transaction
        $pdo->commit();

        // Redirect to a success page with the order ID
        header("Location: order_success.php?order_id=$order_id");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $pdo->rollBack();

        // Show a popup message for failure
        echo "<script>
            alert('Failed to place the order. Please try again.');
            window.history.back(); // Go back to the previous page
          </script>";
    }
}
?>
