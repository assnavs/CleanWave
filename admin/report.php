<?php
include('../includes/header.php');
include('../includes/db_connect.php'); // Include your DB connection

// Initialize variables
$order_date = ''; // Default value for order_date

// Check if a filter is applied based on Order Date
if (isset($_POST['order_date']) && !empty($_POST['order_date'])) {
    $order_date = $_POST['order_date'];
    // Sanitize the input to prevent SQL injection
    $order_date = $conn->real_escape_string($order_date);
}

// Initialize query for fetching orders with order items
$sql = "SELECT o.id AS order_id, o.customer_name, o.service, o.order_date, o.status, oi.item_name, oi.quantity, oi.price, oi.total 
        FROM orders o
        LEFT JOIN order_items oi ON o.id = oi.order_id
        WHERE o.status = 'accepted'"; // Filter orders based on accepted status

// If a specific date is selected, filter by that date
if (!empty($order_date)) {
    $sql .= " AND o.order_date = '$order_date'";
}

// Execute the query for orders
$result = $conn->query($sql);

// Initialize total price variable
$total_price = 0;

// Query to calculate the total price for the selected date
if (!empty($order_date)) {
    $total_price_sql = "SELECT SUM(oi.total) AS total_price
                        FROM order_items oi
                        LEFT JOIN orders o ON oi.order_id = o.id
                        WHERE o.status = 'accepted' AND o.order_date = '$order_date'";

    $total_price_result = $conn->query($total_price_sql);
    if ($total_price_result->num_rows > 0) {
        $total_price_row = $total_price_result->fetch_assoc();
        $total_price = $total_price_row['total_price'];
    }
}
?>

<style>
        /* Ensure the body takes up the full page and allows scrolling */
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-y: scroll; /* Enables vertical scrolling */
        }

        /* Ensure the table has enough space to show content properly */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        /* Limit the height of the table for better visibility */
        tbody {
            display: block;
            max-height: 400px; /* Adjust this as needed */
            overflow-y: auto;
        }

        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        /* Optional: Add a consistent style for the form */
        form {
            margin-bottom: 20px;
        }

        h2, h3 {
            margin: 20px 0;
        }
</style>

<h2>Report</h2>

<!-- Filter Orders Form -->
<form method="POST" action="report.php">
    <h3>Filter Orders</h3>
    <input type="date" name="order_date" required>
    <button type="submit">Filter Orders</button>
</form>

<!-- Existing Orders Table -->
<h3>Orders List for <?php echo htmlspecialchars($order_date); ?></h3>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Service</th>
            <th>Items</th>
            <th>Qty</th>
            <th>Total Price</th>
            <th>Order Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
      <?php 
      // Check if there are results
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()): ?>
          <tr>
              <td><?php echo $row['order_id']; ?></td>
              <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
              <td><?php echo htmlspecialchars($row['service']); ?></td>
              <td><?php echo htmlspecialchars($row['item_name']); ?></td>
              <td><?php echo htmlspecialchars($row['quantity']); ?></td>
              <td><?php echo htmlspecialchars($row['total']); ?></td>
              <td><?php echo htmlspecialchars($row['order_date']); ?></td>
              <td><?php echo htmlspecialchars($row['status']); ?></td>
        </tr>
      <?php endwhile; 
      } else {
          echo "<tr><td colspan='8'>No orders found.</td></tr>";
      } ?>
    </tbody>
</table>

<!-- Display the Total Price -->
<?php if (!empty($order_date) && $total_price > 0): ?>
    <h3>Total Price for <?php echo htmlspecialchars($order_date); ?>: ₹<?php echo number_format($total_price, 2); ?></h3>
<?php elseif (empty($order_date)): ?>
    <h3>Please select a date to filter orders.</h3>
<?php else: ?>
    <h3>No orders found for this date.</h3>
<?php endif; ?>

<?php
include('../includes/footer.php');
$conn->close(); // Close the database connection
?>
