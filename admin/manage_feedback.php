<?php
include('../includes/db_connect.php');
session_start();
$sql = "SELECT * FROM feedback ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Manage Items</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>
     <h2>Manage Feedbacks</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Feedback</th> <!-- New column -->
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['id']) ?></td>
                    <td><?= htmlspecialchars($item['username']) ?></td>
                    <td><?= htmlspecialchars($item['feedback_text']) ?></td>
                    <td><?= htmlspecialchars($item['rating']) ?></td> <!-- New column -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>