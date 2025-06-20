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

    <?php
// Start session and include database connection
session_start();
include('includes/db_connect.php'); // Update the path if necessary

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Check if order_id is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']); // Sanitize the order ID

    // Update the order status to 'Cancelled'
    $sql_cancel = "UPDATE orders SET status = 'Cancelled' WHERE id = ?";

    // Prepare the statement to prevent SQL injection
    if ($stmt = $conn->prepare($sql_cancel)) {
        $stmt->bind_param("i", $order_id);

        // Execute the query
        if ($stmt->execute()) {
            // Check if the query affected any rows
            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = "Order #{$order_id} has been successfully cancelled.";
            } else {
                $_SESSION['error'] = "Failed to cancel the order. Please check the order ID.";
            }
        } else {
            $_SESSION['error'] = "Error executing query: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        $_SESSION['error'] = "Error preparing query: " . $conn->error;
    }
} else {
    $_SESSION['error'] = "Invalid request. Please try again.";
}

// Redirect back to the profile page
header('Location: profile.php');
exit();
?>
