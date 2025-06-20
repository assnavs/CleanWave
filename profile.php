<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanWave | User Profile</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <!-- Header & Navbar Section -->
    <header>
        <nav>
            <div class="nav_logo">
                <a href="#">
                    <img src="images/CleanWave_logo.png" alt="CleanWave Logo" />
                    <h2>CleanWave</h2>
                </a>
            </div>

            <input type="checkbox" id="click" />
            <label for="click">
                <i class="menu_btn bx bx-menu"></i>
                <i class="close_btn bx bx-x"></i>
            </label>

            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#service">Services</a></li>
                <li><a href="#why">Why Us</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
</body>
<?php
// Start the session and include necessary files
session_start();
include('includes/db_connect.php'); // Include your DB connection

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login if not logged in
    header('Location: login.php');
    exit();
}

// Get logged-in user details
$username = $_SESSION['username']; // Assume the session has the username

// Fetch user data from the registration table
$sql_user = "SELECT * FROM registration WHERE username = '$username'";
$user_result = $conn->query($sql_user);
$user_data = $user_result->fetch_assoc();

// Fetch user orders from the orders and order_items tables
$sql_orders = "
SELECT o.id AS order_id, o.service, o.order_date, o.status, oi.item_name, oi.quantity, oi.price, oi.total
FROM orders o
JOIN order_items oi ON o.id = oi.order_id
WHERE oi.username = '$username'
ORDER BY o.order_date DESC
";
$orders_result = $conn->query($sql_orders);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanWave | User Profile</title>
    <link rel="stylesheet" href="profile.css"> <!-- Link to your CSS file -->
</head>
<body>
    <!-- Header & Navbar Section -->
    <header>
        <nav>
            <div class="nav_logo">
                <a href="#">
                    <img src="images/CleanWave_logo.png" alt="CleanWave Logo" />
                    <h2>CleanWave</h2>
                </a>
            </div>

            <input type="checkbox" id="click" />
            <label for="click">
                <i class="menu_btn bx bx-menu"></i>
                <i class="close_btn bx bx-x"></i>
            </label>

            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#service">Services</a></li>
                <li><a href="#why">Why Us</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($user_data['username']); ?>!</h1>

        <!-- User Profile Information -->
        <div class="profile-info">
            <h2>Profile Details</h2>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user_data['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['username']); ?></p> <!-- Assuming email is the username -->
            <p><strong>Role:</strong> <?php echo htmlspecialchars($user_data['role']); ?></p>
        </div>

        <!-- Order History -->
        <div class="order-history">
            <h2>Order History</h2>

            <?php if ($orders_result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Service</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Total Price</th> <!-- Added column for total price -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $previous_order_id = null;
                        $order_total = 0; // Initialize variable for total order price
                        $grand_total = 0; // Initialize variable for grand total

                        while ($order = $orders_result->fetch_assoc()):

                            // Check if the order ID is different from the previous one (new order)
                            if ($previous_order_id != $order['order_id']) {
                                // Display previous order total if this is a new order
                                if ($previous_order_id !== null) {
                                    echo "<tr><td colspan='8'><strong>Total Price for Order {$previous_order_id}: </strong></td><td><strong>" . number_format($order_total, 2) . "</strong></td></tr>";
                                    $grand_total += $order_total; // Add order total to grand total
                                }
                                $order_total = 0; // Reset total for new order
                            }

                            // Add item total to the order total
                            $order_total += $order['total'];

                            $previous_order_id = $order['order_id'];
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['service']); ?></td>
                                <td><?php echo htmlspecialchars($order['item_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                <td><?php echo htmlspecialchars($order['price']); ?></td>
                                <td><?php echo htmlspecialchars($order['total']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($order['status']); ?></td>
                                <td></td> <!-- Empty cell for Total Price column -->
                            </tr>
                        <?php endwhile; ?>

                        <!-- Display total price for the last order -->
                        <tr>
                            <td colspan="8"><strong>Total Price for Order <?php echo htmlspecialchars($previous_order_id); ?>: </strong></td>
                            <td><strong><?php echo number_format($order_total, 2); ?></strong></td>
                        </tr>

                        <!-- Display Grand Total Price -->
                        <tr>
                            <td colspan="8"><strong>Grand Total: </strong></td>
                            <td><strong><?php echo number_format($grand_total + $order_total, 2); ?></strong></td> <!-- Correct calculation for grand total -->
                        </tr>

                    </tbody>
                </table>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
