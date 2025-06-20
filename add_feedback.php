<?php
include('includes/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback</title>
</head>
<body>
    <header>
    <nav>
        <div class="nav_logo">
             <a href="#">
                    <img src="images/CleanWave_logo.png" alt="CleanWave Logo" />
                    <h2>CleanWave</h2>
                </a>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
        
        </ul>
    </nav>
</header>
    
    <div class="content">
        <h2>Submit Feedback</h2>
        <form action="process_add_feedback.php" method="POST">
    <textarea name="username" id="username" placeholder="Your name" required></textarea>
    <textarea name="feedback_text" id="feedback_text" placeholder="Enter your feedback" required></textarea>
    <label for="rating">Rating (1 to 5):</label>
    <input type="number" id="rating" name="rating" min="1" max="5" required>
    <button type="submit">Submit Feedback</button>
</form>

    </div>
<style type="text/css">
/* General styling */
body {
    font-family: Arial, sans-serif;
    background-color: white;
    color: green;
    margin: 0;
    padding: 0;
}

header {
    background-color: #81007f;
    color: white;
    padding: 1em;
    text-align: center;
}

header nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
}

nav .nav_logo a {
    display: flex;
    gap: 15px;
    align-items: center;
      text-decoration: none; /* Removes underline */
}

.nav_logo img {
    height: 50px;
    margin-right: 10px;
}

.nav_logo h2 {
    display: flex;
    color: white;
    font-weight: 600;
    font-size: 32px;
}

nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
}

nav ul li {
    margin-right: 20px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-size: 1.1em;
}

.content {
    padding: 20px;
    text-align: center;
}

h2 {
    color: #81007f;
}

form {
    max-width: 400px;
    margin: auto;
    padding: 30px;
    border: 1px solid #81007f;
    border-radius: 8px;
    background-color: white;
}

textarea, input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #81007f;
    border-radius: 4px;
    color: green;
}

button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: #81007f;
    color: white;
    font-size: 1em;
    cursor: pointer;
}

button:hover {
    background-color: #6c0059; /* Darker shade for hover effect */
}

</style>
</body>
</html>