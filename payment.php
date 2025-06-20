<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styles remain unchanged */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: row;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #81007f;
            color: white;
            width: 220px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            height: 100vh;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            width: 100%;
        }

        .sidebar li {
            margin: 15px 0;
            width: 100%;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #6e006e;
        }

        .fa-icon {
            margin-right: 10px;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: white;
        }

        .content h1 {
            font-size: 28px;
            color: #81007f;
            text-align: center;
            margin-bottom: 20px;
        }

        .payment-details {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .payment-details h2 {
            font-size: 22px;
            color: #81007f;
        }

        label {
            font-size: 16px;
            color: #333;
            display: block;
            margin-top: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #81007f;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #6e006e;
        }

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
            animation: fadeIn 0.5s ease-in-out;
        }

        .modal-content h2 {
            color: #81007f;
            font-size: 24px;
        }

        .close-btn {
            background-color: #81007f;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .close-btn:hover {
            background-color: #6e006e;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="#upi"><i class="fa-icon fas fa-mobile-alt"></i> UPI</a></li>
            <li><a href="#bank"><i class="fa-icon fas fa-university"></i> Bank Account</a></li>
            <li><a href="#card"><i class="fa-icon fas fa-credit-card"></i> Credit/Debit Card</a></li>
            <li><a href="#paypal"><i class="fa-icon fab fa-paypal"></i> PayPal</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Make a Payment</h1>

        <div id="upi-details" class="payment-details">
            <h2>UPI Payment</h2>
            <label for="upiID">UPI ID:</label>
            <input type="text" id="upiID" name="upiID">
            <p>Enter your UPI ID to make a payment using UPI.</p>
        </div>

        <div id="bank-details" class="payment-details">
            <h2>Bank Account Payment</h2>
            <label for="bankAccount">Bank Account Number:</label>
            <input type="text" id="bankAccount" name="bankAccount">
            <p>Provide your bank account number for bank transfers.</p>
        </div>

        <div id="card-details" class="payment-details">
            <h2>Credit/Debit Card Payment</h2>
            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber">

            <label for="expiryDate">Expiry Date:</label>
            <input type="text" id="expiryDate" name="expiryDate">

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv">
            <p>Enter your card details for credit/debit card payments.</p>
        </div>

        <div id="paypal-details" class="payment-details">
            <h2>PayPal Payment</h2>
            <p>Use your PayPal account to make a payment.</p>
        </div>

        <button type="button" id="payButton">Pay</button>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <h2>Payment Successful!</h2>
            <button class="close-btn" id="closeModal">Close</button>
        </div>
    </div>

    <script>
        const sidebarLinks = document.querySelectorAll(".sidebar a");
        const paymentDetails = document.querySelectorAll(".payment-details");
        const payButton = document.getElementById("payButton");
        const modal = document.getElementById("modal");
        const closeModal = document.getElementById("closeModal");

        // Sidebar navigation functionality
        sidebarLinks.forEach((link, index) => {
            link.addEventListener("click", (event) => {
                event.preventDefault();
                paymentDetails.forEach(detail => detail.style.display = "none");
                paymentDetails[index].style.display = "block";
            });
        });

        // Modal functionality for payment
        payButton.addEventListener("click", () => {
            modal.style.display = "flex"; // Show the modal
        });

        closeModal.addEventListener("click", () => {
            window.location.href = "index.php"; // Redirect to index page
        });
    </script>
</body>
</html>
