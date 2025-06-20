<?php
session_start();
include('../includes/db_connect.php');


// Check if the user is an admin
/*if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../registration.php');
    exit();
}*/

// Fetch feedback from the database
$sql = "SELECT f.id, u.username, f.feedback_text, f.rating, f.created_at 
        FROM feedback f
        JOIN registration u ON f.user_id = u.userid
        ORDER BY f.created_at DESC";
$stmt = $pdo->query($sql);
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Manage Feedback</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <div class="content">
        <h2>Manage Feedback</h2>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Feedback</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedbacks as $feedback): ?>
                <tr>
                    <td><?= htmlspecialchars($feedback['username']) ?></td>
                    <td><?= htmlspecialchars($feedback['feedback_text']) ?></td>
                    <td><?= htmlspecialchars($feedback['rating']) ?></td>
                    <td><?= htmlspecialchars($feedback['created_at']) ?></td>
                    <td>
                        <a href="delete_feedback.php?id=<?= $feedback['id'] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
