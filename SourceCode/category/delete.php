<?php
require_once('database.php');
require_once('function.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    delete_products_by_catid($_POST['id']);
    delete_category($_POST['id']);
    $_SESSION["delete"] = true;
    redirect_to('index.php');

} else { 
    if(!isset($_GET['id'])) {
        redirect_to('index.php');
    }
    $id = $_GET['id'];
    $category = find_category_id($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <link rel="stylesheet" href="../library/css/all.css">
    <style>
   .error {
    color: red;
}
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

  


    .col-sm-5 {
        /* border-left: 1px solid; */
        height: 100%;
        display: table-cell;
        /* background: url("https://cdn.dribbble.com/users/3281732/screenshots/10439348/media/b0ca2c70dd9890d1cff6ce721981f495.jpg") center; */
        /* background: url("https://cdn.dribbble.com/users/407444/screenshots/14932783/media/9f2b89037e062fe01c7cacba6cd65a7e.png?compress=1&resize=800x600") center; */
        background: url("https://cdn.dribbble.com/users/1049995/screenshots/14131645/media/73f725e46b96f33b7a8b6b8cfe3323dc.png?compress=1&resize=1000x750") center;
        
    }


    .title {
        font-size: 35px;
        font-weight: 800;
        margin-bottom: 20px;
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


   
    .error {
        color: rgb(231, 126, 126);
        font-size: 12px;
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
.label {
    font-weight: bold;
    font-size:30px;
}

.row{
    margin-top:7%;
    margin-left:20%;
   
}
.btn{
    float:left;

}
#name{
    margin-top:25px;
}
#value{
    font-weight: bold;
    font-size:25px;
}
    </style>
</head>
<body>
<?php if(!isset($_SESSION['username'])):
        redirect_to('../admin/login.php');
endif; ?>

    
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<div class="navbar navbar-expand-sm bg-pink">
        <div class="container">
            <a href="index.php" class="navbar-brand">Rynan Calendar</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse">
                <span class="navbar-icon"><i class="fas fa-align-right"></i></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="collapse">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item"><a href="#" class="nav-link">Admin</a></li> -->
                    <li class="nav-item"><a href="../admin/index.php" class="nav-link">Admin</a></li>
                    <li class="nav-item"><a href="index.php" class="nav-link">Category</a></li>
                    <li class="nav-item"><a href="../product/index.php" class="nav-link">Product</a></li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-link"><?php include('../shared/user.php'); ?></li>
                    <!-- <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li> -->
                </ul>
            </div>
        </div>
</div>

<div class="row">
        <p class="title col-lg-12">Delete Categoty </p>
        <p class="col-lg-12">This will delete products belong to this category</p>
        <input type="hidden" name="id" value="<?php echo $category['catid'];  ?>" >

        <div class="field col-sm-6">
        <p><span class="label">Name: </span><a id="value"> <?php echo $category['catname']; ?></a></p>
    
        <input class ="btn btn-light" type="submit" name="submit" value="Delete">
        </div>

<img src="https://cdn.dribbble.com/users/4494763/screenshots/8660977/media/2fa2ab591b792411e8df4acb2134e53e.jpeg?compress=1&resize=1000x750" class="float-right"  height="450">
<div class="field col-sm-12">
    <div>
        <a href="index.php" class="text-body">Back to index</a> 
    </div>
 </div>
 </div>

        


    </form>
  


    
    <script src="../library/js/jquery-3.6.0.min.js"></script>
    <script src="../library/js/bootstrap.min.js"></script>
    <script src="../library/js/all.js"></script>
</body>
</html>

<?php
db_disconnect($db);
?>