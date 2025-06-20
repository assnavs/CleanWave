<?php include('../includes/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/header.php'); ?>
    <!--<div class="sidebar">-->
        <!-- Sidebar code -->
    </div>
    <div class="content">
        <h2>Manage Services</h2>

        <!-- Form to Add New Service 
        <form action="process_add_services.php" method="post">
            <input type="text" name="service_name" placeholder="Service Name" required>
            <input type="number" name="price" placeholder="Price" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <button type="submit">Add Service</button>
        </form>-->

        <!-- Display Existing Services -->
        <table>
            <thead>
                <tr>
                    <th>Service ID</th>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM services";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['service_name']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['description']}</td>
                                <td>
                                <a href='edit_service.php?id={$row['id']}'>Edit</a>
                                <a href='delete_service.php?id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No services found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include('../includes/footer.php'); ?>
</body>
</html>
