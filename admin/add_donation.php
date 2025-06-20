<?php
include('../includes/header.php');
?>

<h2>Add New Donation</h2>

<!-- Add Donation Form -->
<form method="POST" action="process_add_donation.php">
    <label for="donor_name">Donor Name:</label>
    <input type="text" id="donor_name" name="donor_name" placeholder="Donor Name" required>
    
    <label for="item_description">Item Description:</label>
    <input type="text" id="item_description" name="item_description" placeholder="Item Description" required>
    
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" placeholder="Quantity" required>
    
    <button type="submit">Add Donation</button>
</form>

<?php
include('../includes/footer.php');
?>
