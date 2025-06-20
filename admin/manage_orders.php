<?php
include('../includes/header.php');
include('../includes/db_connect.php'); // Include your DB connection

// Initialize query for fetching orders with order items
$sql = "SELECT o.id AS order_id, o.customer_name, o.service, o.order_date, o.status, oi.item_name, oi.quantity, oi.price, oi.total 
        FROM orders o
        LEFT JOIN order_items oi ON o.id = oi.order_id";

// Check if a filter is applied based on Order ID
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $order_id = $_POST['id'];
    // Sanitize the input to prevent SQL injection
    $order_id = $conn->real_escape_string($order_id);
    
    // Modify the query to filter by Order ID
    $sql .= " WHERE o.id = '$order_id'";
}

// Execute the query
$result = $conn->query($sql);
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

<h2>Manage Orders</h2>

<!-- Filter Orders Form -->
<form method="POST" action="manage_orders.php">
    <h3>Filter Orders</h3>
    <input type="text" name="id" placeholder="Order ID" required>
    <button type="submit">Filter Orders</button>
</form>

<!-- Existing Orders Table -->
<h3>Existing Orders</h3>
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
            <th>Actions</th>
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
               <td>
                <!-- Form for Accept Button -->
                <form method="POST" action="status.php" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    <input type="hidden" name="action" value="accepted">
                    <button type="submit" class="accept-btn" data-order-id="<?php echo $row['order_id']; ?>" style="background-color: green; color: white; padding: 5px 10px; border: none; cursor: pointer;">
                        Accept
                    </button>
                </form>
                
                <!-- Form for Decline Button -->
                <form method="POST" action="status.php" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    <input type="hidden" name="action" value="declined">
                    <button type="submit" class="decline-btn" data-order-id="<?php echo $row['order_id']; ?>" style="background-color: red; color: white; padding: 5px 10px; border: none; cursor: pointer;">
                        Decline
                    </button>
                </form>
            </td>
        </tr>
      <?php endwhile; 
      } else {
          echo "<tr><td colspan='9'>No orders found.</td></tr>";
      } ?>
    </tbody>
</table>
<script>
    // Get all accept and decline buttons
    const acceptButtons = document.querySelectorAll('.accept-btn');
    const declineButtons = document.querySelectorAll('.decline-btn');

    acceptButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            // Change button text to "Accepted"
            this.textContent = 'Accepted';
            // Hide the corresponding decline button
            const declineButton = document.querySelector(`.decline-btn[data-order-id="${orderId}"]`);
            if (declineButton) {
                declineButton.style.display = 'none';
            }
            // Optionally, submit the form
            this.closest('form').submit();
        });
    });

    declineButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            // Change button text to "Declined"
            this.textContent = 'Declined';
            // Hide the corresponding accept button
            const acceptButton = document.querySelector(`.accept-btn[data-order-id="${orderId}"]`);
            if (acceptButton) {
                acceptButton.style.display = 'none';
            }
            // Optionally, submit the form
            this.closest('form').submit();
        });
    });
</script>

<?php
include('../includes/footer.php');
$conn->close(); // Close the database connection
?>
