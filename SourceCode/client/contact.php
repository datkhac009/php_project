<?php
require_once("database.php");
require_once("function.php");


$category_selected = find_all_category();
$row = mysqli_num_rows($category_selected);
for($i = 0; $i < $row; $i++) {
    $category_column = mysqli_fetch_assoc($category_selected);
    $category[$category_column["catid"]] = $category_column["catname"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@1,500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <style>
         * {
            margin: 0;
            padding: 0;
        }
        
        /* nav */
            /* search  */
            input[type="text"] {
                outline: none;
                width: 100%;
                border: 1px solid #dddddd;
                padding: 5px 30px 5px 10px;
                font-size: 16px;
                border-radius: 20px;
            }

            input[type="text"]::placeholder {
                opacity: 0.6;
                font-size: 13px;
            }

            .search-field {
                padding: 5px;
                position: relative;
            } 

            .search-icon {
                position: absolute;
                right: 18px;
                top: 14px;
                text-align: center;
                border: none;
                font-size: 13px;
                color: #888;
                background: transparent;
            }

            /* end search  */

            /* nav link */
            .nav-link, .navbar-brand {
                color: black;
            }

            .nav-link:hover, .navbar-brand:hover {
                color: black;
            }

            .nav-item {
                margin-left: 10px;
                font-weight: bold;
            }

            nav {
                border-bottom: 1px solid #e7e7e7;
            }

            .dropdown-menu {
                border: 0;
                padding: 0;
                /* box-shadow: 5px 5px 20px lightgray; */
            }

            .dropdown-item {
                font-weight: 500;
            }

            .dropdown-item:active {
                /* background: #b45a78 !important; */
                background: black !important;
            }

            .navbar-brand {
                font-family: 'Satisfy', cursive;
                font-size: 30px;
                font-weight: 650;
                margin-left: 30px;
            }

            /* .collapse .active {
                border-bottom: 2px solid #b45a78;
            } */

            .dropdown-item.active {
                /* background: #b45a78 !important; */
                background: black !important;
                color: white;
            }
            /* end nav link */

        /* end nav */


        /* banner */
            .banner {
                background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url("img/banner.png");
                padding: 60px;
            }

            .banner-content {
                color: white;
                font-size: 50px;
                font-family: serif;
            }

        /* banner ends */

        /* breadcrumb */
        .breadcrumb {
            /* padding: 0; */
            margin-top: 10px;
            background: white;
        }

        .breadcrumb-item a {
            color: black !important;
            /* text-decoration: none; */
        }
        /* breadcrumb end */

        /* map */
        .map {
            width: 100%;
            height: 500px;
            border-radius: 10px;
        }
        img{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        /* end map */

        /* contact */
        .contact {
            margin-top: 100px;
            padding: 40px;
            border-top: 1px solid #c3c3c3;
        }

        .contact-title, .contact-content {
            text-align: center;
        }

        .contact-title {
            font-size: 30px;
        }

        .logo-contact {
            font-size: 60px;
            /* padding: 35px 0px 20px; */
            font-family: 'Satisfy', cursive;
            text-align: center;
            display: inline-block;
            margin: auto;
            margin-bottom: 70px;
        }
        /* end contact */
    </style>
</head>
<body>
    <!-- logo~navbar -->
    <nav class="navbar navbar-expand-lg">
        <a href="home.php" class="navbar-brand">Ryana Calendar</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse">
            <i class="fas fa-align-justify"></i>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapse">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Categories</a>
                <div class="dropdown-menu">
                <!-- php -->
                <?php foreach($category as $key=>$value): ?>
                    <a class="dropdown-item" href="product.php?catid=<?php echo $key; ?>"><?php echo ucwords(strtolower($value)); ?></a>
                <?php endforeach; ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="list_price.php">List Price</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
                <form action="search.php" method="get" class="search-field">
                    <input type="text" name="search" placeholder="Search Anything..." class="input-type">
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>    
                </form>
            </li>
            </ul>
        </div>
    </nav>
    <!-- end logo~navbar -->
    
    <!-- banner -->
    <div class="container-fluid d-flex justify-content-center align-items-center banner">
        <p class="banner-content">
            Contact
        </p>
    </div>
    <!-- banner ends -->

    <!-- breadcrumb  -->
    <div class="container" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php"><i class="fas fa-home"></i>&nbsp;Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </div>
    <!-- breadcrumb end -->

    <!-- map -->
    <div class="container">
        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9264332714597!2d105.81676191540234!3d21.03562939291856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0d6e603741%3A0x208a848932ac2109!2sAptech%20Computer%20Education!5e0!3m2!1svi!2s!4v1621064503886!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>    
    </div>

    <address class="container-fluid contact">
        <div class="row">
            <span class="logo-contact">Ryana Calendar</span>
        </div>

        <div class="row">
            <div class="col">
                <img src="https://img.icons8.com/material-outlined/48/000000/map--v1.png"/>
                <h3 class="contact-title">Location</h3>
                <p class="contact-content">
                    40 Baria Sreet 133/2 NewYork City, US<br>
                    40 Baria Sreet 133/2 NewYork City, US<br>
                    40 Baria Sreet 133/2 NewYork City, US
                </p>
            </div>
            <div class="col">
                <img src="https://img.icons8.com/material-sharp/48/000000/phone-not-being-used.png"/>
                <h3 class="contact-title">Telephone</h3>
                <p class="contact-content"><a href="tel">123-456-7890</a><br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum, nisi molestias eveniet rem esse aliquid quod molestiae accusamus consectetur quam tenetur id, magni eius dolorum! Unde sint excepturi eius dolorum?</p>
            </div>
            <div class="col">
                <img src="https://img.icons8.com/material-sharp/48/000000/new-post.png"/>
                <h3 class="contact-title">Mail</h3>
                <p class="contact-content"><a href="mailto:info.contact@gmail">info.contact@gmail</a><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, tempore. Facilis, laboriosam necessitatibus sit expedita minus optio. Dolorum qui accusamus atque aperiam, pariatur odit iste necessitatibus veniam beatae in voluptas.</p>
            </div>
        </div>
    </address>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.js"></script>
    <script>
        $("form").submit(function() {
            if($(".input-type").val() == "") {
                return false;
            }

            return true;
        })
    </script>
</body>
</html>

<?php disconnect($con); ?>