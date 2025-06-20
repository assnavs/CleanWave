<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanWave - Services</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .service-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 30%;
            text-align: center;
        }

        .service-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .service-title {
            font-size: 20px;
            margin: 10px 0;
        }

        .service-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .service-button:hover {
            background-color: #FFC107;
        }

        /* Add a style for the heading */
        .services-heading {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin: 40px 0 20px;
            color: #333;
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
                <!--<li><a href="index.php">About</a></li>
                <li><a href="index.php">Services</a></li>
                <li><a href="index.php">Contact</a></li>-->
            </ul>
        </nav>
    </header>

    <!-- Services Heading -->
    <h2 class="services-heading">SERVICES</h2>

    <div class="container">
        <div class="service-card">
            <img src="images/c1.png" alt="Wash + Fold">
            <h3 class="service-title">Wash + Fold</h3>
            <button class="service-button" onclick="window.location.href='wash_fold.php'">More Details</button>
        </div>

        <div class="service-card">
            <img src="images/c2.png" alt="Wash + Iron">
            <h3 class="service-title">Wash + Iron</h3>
            <button class="service-button" onclick="window.location.href='wash_iron.php'">More Details</button>
        </div>

        <div class="service-card">
            <img src="images/c3.png" alt="Dry Clean">
            <h3 class="service-title">Dry Clean</h3>
            <button class="service-button" onclick="window.location.href='dry_clean.php'">More Details</button>
        </div>

        <div class="service-card">
            <img src="images/c4.png" alt="Steam Iron">
            <h3 class="service-title">Steam Iron</h3>
            <button class="service-button" onclick="window.location.href='steam_iron.php'">More Details</button>
        </div>

        <div class="service-card">
            <img src="images/c5.png" alt="Stain Clear">
            <h3 class="service-title">Stain Clear</h3>
            <button class="service-button" onclick="window.location.href='stain_clear.php'">More Details</button>
        </div>

        <div class="service-card">
            <img src="images/c6.png" alt="Donation">
            <h3 class="service-title">Donation</h3>
            <button class="service-button" onclick="window.location.href='donation.php'">More Details</button>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
</body>
</html>
