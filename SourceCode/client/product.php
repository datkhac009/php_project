<?php
require_once("database.php");
require_once("function.php");


$category_selected = find_all_category();
$row = mysqli_num_rows($category_selected);
for($i = 0; $i < $row; $i++) {
    $category_column = mysqli_fetch_assoc($category_selected);
    $category[$category_column["catid"]] = $category_column["catname"];
}

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["catid"]) && !empty($_GET["catid"])) {
        $product_by_catid = find_product_by_category($_GET["catid"]);
    }else redirect_to("home.php");
}

$product_row = mysqli_num_rows($product_by_catid);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
    <?php 
        foreach($category as $key=>$value) {
            if($_GET["catid"] == $key) {
                echo ucwords(strtolower($value));
                break;
            }
        }
    ?>
    </title>
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
                box-shadow: 5px 5px 8px #e7e7e7;
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

            .collapse .active {
                /* border-bottom: 2px solid #b45a78; */
            }

            .dropdown-item.active {
                /* background: #b45a78 !important; */
                background: black !important;
                color: white;
            }
            /* end nav link */

        /* end nav  */

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

        .row {
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
            /* font-family: 'Cormorant', serif; */
            /* font-weight: 600; */
        }

        .currency {
            /* font-size: 18px; */
            margin-left: 2px;
        }

        /* product end*/

        /* breadcrumb */
        .breadcrumb {
            /* padding: 0; */
            background: white;
        }

        .breadcrumb-item a {
            color: black !important;
            /* text-decoration: none; */
        }
        /* breadcrumb end */


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
                    <?php if($_GET["catid"] == $key): ?>
                        <a class="dropdown-item active" href="product.php?catid=<?php echo $key; ?>"><?php echo ucwords(strtolower($value)); ?></a>
                    <?php else: ?><a class="dropdown-item" href="product.php?catid=<?php echo $key; ?>"><?php echo ucwords(strtolower($value)); ?></a>
                    <?php endif; ?>
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

    <!-- breadcrumb  -->
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">
            <?php 
                foreach($category as $key=>$value) {
                    if($_GET["catid"] == $key) {
                        echo ucwords(strtolower($value));
                        break;
                    }
                }
            ?>
            </li>
        </ol>
    </div>
    <!-- breadcrumb end -->

    <!-- product -->
    <div class="container">
        <div class="row">
            <?php 
                for($i = 0; $i < $product_row; $i++): 
                $product = mysqli_fetch_assoc($product_by_catid); 
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
                    <li class="product-price"><span class="currency">$</span><?php echo $product["price"]; ?></li>
                </ul>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <!-- product end -->

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

<?php disconnect($con); ?>