<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Mate - Pricelist</title>
    <link rel="stylesheet" href="style.css" />
    <style type="text/css">
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.wrapper {
    
    margin: 50px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
   
    padding-top:50px;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;

}

.sidebar {
    width: 25%;
    background-color: #333;
    padding: 20px;
    border-radius: 10px;
    color: #fff;
}

.sidebar-item {
    margin-bottom: 20px;
    cursor: pointer;
}

.sidebar-item i {
    font-size: 24px;
    margin-right: 10px;
}

.sidebar-item span {
    font-size: 18px;
}

.pricelist {
    width:  75%;
    padding: 20px;
}

.pricelist-title {
    font-size: 24px;
    margin-bottom: 20px;
}

.pricelist-category {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.pricelist-category button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    border-radius: 5px;
    border: 1px solid #DDDDDD;
    cursor: pointer;
}

.pricelist-category button.active {
    background-color: #FFC107;
            color: #FFFFFF;
}

.pricelist-items {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.price-list-item {
    display: inline-table;
    width: 25%;
    margin-bottom: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

}

.price-list-item img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
}

.price-list-item h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.price-list-item p {
    font-size: 16px;
    color: #666;
}
    </style>
</head>
<body>
    <header>
        <nav>
        <div class="nav_logo">
          <a href="#">
            <img src="images/CleanWave_logo.png" alt="Coffee Logo" />
            <h2>CleanWave</h2>
          </a>
        </div>

        <input type="checkbox" id="click" />
        <label for="click">
          <i class="menu_btn bx bx-menu"></i>
          <i class="close_btn bx bx-x"></i>
        </label>

        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#service">Services</a></li>
          <li><a href="#why">Why Us</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav>
    </header>
    <div class="wrapper">
        <div class="container">
        <div class="sidebar">
            <div class="sidebar-item">
             <i class="fas fa-file-alt pricelist-item-icon"></i>
            <span>WASH + FOLD</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-tshirt pricelist-item-icon"></i>
            <span>WASH + IRON</span>
        </div>
        <div class="sidebar-item">
            <i class="fas fa-tshirt pricelist-item-icon"></i>
            <span>DRY CLEAN</span>
        </div>
        <div class="sidebar-item">
               <i class="fas fa-utensil-spoon pricelist-item-icon"></i>
               <span>STEAM IRON</span>
        </div>
        <div class="sidebar-item">
           <i class="fas fa-star pricelist-item-icon"></i>
           <span>STAIN CLEAR</span>
        </div>
        </div>

        <div class="pricelist">
            <h2 class="pricelist-title">Pricelist</h2>
            <div class="pricelist-category">
                <button data-category="men" class="active">MEN</button>
                <button data-category="women">WOMEN</button>
                <button data-category="kids">KIDS</button>
                <button data-category="household">HOUSEHOLD</button>
            </div>


            
              <div class="price-items">
                <div class="category-section" id="wash-fold">
                    </div>

                <div class="category-section" id="wash-iron"> 
                    </div>

                <div class="category-section" id="dry-clean"> 
                    </div>

                <div class="category-section" id="steam-iron">
                    </div>

                <div class="category-section" id="stain-clear"> 
                    </div>



            <div class="pricelist-items" id="priceList"></div>
        </div>
    </div>
</div>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
    <script>
        const categoryButtons = document.querySelectorAll('.pricelist-category button');
        const priceList = document.querySelector('#priceList');

        // Function to generate price list items
        function generatePriceList(category) {
            priceList.innerHTML = '';
            priceListItems[category].forEach((item) => {
                const priceListItem = document.createElement('div');
                priceListItem.className = 'price-list-item';
                priceListItem.innerHTML = `
                    <img src="${item.icon}" alt="${item.name}">
                    <h3>${item.name}</h3>
                    <p>${item.price}</p>
                `;
                priceList.appendChild(priceListItem);
            });
        }

        // Add event listener to sidebar items
        const sidebarItems = document.querySelectorAll('.sidebar-item');
        sidebarItems.forEach((item) => {
            item.addEventListener('click', () => {
                const category = item.getAttribute('data-category');
                generatePriceList(category);
            });
        });

        // Add event listener to category buttons
        categoryButtons.forEach((button) => {
            button.addEventListener('click', () => {
                categoryButtons.forEach((btn) => btn.classList.remove('active'));
                button.classList.add('active');
                generatePriceList(button.dataset.category);
            });
        });

        // Generate price list for the first category by default
        generatePriceList('men');
    </script>
