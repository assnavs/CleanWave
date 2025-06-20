<?php
include('../includes/db_connect.php'); // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$username = $_POST['username'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registration (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        echo "New user added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
$conn->close(); // Close the database connection

// Redirect back to the manage users page
header("Location: manage_users.php");
exit();
?>
