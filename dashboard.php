<?php 
session_start();
include('../includes/db_connect.php'); 


// Check if the user is logged in and has admin role
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

function getCount($table) {
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
    return $stmt->fetchColumn();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <?php include('../includes/header.php'); ?>
    <div class="sidebar">
        <ul>
            <li><a href="manage_users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_users.php' ? 'active' : ''; ?>">Manage Users</a></li>
            <li><a href="manage_orders.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_orders.php' ? 'active' : ''; ?>">Manage Orders</a></li>
            <li><a href="manage_services.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_services.php' ? 'active' : ''; ?>">Manage Services</a></li>
            <li><a href="manage_donations.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_donations.php' ? 'active' : ''; ?>">Manage Donations</a></li>
            <li><a href="manage_feedback.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_feedback.php' ? 'active' : ''; ?>">Manage Feedback</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Here you can manage the CleanWave system.</p>
        
        <div class="stats">
            <div>Total Users: <?php echo getCount('users'); ?></div>
            <div>Total Orders: <?php echo getCount('orders'); ?></div>
            <div>Total Services: <?php echo getCount('services'); ?></div>
            <div>Total Donations: <?php echo getCount('donations'); ?></div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>
    
    <script src="../assets/js/script.js"></script>
</body>
</html>
