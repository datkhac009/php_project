<?php 


require_once("database.php");
require_once("function.php");

function pre_r($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$result = getColumnName();
$column_row = mysqli_num_rows($result);
$column_name = [];
for($i = 0; $i < $column_row; $i++) {
    $column_list = mysqli_fetch_assoc($result);
    // print_r($column_list);
    $column_name[] = $column_list["COLUMN_NAME"];
}

mysqli_free_result($result);

$result = selectAllProduct();
$data_row = mysqli_num_rows($result);

$category_list = selectAllCategory();
$row_category = mysqli_num_rows($category_list);
$category_name = [];

for($i = 0; $i < $row_category; $i++) {
    $category = mysqli_fetch_assoc($category_list);
    $category_name[$category["catid"]] = $category["catname"];
}

mysqli_free_result($category_list);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products index</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <link rel="stylesheet" href="../library/css/all.css">
    <style>
   /* navbar */

   .bg-pink {
        background-color:  black;
        /* background-color: rgb(255, 192, 203); */
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
        color: white !important;
        /* color: rgb(236, 140, 157) !important; */
        font-size: 1.5em;
    }

    /*navbar end */

    img {
        width: 40px;
        height: 40px;
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
    }

    tbody td {
        border-top: 1px solid lightgray !important;
        word-wrap: break-word;
        width: auto;
    }

    tbody > tr:hover {
        /* background-color: rgb(245, 234, 236); */
        background-color: #f2f2f2;
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

    <p class="table-caption">Products</p>

    <?php if(isset($_SESSION["delete"])): $_SESSION["delete"] = NULL; ?>
    <p class="alert alert-danger">Deleted Successfully</p>
    <?php ?>
    <?php elseif(isset($_SESSION["edit"])): $_SESSION["edit"] = NULL; ?>
    <p class="alert alert-info">Edited Successfully</p>
    <?php elseif(isset($_SESSION["create"])): $_SESSION["create"] = NULL; ?>
    <p class="alert alert-success">Created Successfully</p>
    <?php endif; ?>
        
    <div class="table-border container-fluid">
        <div class="table-responsive">
            <table class="table text-center table-borderless">
                <thead>
                    <?php for($i = 0; $i <= count($column_name); $i++): ?>
                        <?php if($i == $column_row): ?>
                            <td colspan="2"><a href="new.php"><i class="fas fa-plus"></i>&nbsp;Create Product</a></td>
                        <?php else: ?>  
                            <td><?php echo ucwords(strtolower($column_name[$i])); ?></td>
                        <?php endif; ?>
                    <?php endfor; ?>
                </thead>
                
                <?php for($i = 0; $i < $data_row; $i++): 
                    $product = mysqli_fetch_assoc($result);    
                ?>
                <tr>
                    <?php for($j = 0; $j <= $column_row; $j++): ?>
                        <?php if($j == $column_row): ?>
                            <td><a href="<?php echo "edit.php?id=".$product["productid"]; ?>"><i class="fas fa-pencil-alt"></i>&nbsp;Edit</a></td>
                            <td><a href="<?php echo "delete.php?id=".$product["productid"]; ?>"><i class="fas fa-pencil-alt"></i>&nbsp;Delete</a></td>
                        <?php else: ?>
                            <?php if($column_name[$j] == "image" && !empty($product["image"])): $image = explode(" ", $product["image"]); ?>
                            <td>
                                <?php for($k = 0; $k < count($image); $k++): ?>
                                    <img src="<?php echo $image[$k]; ?>" alt="<?php echo basename($image[$k]); ?>">
                                <?php endfor; ?>
                            </td>
                            <?php elseif($column_name[$j] == "catid"): ?>
                                <?php foreach($category_name as $key=>$value): ?>
                                    <?php if($key == $product["catid"]): ?>
                                        <td><?php echo ucwords(strtolower($value)); ?></td>
                                    <?php endif; ?>
                                <?php endforeach;?>
                            <?php else: ?><td><?php echo $product[$column_name[$j]]; ?></td>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </tr>
                <?php 
                    endfor; 
                    mysqli_free_result($result);
                ?>
                
            </table>
        </div>
    </div>

    
    <script src="../library/js/jquery-3.6.0.min.js"></script>
    <script src="../library/js/bootstrap.min.js"></script>
    <script src="../library/js/all.js"></script>
</body>
</html>

<?php disconnect($con); ?>