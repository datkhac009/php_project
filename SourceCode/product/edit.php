<?php 
require_once("database.php");
require_once("function.php");

ob_start();

function reArrayFiles($file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

function pre_r($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);

$error = [];

$category_list = selectAllCategory();
$row_category = mysqli_num_rows($category_list);
$category_name = [];

for($i = 0; $i < $row_category; $i++) {
    $category = mysqli_fetch_assoc($category_list);
    $category_name[$category["catid"]] = $category["catname"];
}

mysqli_free_result($category_list);

// print_r($category_name);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // pre_r($_FILES["image"]);
    // echo "<br><br>";
    // var_dump($_POST);
    // echo "<br><br>";

    if(empty($_POST["name"])) {
        $error["name"] = "Please enter product's name";
    }

    if(empty($_POST["price"])) {
        $error["price"] = "Please enter product's price";
    }else {
        if(is_numeric($_POST["price"]) == false || strpos($_POST["price"], '-') !== false) {
            $error["price"] = "Product's price must be a positive number";
        }
    }

    $image_extension = ["jpg", "png", "jpeg", "gif"];
    
    $image_arrary = reArrayFiles($_FILES["image"]);
    // pre_r($image_arrary);
    for($i = 0; $i < count($image_arrary); $i++) {
        $target_file = '../img/'.basename($image_arrary[$i]["name"]);
        $image_filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if(empty($image_arrary[$i]["name"]) == false) {
            if($image_arrary[$i]["error"]) {
                $error["image"] = $image_arrary[$i]["name"].' - '.$phpFileUploadErrors[$image_arrary[$i]["error"]];
            }else {
                if(in_array($image_filetype, $image_extension) == false) {
                    $error["image"] = $image_arrary[$i]["name"].' - '."Invalid file extension";
                }
            }
        }
    }

    $image_temp = explode(" ", $_POST["image_temp"]);
    // print_r($image_temp);
}else {
    if(isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = $_GET["id"];
        $product = selectProductByID($id);
    }else redirect_to("index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        /* background: url("https://cdn.dribbble.com/users/407444/screenshots/14932783/media/9f2b89037e062fe01c7cacba6cd65a7e.png?compress=1&resize=800x600") center; */
        background: url("https://cdn.dribbble.com/users/1049995/screenshots/14131645/media/73f725e46b96f33b7a8b6b8cfe3323dc.png?compress=1&resize=1000x750") center;
        
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

    input[type="text"], input[type="number"], .file-button {
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
        background: black;
        color: white;
        border: none;
        display: block;
        margin: 30px auto;
        transition: 0.5s;
        border-radius: 20px;
        box-sizing: border-box;
        padding: 10px;
        outline: none;
        transition: 0.5s;
    }

    input[type="submit"]:hover {
        background: #ffc107;
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

    /* checkbox */
    .checkbox-wrapper {
        display: flex;
        /* flex-wrap: wrap; */
        overflow-x: auto;
    }

    .checkbox-wrapper .option_item {
        display: block;
        position: relative;
        width: 175px;
        height: 175px;
        margin: 10px;
    }

    .checkbox-wrapper .option_item .checkbox {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        opacity: 0;
    }

    .option_item .option_inner {
        min-width: 190px;
        /* width: 100%; */
        height: 100%;
        /* background: url("https://cdn.dribbble.com/users/47000/screenshots/15576854/media/ca6e68142fe87ba09421e44c740ce649.png?compress=1&resize=1000x750"); */
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        display: block;
        border: 4px solid transparent;
        position: relative;
    }

    .option_item .checkbox:checked ~ .option_inner {
        border-color: black;
        color: #3b5999;
    }

    .option_inner img {
        width: 100%;
        height: 100%;
    }

    /* end checkbox */
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
                    <input type="hidden" name="image_temp" value="<?php echo empty($error) ? $product["image"] : $_POST["image_temp"]; ?>">
                    <input type="hidden" name="id" value="<?php echo empty($error) ? $id : $_POST["id"]; ?>">
                </div>

                <div class="row">
                    <p class="title col-lg-12">Edit Product</p>
                    <div class="field col-sm-6">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo empty($error) ? $product["name"] : $_POST["name"]; ?>">
                        
                        <?php if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($error["name"])): ?>
                        <p class="error"><?php echo $error["name"]; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="field col-sm-6">
                        <label>Dimension</label>
                        <input type="text" name="dimension" value="<?php echo empty($error) ? $product["dimension"] : $_POST["dimension"]; ?>">
                    </div>

                    <div class="field col-sm-6">
                        <label>Material</label>
                        <input type="text" name="material" value="<?php echo empty($error) ? $product["material"] : $_POST["material"]; ?>">
                    </div>

                    <div class="field col-sm-6">
                        <label>Price</label>
                        <input type="number" name="price" value="<?php echo empty($error) ? $product["price"] : $_POST["price"]; ?>" step="0.01">
                        <?php if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($error["price"])): ?>
                        <p class="error"><?php echo $error["price"]; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="field col-sm-12">
                        <label>Description</label>
                        <textarea name="description"><?php echo empty($error) ? $product["description"] : $_POST["description"];?></textarea>
                    </div>

                    <div class="field col-sm-6">
                        <label>Category</label>
                        <select name="category">
                            <?php foreach($category_name as $key=>$value): ?>
                            <option value="<?php echo $key; ?>"<?php 
                            if(empty($error)) {
                                if($product["catid"] == $key) echo "selected";
                            }else {
                                if($_POST["category"] == $key) echo "selected";
                            }
                            ?>><?php echo ucwords(strtolower($value)); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field col-sm-6">
                        <label>Image</label>
                        <div class="file-wrapper">
                            <label class="file-button">Picture</label>
                            <input type="file" multiple name="image[]" value="" >
                        </div>
                        <?php if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($error["image"])): ?>
                        <p class="error"><?php echo $error["image"]; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="field col-sm-12">
                    <!-- get -->
                    <?php if(empty($error) && !empty($product["image"])): ?>
                        <label>Delete Image</label>
                        <div class="checkbox-wrapper">
                        <?php foreach(explode(" ", $product["image"]) as $value): ?>
                            <label class="option_item">
                                <input type="checkbox" class="checkbox" name="delete_image[]" value="<?php echo $value; ?>">
                                <div class="option_inner">
                                <img src="<?php echo $value; ?>">
                                </div>
                            </label>
                        <?php endforeach; ?> 
                        </div>
                    <?php endif; ?> 

                    <!-- post -->
                    <?php if(!empty($error)): ?>
                        <label>Delete Image</label>
                        <div class="checkbox-wrapper">
                        <?php foreach($image_temp as $value): ?>
                            <label class="option_item">
                                <input type="checkbox" class="checkbox" name="delete_image[]" value="<?php echo $value; ?>" <?php if(isset($_POST["delete_image"]) && in_array($value, $_POST["delete_image"])) echo "checked"; ?>>
                                <div class="option_inner">
                                <img src="<?php echo $value; ?>">
                                </div>
                            </label>
                        <?php endforeach; ?> 
                        </div>
                    <?php endif; ?> 
                    </div>

                    <div class="field col-sm-12">
                        <input type="submit" value="Edit">
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

    <?php if($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)): ?>
        <?php 

        //added image
        $image_direction = [];
        for($i = 0; $i < count($image_arrary); $i++) {
            if(empty($image_arrary[$i]["name"]) == false) {
                $target_file = '../img/'.basename($image_arrary[$i]["name"]);
                $image_direction[] = $target_file;
            }
        }

        // print_r($_POST["delete_image"]);
        // echo "<br>";
        // print_r($image_temp);
        // echo "<br>";
        // print_r($image_direction);
        // echo "<br>";

        //images are left from delete
        if(empty($_POST["delete_image"])) {
            // $c = 1;
            $image_left = $image_temp;
            $image_modified = array_unique(array_merge($image_left, $image_direction));
        }else {
            // $c = 0;
            $image_left = array_diff($image_temp, $_POST["delete_image"]);
            $image_modified = array_unique(array_merge($image_left, $image_direction));
        }

        // echo $c;

        // echo "<br>";
        // print_r($image_left);

        // echo "<br>";
        // print_r($image_modified);

        $product = [];
        $product["name"] = htmlspecialchars($_POST["name"], ENT_QUOTES);
        $product["dimension"] = htmlspecialchars($_POST["dimension"], ENT_QUOTES);
        $product["material"] = htmlspecialchars($_POST["material"], ENT_QUOTES);
        $product["price"] = $_POST["price"];
        $product["description"] = htmlspecialchars($_POST["description"], ENT_QUOTES);
        $product["image"] = trim(implode(" ", $image_modified));
        $product["category"] = $_POST["category"];
        $product["id"] = $_POST["id"];

        updateProduct($product);
        
        for($i = 0; $i < count($image_arrary); $i++) {
            if(empty($image_arrary[$i]["name"]) == false) {
                $target_file = '../img/'.basename($image_arrary[$i]["name"]);
                if(file_exists($target_file) == false) {
                    // echo $i, "<br>";
                    move_uploaded_file($image_arrary[$i]["tmp_name"], $target_file);
                }else continue;
            }else break;
        }
        $_SESSION["edit"] = true;
        redirect_to("index.php");
        ?>
    <?php endif; ob_end_flush(); ?>

    <script src="../library/js/jquery-3.6.0.min.js"></script>
    <script src="../library/js/bootstrap.min.js"></script>
    <script src="../library/js/all.js"></script>
</body>
</html>

<?php disconnect($con); ?>