<?php
include('../includes/db_connect.php');

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Delete the item from the database
    $delete_sql = "DELETE FROM items WHERE id = ?";
    $stmt = $pdo->prepare($delete_sql);
    $stmt->execute([$item_id]);

    // Redirect to the manage items page after deletion
    header("Location: manage_items.php");
    exit();
} else {
    die("Item ID is missing.");
}
?>
