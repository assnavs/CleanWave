<?php
session_start();
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'user';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$email = $conn->real_escape_string(trim($_POST['username']));
$password = trim($conn->real_escape_string($_POST['password'])); // Trim whitespace

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format'); window.history.back();</script>";
    exit;
}

// Validate password length
if (strlen($password) < 3) {
echo "<script>alert('Password must be at least 6 characters long'); window.history.back();</script>";
    exit;
}

// Check if user exists in database
$query = "SELECT * FROM registration WHERE username = '$email'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // User exists, fetch user data
    $user_data = mysqli_fetch_assoc($result);
    $role = $user_data['role'];
    $hashed_password = md5($password);

    // Verify the password
    if ($hashed_password === $user_data['password']) {
        // Password is correct, update login timestamp
        $query_check = "SELECT * FROM login WHERE username = '$email'";
        $result_check = mysqli_query($conn, $query_check);
        $user_id=$user_data['id'];

        $_SESSION['id']=$user_id;
        
        if (mysqli_num_rows($result_check) == 0) {
            // If the user is not already logged in, insert a new record
            $sql_insert = "INSERT INTO login (username, password) VALUES ('$email', '$hashed_password')";
            mysqli_query($conn, $sql_insert);
        }

        // Set session variable based on user role
        if ($role == 'admin') {
            $_SESSION['role'] = 'admin'; 
            $_SESSION['username']=$email; 
            header('Location: admin/admin.php'); // redirect to admin dashboard
            exit;
        } elseif ($role == 'user') {
            $_SESSION['username']=$email; 
            $_SESSION['role'] = 'user';        
            header('Location: index.php'); // redirect to user dashboard
            exit;
        }
    } else {
        // Debugging output
echo "<script>alert('Invalid password'); window.history.back();</script>";
        exit;
            }
} else {
echo "<script>alert('Invalid user'); window.history.back();</script>";
    exit;
}

// Close connection
$conn->close();
?>