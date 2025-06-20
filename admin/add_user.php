<?php
include('../includes/header.php');
?>

<h2>Add New User</h2>

<!-- Add User Form -->
<form method="POST" action="process_add_user.php">
    <label for="username">Username:</label>
    <input type="email" id="username" name="username" placeholder="Email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Password" required>
    
    <label for="role">Role (admin/user):</label>
    <input type="text" id="role" name="role" placeholder="Role" required>
    
    <button type="submit">Add User</button>
</form>

<?php
include('../includes/footer.php');
?>
