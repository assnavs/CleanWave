<?php include('../includes/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Add Item</title>
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
    </div>

    <?php include('../includes/footer.php'); ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>
