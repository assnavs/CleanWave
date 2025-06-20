<?php
include('../includes/header.php');
?>

<form method="POST" action="process_add_service.php" onsubmit="return validateServiceForm()">
    <h2>Add Service</h2>
    <input type="text" id="service_name" name="service_name" placeholder="Service Name" required>
    <input type="number" id="price" name="price" placeholder="Price" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <button type="submit">Add Service</button>
</form>

<?php
include('../includes/footer.php');
?>


