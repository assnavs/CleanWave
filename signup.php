<?php
$dbhost = "localhost"; 
$dbuser = "root";  
$db = "user"; 

$conn = new mysqli($dbhost, $dbuser,"", $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password == $cpassword) {
        $encrypt_pswd=md5($password);
        $query = "INSERT INTO registration (username, password, role) VALUES ('$username', '$encrypt_pswd','user')";
        $result = $conn->query($query);

        if ($result) {
            // Signup successful, redirect to login page
            header('Location: index.php');
            exit;
        } else {
            // Signup failed, display error message
            echo 'Error creating account';
        }
    } else {
        // Password mismatch, display error message
        echo 'Passwords do not match';
    }
}
?>