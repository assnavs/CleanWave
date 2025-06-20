<?php
// Include the database connection file
include('includes/db_connect.php');
session_start();

// Initialize a variable to track the donation status
$donation_success = false;

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $donor_name = $_POST['donor_name'];
    $item_description = $_POST['item_description'];
    $quantity = $_POST['quantity'];

    // Insert data into the donations table
    try {
        $query = "INSERT INTO donations (donor_name, item_description, quantity, created_at) VALUES (:donor_name, :item_description, :quantity, NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':donor_name' => $donor_name,
            ':item_description' => $item_description,
            ':quantity' => $quantity
        ]);

        // Set success flag
        $donation_success = true;
    } catch (Exception $e) {
        echo "Failed to process donation: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothes Donation - CleanWave</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .donate-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .donate-button:hover {
            background-color: #218838;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-content h2 {
            color: #28a745;
            font-size: 24px;
        }

        .modal-content button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .modal-content button:hover {
            background-color: #218838;
        }
    </style>
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
    <div class="container">
        <h1>Donate Clothes</h1>
        <form action="donation.php" method="POST" id="donationForm">
            <div class="form-group">
                <label for="donor_name">Your Name:</label>
                <input type="text" id="donor_name" name="donor_name" required>
            </div>
            <div class="form-group">
                <label for="item_description">Item Description:</label>
                <textarea id="item_description" name="item_description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
            </div>
            <button type="submit" class="donate-button">Donate</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="donationModal" class="modal">
        <div class="modal-content">
            <h2>Donation Completed!</h2>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        // PHP variable to track success
        const donationSuccess = <?php echo json_encode($donation_success); ?>;

        // Show modal if donation is successful
        if (donationSuccess) {
            const modal = document.getElementById("donationModal");
            modal.style.display = "flex";
        }

        // Close modal and redirect to home
        function closeModal() {
            window.location.href = "index.php";
        }
    </script>
</body>
</html>
