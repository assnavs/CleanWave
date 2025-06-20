<?php
include('../includes/header.php');
include('../includes/db_connect.php'); // Include your DB connection

// Fetch existing donations
$result = $conn->query("SELECT * FROM donations");

?>


<!-- Add Donation Form 
<form method="POST" action="process_add_donation.php">
    <h3>Add Donation</h3>
    <input type="text" name="donor_name" placeholder="Donor Name" required>
    <input type="text" name="item_description" placeholder="Item Description" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <button type="submit">Add Donation</button>
</form>-->

<h2>Existing Donations</h2>
<!-- Existing Donations Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Donor Name</th>
            <th>Item Description</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['donor_name']; ?></td>
            <td><?php echo $row['item_description']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
include('../includes/footer.php');
$conn->close(); // Close the database connection
?>
