<?php

require_once("database.php");
require_once("function.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    deleteProductByID($_POST["id"]);
    $_SESSION["delete"] = true;
    redirect_to("index.php");  
}else {
    if(isset($_GET["id"]) && empty($_GET["id"] == false)) {
        $id = $_GET["id"];
        $product = selectProductByID($id);
    }else redirect_to("index.php");    
}

$category_list = selectAllCategory();
$row_category = mysqli_num_rows($category_list);
$category_name = [];

for($i = 0; $i < $row_category; $i++) {
    $category = mysqli_fetch_assoc($category_list);
    $category_name[$category["catid"]] = $category["catname"];
}

$image = explode(" ", $product["image"]);

// print_r($image);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <link rel="stylesheet" href="../library/css/all.css">
    <style>
    /* navbar */

    .bg-pink {
        /* background-color: rgb(255, 192, 203); */
        background-color: black;
    }

    li > a{
        color: white !important;
        /* font-family: 'Satisfy', cursive; */
        font-weight: 700;
        transition: 0.5s;
    }

    .navbar-brand {
        color: white !important;
        font-family: 'Satisfy', cursive;
        font-size: 2em;
        transition: 0.5s;
    }

    .navbar-brand:hover {
        /* color: rgb(236, 140, 157) !important; */
        font-size: 2.5em;
    }

    .navbar-icon {
        color: white;
    }

    li > a:hover {
        /* color: rgb(236, 140, 157) !important; */
        font-size: 1.5em;
        color: white;
    }

    /*navbar end */

    .create.container {
        /* border: 1px solid; */
        height: 100vh;
        display: table;
    }

    .create.container > .row {
        height: 100%;
    }

    .col-sm-5 {
        /* border-left: 1px solid; */
        height: 100%;
        display: table-cell;
        /* background: url("https://cdn.dribbble.com/users/3281732/screenshots/10439348/media/b0ca2c70dd9890d1cff6ce721981f495.jpg") center; */
        background: url("https://cdn.dribbble.com/users/2071065/screenshots/6863596/dribble_5-21_4x.png?compress=1&resize=1000x750") center;
        /* background: url("https://cdn.dribbble.com/users/407444/screenshots/14932783/media/9f2b89037e062fe01c7cacba6cd65a7e.png?compress=1&resize=800x600") center; */
        
    }

    .logo {
        font-family: "satisfy";
        font-size: 20px;
        margin: 18px 16px;
    }

    .title {
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .col-sm-7 .row:nth-child(2) {
        margin: 100px auto;
        margin-bottom: unset;
        width: 80%;
        /* border: 1px solid; */
    }

    label {
        display: block;
        font-size: 12px;
        margin-top: 10px;
    }

    input, .file-button {
        border: 1px solid;
        border-radius: 20px;
        box-sizing: border-box;
        padding: 10px;
        outline: none;
        width: 90%;
        transition: 0.5s;
    }

    textarea {
        width: 100%;
        height: 150px;
        resize: none;
        border: 1px solid;
        border-radius: 20px;
        outline: none;
        transition: 0.5s;
        text-indent: 20px;
    }

    select {
        padding: 10px;
        border: 1px solid;
        border-radius: 18px;
        outline: none;
        transition: 0.5s;
        text-align: center;
        width: 90%;
    }

    input[type="submit"] {
        width: 150px;
        /* margin-top: 15px; */
        background: black;
        color: white;
        border: none;
        display: block;
        margin: 30px auto;
    }

    input[type="submit"]:hover {
        background: #ee5757;
    }

    /* input:hover, textarea:hover, select:hover{
        transform: scale(1.07);
    } */

    .col-sm-7 .row:nth-child(3) a{
        margin: 18px 16px;
        color: black;
        font-size: 14px;
        padding: 0 15px
    }

    .col-sm-7 .row:nth-child(3) a:hover{
        color: black;
    }

    .error {
        color: rgb(231, 126, 126);
        font-size: 12px;
    }

    .file-wrapper {
        position: relative;
    }

    .file-button {
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        display: block;
        margin: 0;
    }

    input[type="file"] {
        cursor: pointer;
        padding: 10;
        border: 0;
        border-radius: 0;
        position: absolute;
        top: 0;
        z-index: 1000;
        opacity: 0;
    }

    img {
        height: 400px;
        width: 100%;
    }

    </style>
</head>
<body>
    <?php if(!isset($_SESSION['username'])):
        redirect_to('../admin/login.php');
    endif;?>

    <div class="navbar navbar-expand-sm bg-pink">
        <div class="container">
            <a href="../admin/index.php" class="navbar-brand">Rynan Calendar</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse">
                <span class="navbar-icon"><i class="fas fa-align-right"></i></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="collapse">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item"><a href="#" class="nav-link">Admin</a></li> -->
                    <li class="nav-item"><a href="../admin/index.php" class="nav-link">Admin</a></li>
                    <li class="nav-item"><a href="../category/index.php" class="nav-link">Category</a></li>
                    <li class="nav-item"><a href="index.php" class="nav-link">Product</a></li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <?php include("../shared/user.php"); ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="create container">
        <div class="row">
            <form class="col-sm-7" action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- <p class="logo col-lg-12">Rynan Calendar</p> -->
                    <input type="hidden" name="id" value="<?php echo empty($_POST["id"]) ? $id: $_POST["id"]; ?>">
                </div>

                <div class="row">
                    <p class="title col-lg-12">Delete Product</p>
                    <div class="field col-sm-6">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo $product["name"]; ?>" readonly>
                    </div>

                    <div class="field col-sm-6">
                        <label>Dimension</label>
                        <input type="text" name="dimension" value="<?php echo $product["dimension"]; ?>" readonly>
                    </div>

                    <div class="field col-sm-6">
                        <label>Material</label>
                        <input type="text" name="material" value="<?php echo $product["material"]; ?>" readonly>
                    </div>

                    <div class="field col-sm-6">
                        <label>Price</label>
                        <input type="number" name="price" value="<?php echo $product["price"]; ?>" readonly>
                    </div>

                    <div class="field col-sm-12">
                        <label>Description</label>
                        <textarea name="description" readonly><?php echo $product["description"]; ?></textarea>
                    </div>

                    <div class="field col-sm-6">
                        <label>Category</label>
                        <select name="category">
                        <option selected>
                            <?php foreach($category_name as $key=>$value): ?>
                                <?php if($product["catid"] == $key): ?>
                                <?php echo ucwords(strtolower($value)); ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </option>
                        </select>
                    </div>

                    <div class="field col-sm-12">
                        <label>Image</label>
                        <?php if(!empty($product["image"])): ?>
                        <div id="image" class="carousel slide" data-ride="carousel">

                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <?php for($i = 0; $i < count($image); $i++): ?>
                                <li data-target="#image" data-slide-to="<?php echo $i; ?>"></li>
                                <?php endfor; ?>
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <?php for($i = 0; $i < count($image); $i++): ?>
                                <?php if($i == 0): ?>
                                <div class="carousel-item active">
                                    <img src="<?php echo $image[$i]; ?>" alt="<?php echo basename($image[$i]); ?>">
                                </div>
                                <?php else: ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $image[$i]; ?>" alt="<?php echo basename($image[$i]); ?>">
                                </div>
                                <?php endif; ?>
                                <?php endfor; ?>
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#image" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#image" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>

                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="field col-sm-12">
                        <input type="submit" value="Delete">
                    </div>
                </div>

                <div class="row">
                    <a href="index.php">Back to index</a>
                </div>
            </form>


            <div class="col-sm-5">
                
            </div>
        </div>
    </div>

    <script src="../library/js/jquery-3.6.0.min.js"></script>
    <script src="../library/js/bootstrap.min.js"></script>
    <script src="../library/js/all.js"></script>
</body>
</html>

<?php disconnect($con); ?>