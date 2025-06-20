<?php
include('../includes/db_connect.php');

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Fetch item details based on the id
    $sql = "SELECT * FROM items WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$item_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        die("Item not found.");
    }
} else {
    die("Item ID is missing.");
}

// Update item details after form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $service_type = $_POST['service_type'];
    $category = $_POST['category'];

    // Update the item in the database
    $update_sql = "UPDATE items SET item_name = ?, price = ?, service_type = ?, category = ? WHERE id = ?";
    $stmt = $pdo->prepare($update_sql);
    $stmt->execute([$item_name, $price, $service_type, $category, $item_id]);

    // Redirect to the manage items page after updating
    header("Location: manage_items.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Edit Item</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>

    <div class="content">
        <h2>Edit Item</h2>
        <form action="edit_item.php?id=<?= $item['id'] ?>" method="POST">
            <input type="text" name="item_name" id="item_name" value="<?= htmlspecialchars($item['item_name']) ?>" placeholder="Item Name" required>
            <input type="number" name="price" id="price" value="<?= htmlspecialchars($item['price']) ?>" step="0.01" placeholder="Price" required>
            <label for="service_type">Service Type:</label>
            <select name="service_type" id="service_type" required>
                <option value="wash+fold" <?= $item['service_type'] == 'wash+fold' ? 'selected' : '' ?>>Wash+Fold</option>
                <option value="wash+iron" <?= $item['service_type'] == 'wash+iron' ? 'selected' : '' ?>>Wash+Iron</option>
                <option value="dry clean" <?= $item['service_type'] == 'dry clean' ? 'selected' : '' ?>>Dry Clean</option>
                <option value="steam iron" <?= $item['service_type'] == 'steam iron' ? 'selected' : '' ?>>Steam Iron</option>
                <option value="stain clear" <?= $item['service_type'] == 'stain clear' ? 'selected' : '' ?>>Stain Clear</option>
            </select>

            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="men" <?= $item['category'] == 'men' ? 'selected' : '' ?>>Men</option>
                <option value="women" <?= $item['category'] == 'women' ? 'selected' : '' ?>>Women</option>
                <option value="kid" <?= $item['category'] == 'kid' ? 'selected' : '' ?>>Kid</option>
                <option value="household" <?= $item['category'] == 'household' ? 'selected' : '' ?>>Household</option>
            </select>
            <button type="submit">Update Item</button>
        </form>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
