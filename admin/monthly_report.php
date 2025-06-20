<?php
//include('../includes/header.php');
include('../includes/db_connect.php'); // Include your DB connection

// Initialize query for fetching orders with order items
$sql = "SELECT o.id AS order_id, o.customer_name, o.service, o.order_date, o.status, oi.item_name, oi.quantity, oi.price, oi.total 
        FROM orders o
        LEFT JOIN order_items oi ON o.id = oi.order_id
        WHERE o.status = 'accepted'"; // Filter orders based on accepted status

// Check if a filter is applied based on Order Month and Year
if (isset($_POST['month']) && isset($_POST['year']) && !empty($_POST['month']) && !empty($_POST['year'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];
    
    // Sanitize the input to prevent SQL injection
    $month = $conn->real_escape_string($month);
    $year = $conn->real_escape_string($year);
    
    // Modify the query to filter by Order Month and Year
    $sql .= " AND MONTH(o.order_date) = '$month' AND YEAR(o.order_date) = '$year'";
}

$month = isset($_POST['month']) ? $_POST['month'] : 1; // Default to January (1)
$year = isset($_POST['year']) ? $_POST['year'] : 2024; // Default to 2024


// Execute the query for orders
$result = $conn->query($sql);

// Query to get the grand total for the month
$grand_total_sql = "SELECT SUM(oi.total) AS grand_total 
                    FROM order_items oi 
                    LEFT JOIN orders o ON oi.order_id = o.id 
                    WHERE o.status = 'accepted' 
                    AND MONTH(o.order_date) = '$month' AND YEAR(o.order_date) = '$year'";

$grand_total_result = $conn->query($grand_total_sql);
$grand_total = 0;
if ($grand_total_result->num_rows > 0) {
    $grand_total_row = $grand_total_result->fetch_assoc();
    $grand_total = $grand_total_row['grand_total'];
}
?>
<!--<style>
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
</style>-->

<h2>Report</h2>

<!-- Filter Orders Form -->
<form method="POST" action="monthly_report.php">
    <h3>Filter Orders by Month</h3>
    <label for="month">Month:</label>
    <select name="month" required>
        <option value="1" <?php echo (isset($_POST['month']) && $_POST['month'] == 1) ? 'selected' : ''; ?>>January</option>
        <option value="2" <?php echo (isset($_POST['month']) && $_POST['month'] == 2) ? 'selected' : ''; ?>>February</option>
        <option value="3" <?php echo (isset($_POST['month']) && $_POST['month'] == 3) ? 'selected' : ''; ?>>March</option>
        <option value="4" <?php echo (isset($_POST['month']) && $_POST['month'] == 4) ? 'selected' : ''; ?>>April</option>
        <option value="5" <?php echo (isset($_POST['month']) && $_POST['month'] == 5) ? 'selected' : ''; ?>>May</option>
        <option value="6" <?php echo (isset($_POST['month']) && $_POST['month'] == 6) ? 'selected' : ''; ?>>June</option>
        <option value="7" <?php echo (isset($_POST['month']) && $_POST['month'] == 7) ? 'selected' : ''; ?>>July</option>
        <option value="8" <?php echo (isset($_POST['month']) && $_POST['month'] == 8) ? 'selected' : ''; ?>>August</option>
        <option value="9" <?php echo (isset($_POST['month']) && $_POST['month'] == 9) ? 'selected' : ''; ?>>September</option>
        <option value="10" <?php echo (isset($_POST['month']) && $_POST['month'] == 10) ? 'selected' : ''; ?>>October</option>
        <option value="11" <?php echo (isset($_POST['month']) && $_POST['month'] == 11) ? 'selected' : ''; ?>>November</option>
        <option value="12" <?php echo (isset($_POST['month']) && $_POST['month'] == 12) ? 'selected' : ''; ?>>December</option>
    </select>
    
    <label for="year">Year:</label>
    <select name="year" required>
        <option value="2024" <?php echo (isset($_POST['year']) && $_POST['year'] == 2024) ? 'selected' : ''; ?>>2024</option>
        <option value="2025" <?php echo (isset($_POST['year']) && $_POST['year'] == 2025) ? 'selected' : ''; ?>>2025</option>
        <!-- Add more years as needed -->
    </select>
    
    <button type="submit">Filter Orders</button>
</form>


<!-- Existing Orders Table -->
<h3>Orders for <?php echo htmlspecialchars($month); ?>/<?php echo htmlspecialchars($year); ?></h3>
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
          echo "<tr><td colspan='8'>No orders found for this month.</td></tr>";
      } ?>
    </tbody>
</table>

<!-- Display the Grand Total -->
<?php if ($grand_total > 0): ?>
    <h3>Grand Total for <?php echo htmlspecialchars($month); ?>/<?php echo htmlspecialchars($year); ?>: ₹<?php echo number_format($grand_total, 2); ?></h3>
<?php else: ?>
    <h3>No orders found for this month.</h3>
<?php endif; ?>

<?php
//include('../includes/footer.php');
$conn->close(); // Close the database connection
?>
