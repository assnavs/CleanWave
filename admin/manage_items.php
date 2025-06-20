<?php
include('../includes/db_connect.php');
session_start();

/*// Check if the user is an admin
if (!isset($_SESSION['userid']) || $_SESSION['role'] != 'admin') {
    header('Location: ../signup.php');
    exit();
}*/

// Fetch items from the database
$sql = "SELECT * FROM items ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Manage Items</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <div class="content">
        <h2>Add New Item</h2>
        <form action="process_add_item.php" method="POST" onsubmit="return validateItemForm();">
            <input type="text" name="item_name" id="item_name" placeholder="Item Name" required>
            <input type="number" name="price" id="price" step="0.01" placeholder="Price" required>
            <label for="service_type">Service Type:</label>
            <select name="service_type" id="service_type" required>
                <option value="wash+fold">Wash+Fold</option>
                <option value="wash+iron">Wash+Iron</option>
                <option value="dry clean">Dry Clean</option>
                <option value="steam iron">Steam Iron</option>
                <option value="stain clear">Stain Clear</option>
            </select>

            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="kid">Kid</option>
                <option value="household">Household</option>
            </select>
            <button type="submit">Add Item</button>
        </form>




        <h2>Manage Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Service Type</th>
                    <th>Category</th> <!-- New column -->
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['item_name']) ?></td>
                    <td><?= htmlspecialchars($item['price']) ?></td>
                    <td><?= htmlspecialchars($item['service_type']) ?></td>
                    <td><?= htmlspecialchars($item['category']) ?></td> <!-- New column -->
                    <td><?= htmlspecialchars($item['created_at']) ?></td>
                    <td>
                        <a href="edit_item.php?id=<?= $item['id'] ?>">Edit</a> | 
                        <a href="delete_item.php?id=<?= $item['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>