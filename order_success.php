<?php
// Include database connection if needed
include('includes/db_connect.php');

// Fetch order details using the order_id from the query string
if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    
    // Query to fetch order details
    $orderQuery = "SELECT o.customer_name, o.service, o.order_date, 
                          SUM(oi.total) AS grand_total 
                   FROM orders o 
                   JOIN order_items oi ON o.id = oi.order_id 
                   WHERE o.id = :order_id";
    $orderStmt = $pdo->prepare($orderQuery);
    $orderStmt->execute([':order_id' => $order_id]);
    $order = $orderStmt->fetch(PDO::FETCH_ASSOC);

    // Query to fetch items for the order
    $itemsQuery = "SELECT item_name, quantity, price, total 
                   FROM order_items 
                   WHERE order_id = :order_id";
    $itemsStmt = $pdo->prepare($itemsQuery);
    $itemsStmt->execute([':order_id' => $order_id]);
    $items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);

    if ($order) {
        $bill = "
        <div class='bill'>
            <h1>Order Receipt</h1>
            <p><strong>Order ID:</strong> $order_id</p>
            <p><strong>Customer Name:</strong> " . htmlspecialchars($order['customer_name']) . "</p>
            <p><strong>Service:</strong> " . htmlspecialchars($order['service']) . "</p>
            <p><strong>Order Date:</strong> " . htmlspecialchars($order['order_date']) . "</p>
            <h2>Order Items</h2>
            <table class='items-table'>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";
        
        foreach ($items as $item) {
            $bill .= "
                <tr>
                    <td>" . htmlspecialchars($item['item_name']) . "</td>
                    <td>" . intval($item['quantity']) . "</td>
                    <td>₹" . number_format($item['price'], 2) . "</td>
                    <td>₹" . number_format($item['total'], 2) . "</td>
                </tr>";
        }

        $bill .= "
                </tbody>
            </table>
            <p><strong>Grand Total:</strong> ₹" . number_format($order['grand_total'], 2) . "</p>
            <a href='payment.php?order_id=$order_id' class='order-button'>Proceed to Payment</a>
        </div>";
    } else {
        $bill = "<h1>Order Details Not Found</h1>";
    }
} else {
    $bill = "<h1>Invalid Request</h1>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt - CleanWave</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 105vh;
        }

        .bill {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .bill h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .bill p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .items-table th, .items-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .items-table th {
            background-color: #f4f4f4;
        }

        .order-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            font-size: 18px;
            cursor: pointer;
        }

        .order-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <?php echo $bill; ?>


    <header>
    <nav>
        <div class="nav_logo">
            <a href="#">
                <img src="images/CleanWave_logo.png" alt="CleanWave Logo" />
                <h2>CleanWave</h2>
            </a>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            
        </ul>
    </nav>
</header>

</body>
</html>
