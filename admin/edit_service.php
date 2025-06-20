<?php
include('../includes/db_connect.php');

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Fetch service details based on the id
    $query = "SELECT * FROM services WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_assoc();

    if (!$service) {
        die("Service not found.");
    }
} else {
    die("Service ID is missing.");
}

// Update service details after form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Update service in the database
    $update_query = "UPDATE services SET service_name = ?, price = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sdsi", $service_name, $price, $description, $service_id);
    $stmt->execute();

    // Redirect to the manage services page after updating
    header("Location: manage_services.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/header.php'); ?>

    <div class="content">
        <h2>Edit Service</h2>
        <form action="edit_service.php?id=<?php echo $service['id']; ?>" method="post">
            <input type="text" name="service_name" value="<?php echo htmlspecialchars($service['service_name']); ?>" placeholder="Service Name" required>
            <input type="number" name="price" value="<?php echo htmlspecialchars($service['price']); ?>" placeholder="Price" required>
            <textarea name="description" placeholder="Description" required><?php echo htmlspecialchars($service['description']); ?></textarea>
            <button type="submit">Update Service</button>
        </form>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
