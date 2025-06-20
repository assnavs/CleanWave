<?php
session_start();
session_destroy();
header('Location: /CleanWave/index.php'); // Redirect to the index page after logout
exit;
?>