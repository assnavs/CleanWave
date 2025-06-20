<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard | CleanWave</title>
    <style>
        /* CSS code goes here */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        /* ... rest of the CSS code ... */
        .wrapper{
              height: 100%;
              width: 300px;
              position: relative;
              background: #81007f; /* updated */

            }
            .wrapper .menu-btn{
              position: absolute;
              left: 20px;
              top: 10px;
              background: #660066;
              color: #ffffff;
              height: 45px;
              width: 45px;
              z-index: 9999;
              border: 1px solid #333;
              border-radius: 5px;
              cursor: pointer;
              display: flex;
              align-items: center;
              justify-content: center;
              transition: all 0.3s ease;
            }
            #btn:checked ~ .menu-btn{
              left: 247px;
            }
            .wrapper .menu-btn i{
              position: absolute;
              transform: ;
              font-size: 23px;
              transition: all 0.3s ease;
            }
            .wrapper .menu-btn i.fa-times{
              opacity: 0;
            }
            #btn:checked ~ .menu-btn i.fa-times{
              opacity: 1;
              transform: rotate(-180deg);
            }
            #btn:checked ~ .menu-btn i.fa-bars{
              opacity: 0;
              transform: rotate(180deg);
            }
            #sidebar{
              position: fixed;
              background: #990099;
              height: 100%;
              width: 270px;
              overflow: hidden;
              left: -270px;
              transition: all 0.3s ease;
            }
            #btn:checked ~ #sidebar{
              left: 0;
            }
            #sidebar .title{
              line-height: 65px;
              text-align: center;
              background: #660066;
              font-size: 25px;
              font-weight: 600;
              color: #ffffff;
              border-bottom: 1px solid #333;
            }
            #sidebar .list-items{
              position: relative;
              background: #660066;
              width: 100%;
              height: 100%;
              list-style: none;
            }
            #sidebar .list-items li{
              padding-left: 40px;
              background: #81007f;
              line-height: 50px;
              border-top: 1px solid rgba(255,255,255,0.1);
              border-bottom: 1px solid #333;
              transition: all 0.3s ease;
            }
            #sidebar .list-items li:hover{
              border-top: 1px solid transparent;
              border-bottom: 1px solid transparent;
              box-shadow: 0 0px 10px 3px #222;
            }
            #sidebar .list-items li:first-child{
              border-top: none;
              background: #81007f;

            }
            
            #sidebar .list-items li a{
              color: #ffffff;
              background: #81007f;
              text-decoration: none;
              font-size: 18px;
              font-weight: 500;
              height: 100%;
              width: 100%;
              display: block;
            }
            #sidebar .list-items li a i{
              margin-right: 20px;
              background:#81007f;
            }
            #sidebar .list-items .icons{
              width: 100%;
              height: 40px;
              text-align: center;
              position: absolute;
              bottom: 100px;
              line-height: 40px;
              display: flex;
              align-items: center;
              justify-content: center;
            }
            #sidebar .list-items .icons a{
              height: 100%;
              width: 40px;
              display: block;
              margin: 0 5px;
              font-size: 18px;
              color: #ffffff;
              background: #660066;
              border-radius: 5px;
              border: 1px solid #383838;
              transition: all 0.3s ease;
            }
            #sidebar .list-items .icons a:hover{
              background: #404040;
            }
            .list-items .icons a:first-child{
              margin-left: 0px;
            }
            .content{
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%,-50%);
              color: #202020;
              z-index: -1;
              width: 100%;
              text-align: center;
            }
            .content .header{
              font-size: 45px;
              font-weight: 700;
              color: #81007f;
            }
            .content p{
              font-size: 40px;
              font-weight: 700;
              color: #81007f;
            }

    </style>
</head>
<body>
    <!-- HTML code goes here -->
    <div class="wrapper">
        <!-- ... rest of the HTML code ... -->
        <input type="checkbox" id="btn" hidden>
      <label for="btn" class="menu-btn">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
      </label>
      <nav id="sidebar">
        <div class="title">Side Menu</div>
        <ul class="list-items">
          <!--<li><a href="admin.php"><i class="fas fa-home"></i>Dashboard</a></li>-->
          <li><a href="manage_users"><i class="fas fa-sliders-h"></i>Manage User</a></li>
          <li><a href="manage_orders"><i class="fas fa-address-book"></i>Manage order</a></li>
          <li><a href="manage_services"><i class="fas fa-cog"></i>Manage Services</a></li>
          <li><a href="manage_items"><i class="fas fa-globe-asia"></i>Manage items</a></li>
          <li><a href="manage_donations"><i class="fas fa-stream"></i>Manage Donations</a></li>
          <li><a href="manage_feedback"><i class="fas fa-user"></i>Manage feedback</a></li>
          <li><a href="report"><i class="fas fa-globe-asia"></i>Report</a></li>
          <li><a href="monthly_report"><i class="fas fa-envelope"></i>Monthly Report</a></li>
          <!--<div class="icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>-->
        </ul>
      </nav>
    </div>
    <div class="content">
      <div class="header">CleanWave </div>
      <p>admin dashboard</p>
    </div>
</body>
</html>
