<?php
require_once('database.php');
require_once('function.php');

$errors = [];

$result = find_username_column();
$row = mysqli_num_rows($result);
for($i = 0; $i < $row; $i++) {
    $column = mysqli_fetch_assoc($result);
    $username[] = $column["username"];
}

function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

function checkForm(){
    global $errors;
    global $username;
    
    if (empty($_POST['username'])){
        $errors["username"] = 'Username is required';
    }else {
        if(!empty($username) && in_array($_POST["username"], $username) && ($_POST["username"] != $_POST["pre_username"])) {
            $errors["username"] = 'Username exists';
        }
    }

    if (empty($_POST['password'])){
        $errors["password"] = 'Password is required';
    }
    
}

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    // print_r($_POST);
    checkForm();
    if (isFormValidated()){
        
        $admin = [];
        $admin['username'] = $_POST['username'];
        $admin['password'] = sha1($_POST['password']);
        $admin['fullname'] = $_POST['fullname'];
        $admin['email'] = $_POST['email'];
        $admin['contact'] = $_POST['contact'];
        $admin["pre_username"] = $_POST["pre_username"];

        update_admin($admin);
        $_SESSION["edit"] = true;
        redirect_to('index.php');
    }
} else { // form loaded
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
    <title>Edit admin</title>
    <style>
        .bg-black {
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

        .table-caption {
            text-align: center;
            margin-top: 30px;
            font-size: 32px;
            color: pink;
            font-family: 'Satisfy', cursive;
        }

        .table {
            width: 100%;
        }

        thead td{
            color: pink;
            /* font-family: 'Satisfy', cursive; */
            padding: 20px 0px !important;
        }

        .navbar-icon {
            color: white;
        }

        li > a:hover {
            /* color: rgb(236, 140, 157) !important; */
            font-size: 1.5em;
        }

        .navbar-brand:hover {
            /* color: rgb(236, 140, 157) !important; */
            font-size: 2.5em;
        }

        tbody > tr:hover {
            background-color: rgb(245, 234, 236);
        }

        .table-border {
            border-radius: 30px;
            border: 1px solid lightgray;
        }

        tbody td {
            border-top: 1px solid lightgray !important;
        }

        .create.container {
            /* border: 1px solid; */
            height: 100vh;
        }

        .create.container > .row {
            height: inherit;
        }

        .col-sm-5 {
            /* border-left: 1px solid; */
            height: 100%;
            /* background: url("https://cdn.dribbble.com/users/3281732/screenshots/10439348/media/b0ca2c70dd9890d1cff6ce721981f495.jpg") center; */
            /* background: url("https://cdn.dribbble.com/users/407444/screenshots/14932783/media/9f2b89037e062fe01c7cacba6cd65a7e.png?compress=1&resize=800x600") center; */
            background: url("https://data.whicdn.com/images/339515988/original.jpg") no-repeat center;
            background: url("https://cdn.dribbble.com/users/910614/screenshots/15200039/media/34710d98fab3d33859c273941e8b6fda.jpg?compress=1&resize=1000x750") no-repeat center;
            background-size: cover;
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

        input {
            border: 1px solid;
            border-radius: 20px;
            box-sizing: border-box;
            padding: 10px;
            outline: none;
            width: 100%;
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
            margin: 30px 0px;
        }
        input[type="reset"] {
            width: 150px;
            /* margin-top: 15px; */
            background: black;
            color: white;
            border: none;
            display: block;
            margin: 30px auto;
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

    </style>
</head>
<body>
    <?php 
        if(!isset($_SESSION['username'])):
            redirect_to('Login.php');
        endif;
    ?>

    <div class="navbar navbar-expand-sm bg-black">
        <div class="container">
            <a href="index.php" class="navbar-brand">Rynan Calendar</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse">
                <span class="navbar-icon"><i class="fas fa-align-right"></i></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="collapse">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item">  <a href="#" class="nav-link">Admin</a></li> -->
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

    <div class="create container">
        <div class="row">
            <form class="col-sm-7" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <div class="row">
                    <!-- <p class="logo col-lg-12">Rynan Calendar</p> -->
                </div>

                <div class="row">
                    <p class="title col-lg-12">Edit Admin Form</p>
                    <div class="field col-sm-6">
                        <input type="hidden" name="pre_username" 
                        value="<?php echo isFormValidated()? $admin['username']: $_POST['pre_username'] ?>" >
                        <label for="username"class="logo-caption">User Name</label>
                        <input type="text" id="username" name="username"
                        value="<?php echo isFormValidated()? $admin['username']: $_POST['username'] ?>">
                        <?php if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($errors["username"])): ?>
                        <p class="error"><?php echo $errors["username"]; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="field col-sm-6">
                        <label for="fullname"class="logo-caption">Fullname</label>
                        <input type="text" id="fullname" name="fullname"  
                        value="<?php echo isFormValidated()? $admin['fullname']: $_POST['fullname'] ?>">
                    </div>
                    <div class="field col-sm-12">
                        <label for="password" class="logo-caption">Password</label>
                        <input type="password" id="password" name="password">
                        <?php if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($errors["password"])): ?>
                        <p class="error"><?php echo $errors["password"]; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="field col-sm-12">
                        <label for="email"class="logo-caption">Email</label>
                        <input type="text" id="email" name="email"  
                        value="<?php echo isFormValidated()? $admin['email']: $_POST['email'] ?>">
                    </div>

                    <div class="field col-sm-12">
                        <label for="phone"class="logo-caption">Contact</label> <!--required-->
                        <input type="text" id="contact" name="contact"  
                        value="<?php echo isFormValidated()? $admin['contact']: $_POST['contact'] ?>">
                    </div>
                    <div class="submit col-sm-12"> 
                        <input type="submit" class="btn btn-danger" name="submit" value="Edit">
                    </div>

                    <div class="col-md-12">
                        <a href="index.php" style="color: black; font-size: 14px;">Back to Index admin</a> 
                    </div>
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


<?php
db_disconnect($db);
?>