</body>
</html>-->




<?php
include('includes/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanWave - Services & Pricelist</title>
    <link rel="stylesheet" href="style.css" />
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .sidebar {
            width: 25%;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            color: #fff;
        }

        .sidebar-item {
            margin-bottom: 20px;
            cursor: pointer;
        }

        .sidebar-item i {
            font-size: 24px;
            margin-right: 10px;
        }

        .sidebar-item span {
            font-size: 18px;
        }

        .pricelist {
            width: 75%;
            padding: 20px;
        }

        .pricelist-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .pricelist-category {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .pricelist-category button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        .pricelist-category button.active {
            background-color: #FFC107;
            color: #FFFFFF;
        }

        .pricelist-items {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .price-list-item {
            width: 30%;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .price-list-item h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .price-list-item p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav_logo">
                <a href="#">
                    <img src="assets/images/CleanWave_logo.png" alt="CleanWave Logo" />
                    <h2>CleanWave</h2>
                </a>
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="wrapper">
        <div class="container">
            <div class="sidebar">
                <div class="sidebar-item">
                    <i class="fas fa-tshirt"></i>
                    <span>Wash + Fold</span>
                </div>
                <div class="sidebar-item">
                    <i class="fas fa-tshirt"></i>
                    <span>Wash + Iron</span>
                </div>
                <div class="sidebar-item">
                    <i class="fas fa-tshirt"></i>
                    <span>Dry Clean</span>
                </div>
                <div class="sidebar-item">
                    <i class="fas fa-steam"></i>
                    <span>Steam Iron</span>
                </div>
                <div class="sidebar-item">
                    <i class="fas fa-star"></i>
                    <span>Stain Clear</span>
                </div>
            </div>

            <div class="pricelist">
                <h2 class="pricelist-title">Service Pricelist</h2>
                <div class="pricelist-category">
                    <button data-category="men" class="active">MEN</button>
                    <button data-category="women">WOMEN</button>
                    <button data-category="kids">KIDS</button>
                    <button data-category="household">HOUSEHOLD</button>
                </div>

                <div class="pricelist-items" id="priceList"></div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryButtons = document.querySelectorAll('.pricelist-category button');
            const priceList = document.querySelector('#priceList');

            // Function to fetch and display items
            function generatePriceList(category) {
                priceList.innerHTML = ''; // Clear existing items

                // Fetch data from the server
                fetch('fetch_items.php')
                    .then(response => response.json())
                    .then(items => {
                        const filteredItems = items.filter(items => item.category.toLowerCase() === category.toLowerCase());

                        if (filteredItems.length === 0) {
                            priceList.innerHTML = '<p>No items available for this category.</p>';
                        } else {
                            filteredItems.forEach(items => {
                                const priceListItem = document.createElement('div');
                                priceListItem.className = 'price-list-item';
                                priceListItem.innerHTML = `
                                    <h3>${item.item_name}</h3>
                                    <p>Service: ${item.service_type}</p>
                                    <p>Price: ₹${item.price}</p>
                                `;
                                priceList.appendChild(priceListItem);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching items:', error));
            }

            // Add event listener to category buttons
            categoryButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    categoryButtons.forEach((btn) => btn.classList.remove('active'));
                    button.classList.add('active');
                    generatePriceList(button.dataset.category);
                });
            });

            // Generate price list for the first category by default
            generatePriceList('men');
        });
    </script>
</body>
</html>
