<!DOCTYPE html>


<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CleanWave|Assna VS</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="style.css" />
    <!-- Box Icon Link for Icons -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Header & Navbar Section -->
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
          

          <li><a href="#" class="login-btn" onclick="showLoginForm()">Login</a></li>
          <li><a href="#" class="signup-btn" onclick="showSignupForm()">Sign Up</a></li>
          <?php
                session_start();
                if (isset($_SESSION['username']) && $_SESSION['role'] == 'user') {
            ?>
                <div class="profile-icon-container">
                <button class="profile-icon"></button>
                <ul class="dropdown-menu">
                    <li><a href="profile.php">My Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
                </div>
            <?php
            }
            ?>



        </ul>
      </nav>
    </header>

    <!-- Hero Section -->



    <!-- Login Form -->
<div class="login-form" id="login-form" style="display: none;">
  <form action="login.php" method="POST">
    <h1>LogIn</h1>
    <br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" placeholder=" email"  required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="login" id="login" name="login">
  </form> 

</div>
  
<script>
function validateForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Check if username is a valid email format
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(username)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Check if password is at least 6 characters long
    if (password.length < 3) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    return true; // Form is valid
}
</script>

  <!-- Signup Form -->
<div class="signup-form" id="signup-form" style="display: none;">
  <form action="signup.php" method="POST">
    <h1>SignUp</h1>
    <label for="username">Username:</label>
    <input type="email" id="username" name="username" placeholder="enter email"  required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <label for="cpassword">Confirm Password:</label>
    <input type="password" id="cpassword" name="cpassword" required>
    <input type="checkbox" id="checkbox">
    <label for="checkbox">By continuing, I agree to the Terms and Conditions and Privacy Policy of CleanWave.</label>
    <input type="submit" value="signup" id="signup" name="signup">
  </form>


</div>

</body>


<script>
  function showLoginForm() {
    document.getElementById("login-form").style.display = "block";
    document.getElementById("signup-form").style.display = "none";
  }

  function showSignupForm() {
    document.getElementById("signup-form").style.display = "block";
    document.getElementById("login-form").style.display = "none";
  }
