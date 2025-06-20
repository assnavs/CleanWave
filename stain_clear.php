<?php 
include('includes/db_connect.php'); 
session_start();

// Fetch items for Stain Clear service
$query = "SELECT item_name, price, category FROM items WHERE service_type = 'stain clear'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stain Clear - CleanWave</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: 200px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .category {
            margin-bottom: 30px;
            cursor: pointer;
            padding: 10px;
            background-color: #e2e2e2;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
        }

        .category:hover {
            background-color: #ccc;
        }

        .item-list {
            display: none; /* Hidden by default */
            margin-top: 10px;
        }

        .item-container {
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f1f1f1;
            border-radius: 5px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            justify-content: space-between;
        }

        .item-name {
            font-weight: bold;
        }

        .item-price {
            color: #333;
        }

        .quantity-input {
            width: 60px;
        }

        .order-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            width: 100%;
        }

        .order-button:hover {
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
    <h1>Stain Clear Service</h1>

    <!-- Form for placing the order -->
    <form action="place_order.php" method="POST">

        <!-- Customer name input -->
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" placeholder=" email"  required><br><br>

        <!-- Hidden input for service name -->
        <input type="hidden" name="service" value="stain clear">

        <!-- Loop through categories and display buttons -->
        <?php
        // Define categories
        $categories = ['men', 'women', 'kid', 'household'];
        foreach ($categories as $category) {
            echo "<div class='category' onclick='showCategoryItems(\"$category\")'>";
            echo "<h2>" . ucfirst($category) . "</h2>";
            echo "</div>";

            echo "<div class='item-list' id='$category'>";

            // Loop through items for the selected category
            foreach ($items as $item) {
                if ($item['category'] == $category) {
                    echo "<div class='item-container'>";
                    echo "<span class='item-name'>" . htmlspecialchars($item['item_name']) . "</span>";
                    echo "<span class='item-price'>₹" . htmlspecialchars(number_format($item['price'], 2)) . "</span>";
                    echo "<label>";
                    echo "<input type='checkbox' name='items[]' value='" . htmlspecialchars($item['item_name']) . "' /> Select(check this box before placing the order)";
                    echo "</label>";
                    echo "<input type='number' class='quantity-input' name='quantity[" . htmlspecialchars($item['item_name']) . "]' placeholder='Qty' min='1'>";
                    echo "</div>";
                }
            }
            
            echo "</div>";
        }
        ?>

        <!-- Submit button -->
        <button type="submit" class="order-button">Place Order</button>
    </form>

</div>

<script>
    function showCategoryItems(category) {
        // Hide all item lists first
        const allLists = document.querySelectorAll('.item-list');
        allLists.forEach(list => {
            list.style.display = 'none';
        });

        // Show the selected category's item list
        const selectedList = document.getElementById(category);
        selectedList.style.display = 'block';
    }
</script>

<script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
</body>
</html>
