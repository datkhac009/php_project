<?php
require_once("database.php");
require_once("function.php");


$category_selected = find_all_category();
$row = mysqli_num_rows($category_selected);
for($i = 0; $i < $row; $i++) {
    $category_column = mysqli_fetch_assoc($category_selected);
    $category[$category_column["catid"]] = $category_column["catname"];
}

$product_selected = find_all_product();
$row = mysqli_num_rows($product_selected);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rynan Calender</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
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
                /* box-shadow: 5px 5px 8px #e7e7e7; */
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

            .dropdown-item.active {
                /* background: #b45a78 !important; */
                background: black !important;
                color: white;
            }
            /* end nav link */

        /* end nav  */

        /* carousel  */
        .carousel-inner .carousel-item:nth-child(1) {
            background: url("../img/photo5.png") no-repeat;
            background-size: cover;
        }

        .carousel-inner .carousel-item:nth-child(2) {
            background: url("../img/photo11.png") no-repeat;
            background-size: cover;
        }

        .carousel-inner .carousel-item:nth-child(3) {
            background: url("../img/photo.jpg") no-repeat;
            background-size: cover;
        }

        .carousel-item {
            height: 702px;
        }

        /* carousel */

        /* welcome */

        /* .container-fluid {
            border-bottom: 4px solid black;
            margin-top: 30px;
            margin-bottom: 40px;
        } */

        .welcome {
            margin-top: 30px;
            margin-bottom: 40px;
            border-bottom: 1px solid #ebe7e7;
        }

        .welcome h1{
            text-align: center;
            font-size: 50px;
            font-weight: bold;
        }

        .welcome-text {
            padding-bottom: 40px;
            font-size: 18px;
            text-indent: 30px;
            margin-top: 30px; 
        }
        /* end welcome */

        /* category */
        .category-item {
            display: inline-block;
            background: black;
            color: white;
            padding: 8px 16px;
            border: 2px solid black;
            border-radius: 20px;
            margin-left: 20px;
            width: 100px;
            text-align: center;
            font-weight: 600;
        }

        .category-item:first-child {
            margin-left: 0px;
        }

        .category-item:hover {
            text-decoration: none;
            color: white;
        }
        /* end category */

        /* footer  */
        .logo-footer {
            font-size: 60px;
            padding: 35px 0px 20px;
            /* font-family: 'Shadows Into Light Two', cursive; */
            font-family: 'Satisfy', cursive;
            text-align: center;
            display: inline-block;
            margin: 20px auto;
        }

        .footer {
            text-align: center;
            border-top: 1px solid #ebe7e7;
        }

        .footer .row:nth-child(2) {
            margin-bottom: 30px;
            border-bottom: 1px solid #ebe7e7;
            padding-bottom: 20px;
        }

        .copyright {
            text-align: center;
            
        }
        /* end footer */

        /* advantage */
        .advantage {
            margin-top: 100px;
            margin-bottom: 100px;
        }
        /* end advantage */

        /* product */
        .product-image {
            width: 100%;
            /* max-height: 353.328px; */
            height: 353.328px;
            /* height: auto; */
            object-fit: cover;
        }

        .product-info {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .col-xl-4 {
            box-sizing: border-box;
            font-size: 17px;
            margin-bottom: 15px;
        }

        .product-wrapper {
            margin-top: 50px;
            border-bottom: 1px solid #ebe7e7;
        }

        .product .row {
            padding: 10px;
        }

        .product-name {
            font-size: 17px;
            font-family: serif;
            text-transform: capitalize;
            margin-top: 10px;
            /* font-weight: 600; */
        }

        .product-name a {
            color: black;
            text-decoration: none;
        }

        .product-category {
            /* margin-top: 5px; */
            font-size: 16px;
            font-family: serif;
            opacity: 0.6;
            /* font-weight: 600; */
        }

        .product-price {
            font-size: 24px;
            font-family: 'Cormorant', serif;
            /* font-weight: 600; */
        }

        .currency {
            /* font-size: 18px; */
            margin-left: 2px;
        }

        /* product end*/
        
    </style>
</head>
<body>
    <!--nav-->
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
    <!--end nav-->

    <!--carousel-->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
          <li data-target="#carousel" data-slide-to="0" class="active"></li>
          <li data-target="#carousel" data-slide-to="1"></li>
          <li data-target="#carousel" data-slide-to="2"></li>
        </ul>
      
        <div class="carousel-inner">
          <div class="carousel-item active">
            <!-- <img src="img/photo5.png" alt="photo1"> -->
            <!-- <a href="#" class="buy-now">CONTACT US</a> -->
          </div>
          <div class="carousel-item">
            <!-- <img src="img/photo11.png" alt="photo2"> -->
          </div>
          <div class="carousel-item">
            <!-- <img src="img/photo10.png" alt="photo3"> -->
          </div>
        </div>
      
        <a class="carousel-control-prev" href="#carousel" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#carousel" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <!--end carousel-->

    <!-- welcome  -->
    <div class="container-fluid welcome">
        <div class="container">
            <h1>WELCOME</h1>
            <p class="welcome-text">Ryana Calendars is selling various Calendars and Diary products. The company
                advertises by distributing the pamphlets, advertising on television and so on. Due to
                rapid development in internet field, the company decides to launch a website where
                people will get all the information about the various products available with them
                easily.
            </p>
        </div>
    </div>
    <!-- end welcome  -->
    
    <!--category -->
    <div class="container category d-flex justify-content-center">
        <?php foreach($category as $key=>$value): ?>
            <a class="category-item" href="product.php?catid=<?php echo $key; ?>"><?php echo ucwords(strtolower($value)); ?></a>
        <?php endforeach; ?>
    </div>
    <!--end catgory-->

    <!--new arrivals-->
    <div class="container-fluid product-wrapper">
        <div class="container">
            <div class="row">
                <?php if($row !== 0): ?>
                    <?php 
                        for($i = 0; $i < $row; $i++): 
                        $product = mysqli_fetch_assoc($product_selected); 
                        $product_image = explode(" ", $product["image"]);
                    ?>
                    <div class="col-xl-4 col-lg-6 product">
                        <a href="detail_product.php?id=<?php echo $product["productid"]; ?>"><img src="<?php echo $product_image[0]; ?>" class="product-image" alt="<?php echo basename($product_image[0]); ?>"></a>
                        <ul class="product-info">
                            <li class="product-name"><a href="detail_product.php?id=<?php echo $product["productid"]; ?>"><?php echo $product["name"]; ?></a></li>
                            <li class="product-category">
                            <?php 
                                foreach($category as $key=>$value) {
                                    if($product["catid"] == $key) {
                                        echo ucwords(strtolower($value));
                                        break;
                                    }
                                }
                            ?></li>
                            <li class="product-price"><?php echo $product["price"]; ?><span class="currency">$</span></li>
                        </ul>
                    </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>

            <!-- <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <a href="product.php" class="more">More</a>
                </div>
            </div> -->
        </div>
    </div>
    <!--end new arrivals-->

    <!-- advantage -->
    <div class="container advantage">
        <div class="row">
            <div class="col-md d-flex align-self-stretch">
                <div class="media block-6 text-center d-block">
                    <div class="icon justify-content-center align-items-center d-flex">
                        <img src="https://img.icons8.com/material/48/000000/fast-cart.png"/>
                    </div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Express Delivery</h3>
                        <p>Our popular international express door-to-door delivery service is available when you’re sending
                            document or non-document shipments to anywhere around the world. Reliably fast to more global
                            destinations across a single integrated network than any other express delivery company</p>
                    </div>
                </div>      
            </div>


            <div class="col-md d-flex align-self-stretch">
                <div class="media block-6 text-center d-block">
                    <div class="icon justify-content-center align-items-center d-flex">
                        <img src="https://img.icons8.com/fluent-systems-filled/48/000000/guarantee.png"/>
                    </div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Guarantee</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit blanditiis, repudiandae vel culpa quis inventore? Eveniet, facilis! Quidem ullam cum ipsum repellat totam sed quo, perspiciatis incidunt, maiores aliquam quis!</p>
                    </div>
                </div>      
            </div>

            <div class="col-md d-flex align-self-stretch">
                <div class="media block-6 text-center d-block">
                    <div class="icon justify-content-center align-items-center d-flex">
                        <img src="https://img.icons8.com/material/48/000000/quill-with-ink.png"/>
                    </div>
                    <div class="media-body">
                        <h3 class="heading mb-3">Ink Riku</h3>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit deserunt nobis rerum, magnam hic dicta eius explicabo qui odit iste amet excepturi, minus ratione placeat voluptate soluta dignissimos facere recusandae.</p>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <!-- end advantage -->

    <!--footer-->
    <div class="container-fluid footer">
        <div class="row">
            <span class="logo-footer">Ryana Calendar</span>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h4>France</h4>
                <p>40 Baria Sreet 133/2 NewYork City, US<br>
                    Email: info.contact@gmail.<br>
                    Phone: 123-456-7890</p>
            </div>

            <div class="col-md-4">
                <h4>United States</h4>
                <p>40 Baria Sreet 133/2 NewYork City, US<br>
                    Email: info.contact@gmail.<br>
                    Phone: 123-456-7890</p>
            </div>

            <div class="col-md-4">
                <h4>Viet Nam</h4>
                <p>40 Baria Sreet 133/2 NewYork City, US<br>
                    Email: info.contact@gmail.<br>
                    Phone: 123-456-7890</p>
            </div>
        </div>

        <div class="row copyright">
            <p class="col-lg-12">Copyright @2021 All rights reserved | This website is made with <i class="far fa-heart"></i> by <a href="#">the brightest man</a></p>
        </div>
    </div>
    <!--end footer-->

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