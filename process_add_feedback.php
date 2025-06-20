<?php
session_start();

// Database connection details
$dbhost = "localhost"; 
$dbuser = "root";  
$dbpassword = ""; 
$dbname = "user";

// Create a database connection
$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $conn->real_escape_string($_POST['username']);
$feedback_text = $conn->real_escape_string($_POST['feedback_text']);
$rating = intval($_POST['rating']); // Ensure the rating is an integer

// Validate the form data
if (empty($username) || empty($feedback_text) || $rating < 1 || $rating > 5) {
    echo "<script>
            alert('Invalid input. Please ensure all fields are filled correctly.');
            window.location.href = 'add_feedback.php';
          </script>";
    exit();
}

// Insert the feedback into the database
$sql = "INSERT INTO feedback (username, feedback_text, rating) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $username, $feedback_text, $rating);
    if ($stmt->execute()) {
        echo "<script>
                alert('Feedback submitted successfully!');
                window.location.href = 'index.php'; // Redirect to the main page
              </script>";
    } else {
        echo "<script>
                alert('Failed to submit feedback. Please try again later.');
                window.location.href = 'add_feedback.php';
              </script>";
    }
    $stmt->close();
} else {
    echo "<script>
            alert('Failed to prepare the database query.');
            window.location.href = 'add_feedback.php';
          </script>";
}

// Close the database connection
$conn->close();
?>
