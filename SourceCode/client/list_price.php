<?php
require_once('database.php');
require_once('function.php');

$category_selected = find_all_category();
$row = mysqli_num_rows($category_selected);
for($i = 0; $i < $row; $i++) {
    $category_column = mysqli_fetch_assoc($category_selected);
    $category[$category_column["catid"]] = $category_column["catname"];
}

$product_selected = find_all_product();
$row = mysqli_num_rows($product_selected);


if (isset($_POST['download'])){ //Download Text button is clicked
    header('Content-Type: text/plain');
	header('Content-Disposition: attachment;filename=product.docx');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');
	$output = fopen('php://output', 'w');

    $product_set = find_all_product();
    while($product = mysqli_fetch_assoc($product_set)){
        foreach ($product as $key => $value) {
            if($key == "name" || $key == "price") {
                fwrite($output, ucfirst($key) . ": $value\r\n");
            }
		}
		fwrite($output, "\r\n");
    }
    mysqli_free_result($product_set);
    fclose($output);
    exit; //WARNING: to stop writing html to file
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Price</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/home_style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
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

        /*table*/
        img {
            width: 200px;
            height: 200px;
        }

        .table-caption {
            text-align: center;
            margin-top: 30px;
            font-size: 32px;
            /* color: pink; */
            font-family: 'Satisfy', cursive;
            color: black;
        }

        .table {
            width: 100%;
        }

        thead td{
            color: black;
            /* font-family: 'Satisfy', cursive; */
            padding: 20px 0px !important;
            font-weight: bold;
        }

        .table-border {
            border-radius: 20px;
            border: 1px solid lightgray;
            margin-bottom: 50px;
        }

        tbody td {
            border-top: 1px solid lightgray !important;
            word-wrap: break-word;
            width: 200px;
        }

        tbody > tr:hover {
            /* background-color: rgb(245, 234, 236); */
            background-color: #f2f2f2;
        }

        .download-btn {
            border-radius: 30px;
            /* text-align: right; */
            padding: 8px 16px;
            border: none;
            background: #78c078;
        }

        .download {
            margin-bottom: 10px;
        }
        /* end table*/

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
        /* end footer  */

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

    <!-- banner -->
    <div class="container-fluid d-flex justify-content-center align-items-center banner">
        <p class="banner-content">
            List Price
        </p>
    </div>
    <!-- banner ends -->

    <!-- breadcrumb  -->
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Price</li>
        </ol>
    </div>
    <!-- breadcrumb end -->

    <!--table-->
    <form action="#" method="post" class="container-fluid d-flex justify-content-end download">
        <input type="submit" name="download" value="Download" class="download-btn">
    </form>
    <div class="table-border container-fluid">
        <div class="table-responsive row">
            <table class="table text-center table-borderless col-lg-12">
                <thead>
                    <td>Name</td>
                    <!-- <td>Dimension</td>
                    <td>Material</td> -->
                    <td>Description</td>
                    <td>Price</td>
                </thead>
                <tbody>
                    <?php 
                        for($i = 0; $i < $row; $i++):
                            $product_column = mysqli_fetch_assoc($product_selected);
                    ?>
                    <tr>
                        <td><?php echo $product_column["name"]; ?></td>
                        <!-- <td><?php //echo $product_column["dimension"]; ?></td>
                        <td><?php //echo $product_column["material"]; ?></td> -->
                        <td><?php echo $product_column["description"]; ?></td>
                        <td>$<?php echo $product_column["price"]; ?></td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>      
    </div>


    
    <!--end table-->

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
    <script src="js/owl.carousel.min.js"></script>
    <script>
        $(".search-field").submit(function() {
            if($(".input-type").val() == "") {
                return false;
            }

            return true;
        })
    </script>
</body>
</html>

<?php disconnect($con); ?>