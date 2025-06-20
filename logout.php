<?php
session_start(); // Start the session

// Destroy all session data
session_destroy();

// Optionally, you can unset specific session variables
// unset($_SESSION['username']);
// unset($_SESSION['role']);

// Redirect to the homepage or login page
header("Location: index.php"); // Change this to your desired redirect page
exit();
?>