<?php
require_once("database.php");
require_once("function.php");


$category_selected = find_all_category();
$row = mysqli_num_rows($category_selected);
for($i = 0; $i < $row; $i++) {
    $category_column = mysqli_fetch_assoc($category_selected);
    $category[$category_column["catid"]] = $category_column["catname"];
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

}else {
    if(isset($_GET["id"]) && !empty($_GET["id"])) {
        $product = find_product_by_id($_GET["id"]);
    }else redirect_to("home.php");
}

$image = explode(" ", $product["image"]);

$related_product = search($product["name"]);
$related_count = mysqli_num_rows($related_product);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product["name"]; ?></title>
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

            .collapse .active {
                /* border-bottom: 2px solid #b45a78; */
            }

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

        /* carousel */
        .carousel-inner img {
            height: 450px;
            width: 100%;
            object-fit: cover;
        }

        /* carousel ends */

        /* product */
        .product-info {
            padding: 50px 15px;
            font-family: serif;
        }

        .product-name {
            font-size: 28px;
        }

        .product-description {
            
        }

        .product-dimension {
            width: 100%;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 4;
            overflow: hidden;
        }

        .product-price {
            font-size: 30px;
        }

        .product-order {
            background: black;
            color: white;
            display: inline-block;
            padding: 10px 16px;
            border-radius: 10px;   
        }

        .product-order:hover {
            color: white;
            text-decoration: none;
        }

        /* product ends */

        /* related products */
        .related-image {
            width: 100%;
            /* max-height: 353.328px; */
            height: 353.328px;
            /* height: auto; */
            object-fit: cover;
        }

        .related-info {
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

        .related-name {
            font-size: 17px;
            font-family: serif;
            text-transform: capitalize;
            margin-top: 10px;
            /* font-weight: 600; */
        }

        .related-name a {
            color: black;
            text-decoration: none;
        }

        .related-category {
            /* margin-top: 5px; */
            font-size: 16px;
            font-family: serif;
            opacity: 0.6;
            /* font-weight: 600; */
        }

        .related-price {
            font-size: 24px;
            /* font-family: 'Cormorant', serif; */
            /* font-weight: 600; */
        }

        .currency {
            /* font-size: 18px; */
            margin-left: 2px;
        }

        .related-title {
            text-align: center;
            font-size: 35px;
            /* font-family: serif; */
            font-weight: 600;
            margin: 30px 0px;
        }

        /* end related products */


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

        /* expand */    
            .expand-title {
                font-size: 40px;
                border-bottom: 1px solid #ebe7e7;
                width: 100%;
            }
        /* expand end */
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
                    <?php if($product["catid"] == $key): ?>
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
    
    <!-- banner -->
    <div class="container-fluid d-flex justify-content-center align-items-center banner">
        <p class="banner-content">
            <?php 
                foreach($category as $key=>$value) {
                    if($product["catid"] == $key) {
                        echo ucwords(strtolower($value));
                    }
                }
            ?>
        </p>
    </div>
    <!-- banner ends -->

    <!-- breadcrumb  -->
    <div class="container" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php"><i class="fas fa-home"></i>&nbsp;Home</a></li>
            <li class="breadcrumb-item"><a href="#">Categories</a></li> 
            <li class="breadcrumb-item">
                <a href="product.php?catid=<?php echo $product["catid"]; ?>">
                <?php 
                    foreach($category as $key=>$value) {
                        if($product["catid"] == $key) {
                            echo ucwords(strtolower($value));
                            break;
                        }
                    }
                ?>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $product["name"]; ?></li>
        </ol>
    </div>
    <!-- breadcrumb end -->

    <!-- product -->
    <div class="container product">
        <div class="row">
            <div class="col-md-7 carousel slide" id="product-image" data-ride="carousel">

                <ul class="carousel-indicators">
                    <?php for($i = 0; $i < count($image); $i++): ?>
                        <?php if($i == 0): ?>
                        <li data-target="#product-image" data-slide-to="<?php echo $i; ?>" class="active"></li>
                        <?php else: ?>
                        <li data-target="#product-image" data-slide-to="<?php echo $i; ?>"></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>

                <div class="carousel-inner">
                    <?php for($i = 0; $i < count($image); $i++): ?>
                        <?php if($i == 0): ?>
                        <div class="carousel-item active">
                            <img src="<?php echo $image[$i]; ?>" class="img-fluid" alt="<?php echo basename($image[$i]); ?>">
                        </div>
                        <?php else: ?>
                        <div class="carousel-item">
                            <img src="<?php echo $image[$i]; ?>" class="img-fluid" alt="<?php echo basename($image[$i]); ?>">
                        </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

                <a class="carousel-control-prev" href="#product-image" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#product-image" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <div class="col-md-5 product-info">
                <p class="product-name"><?php echo $product["name"]; ?></p>
                <!-- <p class="product-dimension"><?php //echo $product["dimension"]; ?></p> -->
                <p class="product-price"><span class="currency">$</span><?php echo $product["price"]; ?></p>
                <a href="contact.php" class="product-order">Order Now</a>
            </div>

        </div>

        <div class="row expand">
            <p class="expand-title">Description</p>
            <p class="expand-content"><?php echo $product["description"]; ?></p>
            <p class="expand-content"><?php echo $product["material"]; ?></p>
            <p class="expand-title">Dimension</p>
            <p class="expand-content"><?php echo $product["dimension"]; ?></p>
        </div>
    </div>
    <!-- product ends -->

    <!-- related product -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 related">
                <p class="related-title">RELATED PRODUCTS</p>        
            </div>
            
            <?php 
            for($i = 0; $i < $related_count; $i++):
                $related_column = mysqli_fetch_assoc($related_product);
                $related_image = explode(" ", $related_column["image"]);
            ?>
            <div class="col-xl-4 col-lg-6 related-product">
                <a href="detail_product.php?id=<?php echo $related_column["productid"]; ?>">
                    <img src="<?php echo $related_image[0]; ?>" alt="<?php echo basename($related_image[0]); ?>" class="related-image">
                </a>
                <ul class="related-info">
                    <li class="related-name"><a href="detail_product.php?id=<?php echo $related_column["productid"]; ?>"><?php echo $related_column["name"];; ?></a></li>
                    <li class="related-category">
                    <?php 
                        foreach($category as $key=>$value) {
                            if($related_column["catid"] == $key) {
                                echo ucwords(strtolower($value));
                                break;
                            }
                        }
                    ?></li>
                    <li class="related-price"><span class="currency">$</span><?php echo $related_column["price"]; ?></li>
                </ul>
            </div>
            <?php endfor; ?>
        </div>               
    </div>
    <!-- related product ends -->

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