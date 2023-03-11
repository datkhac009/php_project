<?php
require_once('database.php');
require_once('function.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    
    delete_admin($_POST['username']);
    $_SESSION["delete"] = true;
    redirect_to('index.php');
} else { 
    if(!isset($_GET['Username'])) {
        redirect_to('index.php');
    }
    $username = $_GET['Username'];
    $admin = find_admin_by_username($username);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <link rel="stylesheet" href="../library/css/all.css">
    <title>Delete admin</title>
    <style>
        .label {
            font-weight: bold;
            font-size: large;
        }
        #login-box .logo-caption {
	        font-family: 'Poiret One', cursive;
            color: black;
            text-align: center;
            margin-bottom: 0px;
        }
         .btn {
        flex: 1 1 auto;
        text-align: center;
        border-radius: 15px;
        }
        .bg-pink {
            background-color: black;
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


        .table-caption {
            text-align: center;
            margin-top: 30px;
            font-size: 32px;
            /* color: pink; */
            color: black;
            font-family: 'Satisfy', cursive;
        }
        .signup {
            color: black;
            /* color: pink; */
            font-size: 14px;
            text-decoration: underline;
            text-align: right;
        }
        .table {
            widtd: 100%;
        }
    </style>
</head>
<body>
<div class="navbar navbar-expand-sm bg-pink">
        <div class="container">
            <a href="index.php" class="navbar-brand">Rynan Calendar</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse">
                <span class="navbar-icon"><i class="fas fa-align-right"></i></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="collapse">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item"><a href="#" class="nav-link">Admin</a></li> -->
                    <li class="nav-item"><a href="index.php" class="nav-link">Admin</a></li>
                    <li class="nav-item"><a href="../category/index.php" class="nav-link">Category</a></li>
                    <li class="nav-item"><a href="../product/index.php" class="nav-link">Product</a></li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-link"><?php include('../shared/user.php'); ?></li>
                    <!-- <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li> -->
                </ul>
            </div>
        </div>
</div>
<?php 
        if($admin['username'] === $_SESSION['username']){
           $_SESSION['Delete']; //= 'You cannot delete your name!';
            redirect_to('index.php');
        }else{
            unset($_SESSION['delete']);
        }
?>
<div id="login-box">
    <p class="table-caption">Delete admin</p>
    <h2 class="logo-caption">Are you sure you want to delete this admin?</h2><br><br>
    <div class="table-border container">
    <p><span class="logo-caption">Username: </span><?php echo $admin['username']; ?></p>
    <p><span class="logo-caption">Password: </span><?php echo $admin['password']; ?></p>
    <p><span class="logo-caption">Fullname: </span><?php echo $admin['fullname']; ?></p>
    <p><span class="logo-caption">Email: </span><?php echo $admin['email']; ?></p>
    <p><span class="logo-caption">Contact: </span><?php echo $admin['contact']; ?></p>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="username" value="<?php echo $admin['username']; ?>" >
        
        <input type="submit" name="submit" class="btn btn-danger" value="Delete Admin" ><br><br><br><br>
        <div class="col">
        <a href="index.php" class="signup" data-toggle="tooltip">Back to Index Admin </a>
        </div>
    </div>
     
    </form>
</div>
    </div>
</div>

<script src="../library/js/jquery-3.6.0.min.js"></script>
<script src="../library/js/bootstrap.min.js"></script>
<script src="../library/js/all.js"></script>
</body>
</html>


<?php
db_disconnect($db);
?>