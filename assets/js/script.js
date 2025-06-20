// Form Validation for Adding a User
function validateAddUserForm() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const role = document.getElementById('role').value;

    // Basic validation for empty fields
    if (username === "") {
        alert("Username is required.");
        return false;
    }

    if (email === "") {
        alert("Email is required.");
        return false;
    }

    if (password === "") {
        alert("Password is required.");
        return false;
    }

    if (role === "") {
        alert("Please select a role.");
        return false;
    }

    // Email format validation (simple regex)
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true; // Form is valid
}

// Form Validation for Adding a Service
function validateAddServiceForm() {
    const serviceName = document.getElementById('service_name').value;
    const price = document.getElementById('price').value;

    if (serviceName === "") {
        alert("Service name is required.");
        return false;
    }

    if (price === "" || price <= 0) {
        alert("Price must be greater than zero.");
        return false;
    }

    return true;
}

// Form Validation for Adding a Donation
function validateAddDonationForm() {
    const donationType = document.getElementById('donation_type').value;
    const quantity = document.getElementById('quantity').value;

    if (donationType === "") {
        alert("Please select a donation type.");
        return false;
    }

    if (quantity === "" || quantity <= 0) {
        alert("Please enter a valid quantity.");
        return false;
    }

    return true;
}

// Simple Confirmation for Deleting an Order
function confirmDeleteOrder() {
    return confirm("Are you sure you want to delete this order?");
}

// Interactivity: Toggle Sidebar Visibility (Optional)
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');  // You can add CSS to hide/show the sidebar when it's active
}

// Show Password (Optional) - Useful for Login or Registration Forms
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggle-password');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.add('visible');  // Add a CSS class to change icon
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove('visible');
    }
}

// AJAX Request Example for Refreshing Content Without Reload (Optional)
function fetchOrders() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'view_orders.php', true);
    
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('order-list').innerHTML = this.responseText;
        } else {
            console.error("Failed to fetch orders.");
        }
    };

    xhr.send();
}

//form validation for feedback
function validateFeedbackForm() {
    const feedbackText = document.getElementById('feedback_text').value;
    const rating = document.getElementById('rating').value;

    if (feedbackText.trim() === '') {
        alert('Feedback text cannot be empty');
        return false;
    }
    
    if (rating < 1 || rating > 5) {
        alert('Rating must be between 1 and 5');
        return false;
    }

    return true;
}

//form validation for items
function validateItemForm() {
    const itemName = document.getElementById('item_name').value;
    const price = document.getElementById('price').value;

    if (itemName.trim() === '') {
        alert('Item name is required');
        return false;
    }
    
    if (price <= 0) {
        alert('Price must be greater than zero');
        return false;
    }

    return true;
}

