<?php
include('../includes/header.php');
include('../includes/db_connect.php'); // Include your DB connection


// Fetch existing users
$result = $conn->query("SELECT * FROM registration");

?>
  <link rel="stylesheet" href="../assets/css/style.css">
<h2>Manage Users</h2>

<!-- Add User Form -->
<form method="POST" action="process_add_user.php">
    <h3>Add User</h3>
    <!--<input type="text" name="username" placeholder="Username" required>-->
    <input type="email" name="username" placeholder="Email hear" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="role" placeholder="Role (e.g., admin, user)" required>
    <button type="submit">Add User</button>
</form>

<!-- Existing Users Table -->
<h3>Existing Users</h3>
<table>
    <thead>
        <tr>
            <th>UserID</th>
            <th>Username</th>
            <th>password</th>
            <th>Role</th>
            <!--<th>Actions</th>-->
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['userid']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['role']; ?></td>
            
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
//include('../includes/footer.php');
$conn->close(); // Close the database connection
?>