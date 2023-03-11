<?php
ob_start();

require_once('database.php');
require_once('function.php');
$errors=[];

$_SESSION["login"] = NULL;
if(isset($_SESSION["username"])) {
    redirect_to("index.php");
}else $_SESSION["username"] = NULL;


$result = find_username_column();
$row = mysqli_num_rows($result);
for($i = 0; $i < $row; $i++) {
    $column = mysqli_fetch_assoc($result);
    $username[] = $column["username"];
}


if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    // print_r($_POST);
    // echo "<br>";
    // print_r($username);
    // var_dump(in_array($_POST["username"], $username));

    if (empty($_POST['username'])){
        $errors["username"] = 'Username is required';
    }else {
        if(empty($username)) {
            $errors["username"] = 'Username doesn\'t exist';
        }else if(!empty($username) && !in_array($_POST["username"], $username)) {
            $errors["username"] = 'Username doesn\'t exist';
        }else {
            if (empty($_POST['password'])){
                $errors["password"] = 'Password is required';
            }else {
                $login = find_password($_POST["username"]);
                // echo "<br>";
                // print_r($login);
                // echo "<br>", sha1($_POST["password"]);
                if(sha1($_POST["password"]) !== $login["Password"]) {
                    $errors["password"] = "Password doesn't match";
                }
            }
        }
    }

}
function isFormValidated(){
    global $errors;
    return count($errors) == 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <link rel="stylesheet" href="../library/css/all.css">

    <title>Login</title>
    <style>
        .container {
            /* border: 1px solid pink; */
            margin: 30px auto;
            padding: 0;
            height: 100vh;
            /* border-radius: 30px; */
        }

        .container > .row {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .col-sm-6 {
            width: 100%;
            margin: 0;
            padding: 0;
            height: 100%;
        }
        
        /* 
        img {
           width: 100%;
           height: 100%;
        } */

        .logo {
           font-family: "Satisfy";
           font-size: 20px;
           margin: 18px 16px;
           color: pink;
           /* border: 1px solid; */
        }    

        title {
            border: 1px solid;
        }

        .col-sm-6  > .row {
            width: 100%;
        }

        .col-sm-6:nth-child(2) {
            background: url("https://cdn.dribbble.com/users/1292088/screenshots/14802334/media/c048a0db9c48636f9a56ae5bca7d5637.jpg?compress=1&resize=1000x750") center;  
        }

        .col-sm-6 .row:nth-child(2) {
            width: 70%;
            margin: 100px auto;
            /* border: 1px solid; */
        }

        label {
            display: block;
            font-size: 12px;
        }

        .title {
            font-size: 30px;
            font-weight: 700;
        }

        input {
            outline: none;
            border: none;
            border-bottom: 1px solid;
            width: 100%;
            transition: 0.3s;
        }

        .field {
            margin-top: 25px;
        }

        .button {
            border-radius: 30px;
            display: block;
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            border: none;
            /* background: linear-gradient(to bottom, #ee9ca7, #ffdde1);   */
            color: white; 
            background: #ee9ca7;
        }
        
        .button:hover {
            box-shadow: 0 10px 30px pink;
        }

        .type:focus {
            margin-top: 10px;
            font-size: 20px;
        }

        .signup {
            color: pink;
            font-size: 14px;
            text-decoration: underline;
        }

        .signup:hover {
            color: rgb(252, 159, 175);
        }

        .col-sm-6 .row:nth-child(3) {
            margin-left: 16px;
        }

        .error {
            color: rgb(231, 126, 126);
            font-size: 12px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <div class="row">
                        <p class="logo col-sm-12">Rynan Calendar</p>
                    </div>

                    <div class="row">
                        <p class="title col-sm-12">Log in</p>
                        <div class="field col-sm-12">
                            <label>Username</label>
                            <input type="text" class="type" name="username" 
                            value="<?php echo empty($_POST["username"]) ? "" : $_POST["username"]; ?>">
                            <?php if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($errors["username"])): ?>
                            <p class="error"><?php echo $errors["username"]; ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="field col-sm-12">
                            <label>Password</label>
                            <input type="password" class="type" name="password" value="<?php echo empty($_POST["password"]) ? "" : $_POST["password"]; ?>"> 
                            <?php if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($errors["password"])): ?>
                            <p class="error"><?php echo $errors["password"]; ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="field col-sm-12">
                            <input type="submit" value="Log in" class="button">
                        </div>
                    </div>

                    <div class="row">
                        <a href="new.php" class="signup">Sign up?</a>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <!-- <img src="https://cdn.dribbble.com/users/1292088/screenshots/14802334/media/c048a0db9c48636f9a56ae5bca7d5637.jpg?compress=1&resize=1000x750" alt=""> -->
            </div>
        </div>
    </div>
   <?php
        if ($_SERVER["REQUEST_METHOD"] == 'POST' && isFormValidated()){
            $_SESSION['username'] = $_POST["username"];
            redirect_to('index.php');
        }
   ?>
    <script src="../library/js/jquery-3.6.0.min.js"></script>
    <script src="../library/js/bootstrap.min.js"></script>
    <script src="../library/js/all.js"></script>    
</body>
</html>

<?php
    ob_end_flush();
    db_disconnect($db);
?>
