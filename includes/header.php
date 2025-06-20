<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanWave Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style type="text/css">
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #ffffff;
    color:green;
}

/* Header */
header {
    background-color: #81007f;
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    margin: 0;
}

header .header-right ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

header .header-right ul li {
    display: inline-block;
    margin-left: 20px;
}

header .header-right ul li a {
    color: white;
    text-decoration: none;
}

header .header-right ul li a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <h1>CleanWave Admin Dashboard</h1>
        </div>
        <div class="header-right">
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <!--<li><a href="profile.php">Profile</a></li>-->
                <li><a href="adlogout.php">Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="clear"></div>