</script>

    <section class="hero_section">
      <div class="section_container">
        <div class="hero_container">
          <div class="text_section">
            <h2>Welcome to CleanWave</h2>
            <h3>- Your Trusted Laundry Partner </h3>
            <p>
             Experience the Best in Laundry Care and Community Support
            </p>

            <div class="hero_section_button">
              
              <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'user')  { ?>   
              <a href="service.php" class="button">Book Slot</a>
              <?php }
               else { ?>
                    <a href="#" class="button" onclick="alert('Please log in to make bookings.');">Book Slot</a>
                <?php } ?>
              <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'user')  { ?>   
                <a href="add_feedback.php" class="button">Feedback</a>
                 <?php }
              else { ?>
                    <a href="#" class="button" onclick="alert('Please log in to give feedbacks.');">Feedback</a>
                <?php } ?>

            </div>
             </div>
         
          <div class="image_section">
            <img src="images/CleanWave_logo.png" alt="Coffee" />
          </div>
        </div>

      </div>
    </section>

    <!-- About Us Section -->
    <section class="about_us" id="about">
      <div class="section_container">
        <div class="about_container">
          <div class="text_section">
            <h2 class="section_title">About Us</h2>
            <p>
              Welcome to CleanWave, your trusted partner in laundry and clothes donation services. At CleanWave, we are dedicated to providing a seamless and efficient laundry experience, ensuring your clothes are treated with the utmost care. Our user-friendly platform allows you to easily book slots for laundry cleaning and donate used or old clothes to those in need. We believe in making a positive impact on our community by promoting cleanliness and sustainability. Join us in our mission to create a cleaner, more compassionate world, one load of laundry at a time.
            </p>
          </div>

          <div class="image_section">
            <img src="images/w1.jpg" alt="coffee" />
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="service">
      <h2 class="section_title">Our Services</h2>
      <div class="section_container">
        <div class="service_container">
          <div class="services_items">
            <img src="images/c1.png" alt="Hot Beverages" />
            <div class="services_text">
              <h3>Wash + Fold</h3>
              <p>
                Enjoy freshly washed and neatly folded clothes, ready to wear or store.
              </p>
            </div>
          </div>
          <div class="services_items">
            <img src="images/c2.png" alt="Cold Beverages" />
            <div class="services_text">
              <h3>Wash + Iron</h3>
              <p>
                Get your clothes washed and perfectly ironed for a crisp, professional look.
              </p>
            </div>
          </div>
          <div class="services_items">
            <img src="images/c3.png" alt="Refreshment" />
            <div class="services_text">
              <h3>Dry Clean</h3>
              <p>Specialized cleaning for delicate fabrics and garments, ensuring they look their best.</p>
            </div>
          </div>
          <div class="services_items">
            <img src="images/c4.png" alt="Special Combos" />
            <div class="services_text">
              <h3>Steam Iron</h3>
              <p>
                Professional steam ironing to remove wrinkles and refresh your clothes.
              </p>
            </div>
          </div>
          <div class="services_items">
            <img
              src="images/c5.png"
              alt="Burger & French Fries"
            />
            <div class="services_text">
              <h3>Stain Clear</h3>
              <p>Effective treatment to remove tough stains and restore your clothes to their original condition.</p>
            </div>
          </div>
          <div class="services_items">
            <img src="images/c6.png" alt="Desserts" />
            <div class="services_text">
              <h3>DONATION!</h3>
              <p>
                Donate your used or old clothes to those in need, making a positive impact on the community.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Us Section -->
    <section class="why_us" id="why">
      <h2 class="section_title">Why Us?</h2>
      <div class="section_container">
        <div class="why_container">
          <div class="why_items">
            <img src="images/s1.png" alt="Delicious" />
            <div class="why_us_text">
              <h3>Quality Service</h3>
              <p>
                 We ensure your clothes are treated with the utmost care, using high-quality detergents and advanced cleaning techniques.
              </p>
            </div>
          </div>
          <div class="why_items">
            <img src="images/s2.png" alt="Pleasant" />
            <div class="why_us_text">
              <h3>Affordable Prices</h3>
              <p>
                Enjoy top-notch laundry services at competitive prices.
              </p>
            </div>
          </div>
          <div class="why_items">
            <img src="images/s3.png" alt="Hospitality" />
            <div class="why_us_text">
              <h3>Customer Satisfaction</h3>
              <p>
               We prioritize your satisfaction and strive to exceed your expectations with every service.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery" id="gallery">
      <h2 class="section_title">Gallery</h2>
      <div class="section_container">
        <div class="gallery_container">
          <div class="gallery_items">
            <img src="images/g1.jpg" alt="Gallery Image" />
          </div>
          <div class="gallery_items">
            <img src="images/g2.jpg" alt="Gallery Image" />
          </div>
          <div class="gallery_items">
            <img src="images/g3.jpg" alt="Gallery Image" />
          </div>
          <div class="gallery_items">
            <img src="images/g4.jpg" alt="Gallery Image" />
          </div>
          <div class="gallery_items">
            <img src="images/g5.jpg" alt="Gallery Image" />
          </div>
          <div class="gallery_items">
            <img src="images/g6.jpg" alt="Gallery Image" />
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section 
    <section class="contact" id="contact">
      <h2 class="section_title">Contact Us</h2>
      <div class="section_container">
        <div class="contact_container">
          <div class="contact_form">
            <form action="#">
              <div class="field">
                <label for="Name">Full Name</label>
                <input type="text" id="Name" placeholder="Your Name" required />
              </div>
              <div class="field">
                <label for="email">Your Email</label>
                <input
                  type="text"
                  id="email"
                  placeholder="Your Email"
                  required
                />
              </div>
              <div class="field">
                <label for="number">Your Number</label>
                <input
                  type="number"
                  id="number"
                  placeholder="Your Contact Number"
                  required
                />
              </div>
              <div class="field">
                <label for="textarea">Message</label>
                <textarea
                  name="textarea"
                  id="textarea"
                  placeholder="Your Message"
                ></textarea>
              </div>

              <button class="button" id="submit">Submit</button>
            </form>
          </div>

          <div class="contact_text">
            <div class="contact_items">
              <i class="bx bx-current-location"></i>
              <div class="contact_details">
                <h3>Our Location</h3>
                <p>Kerela, India</p>
              </div>
            </div>
            <div class="contact_items">
              <i class="bx bxs-envelope"></i>
              <div class="contact_details">
                <h3>General Enquries</h3>
                <p>cleanwave@xyz.com</p>
              </div>
            </div>
            <div class="contact_items">
              <i class="bx bxs-phone-call"></i>
              <div class="contact_details">
                <h3>Call Us</h3>
                <p>+91 9076459817</p>
              </div>
            </div>
            <div class="contact_items">
              <i class="bx bxs-time-five"></i>
              <div class="contact_details">
                <h3>Our Timing</h3>
                <p>Mon-Sat : 10:00 AM - 7:00 PM</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->

    <!-- Footer Section -->
    <footer>
      <div class="section_container">
        <div class="footer_section">
          <div class="footer_logo">
            <a href="index.html">
              <img src="images/CleanWave_logo.png" alt="Coffee Logo" />
              <h2>CleanWave</h2>
            </a>
          </div>

          <div class="useful_links">
            <h3>Useful Links</h3>
            <ul>
              <li><a href="#about">About</a></li>
              <li><a href="#service">Services</a></li>
              <li><a href="#why">Why Us</a></li>
              <li><a href="#gallery">Gallery</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div>

          <div class="contact_us">
            <h3>Contact</h3>
            <ul>
              <li>
                <i class="bx bx-current-location"></i>
                <span>Kerela, India</span>
              </li>
              <li>
                <i class="bx bxs-phone-call"></i> <span>+91 9076459817</span>
              </li>
              <li>
                <i class="bx bxs-time-five"></i>
                <span>Mon-Sat : 10:00 AM - 7:00 PM</span>
              </li>
            </ul>
          </div>

         <!-- <div class="follow_us">
            <h3>Follow</h3>
            <i class="bx bxl-facebook-circle"></i>
            <i class="bx bxl-twitter"></i>
            <i class="bx bxl-instagram-alt"></i>
          </div>-->
        </div>
      </div>
    </footer>
    <script>
      const profileIcon = document.querySelector('.profile-icon');
if (profileIcon) {
    profileIcon.addEventListener('click', function() {
        // Toggle dropdown menu
        document.querySelector('.dropdown-menu').classList.toggle('show');
    });
} else {
    console.warn("Profile icon not found, dropdown functionality will be disabled.");
}
    </script>
  </body>
</html>
