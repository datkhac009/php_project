<?php
    require_once('database.php');
    require_once('function.php');

    $_SESSION["login"] = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <link rel="stylesheet" href="../library/css/all.css"> 
    <title>View Admin</title>
    <style>
        /* navbar */

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

        /*navbar end */

        .table-caption {
            text-align: center;
            margin-top: 30px;
            font-size: 32px;
            /* color: pink; */
            color: black;
            font-family: 'Satisfy', cursive;
        }

        .table {
            widtd: 100%;
        }

        .thead td{
            color: pink;
            /* font-family: 'Satisfy', cursive; */
            padding: 20px 0px !important;
        }

        tbody > tr:hover {
            /* background-color: rgb(245, 234, 236); */
            background-color: #f2f2f2;
        }

        .table-border {
            border-radius: 30px;
            border: 1px solid lightgray;
        }

        tbody td {
            border-top: 1px solid lightgray !important;
        }
        .signup {
            color: black;
            /* color: pink; */
            font-size: 14px;
            text-decoration: underline;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php 
        if(!isset($_SESSION['username'])):
            redirect_to('login.php');
        endif;
    ?>

    <div class="navbar navbar-expand-sm bg-pink">
        <div class="container">
            <a href="../admin/index.php" class="navbar-brand">Rynan Calendar</a>

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
                    <?php include("../shared/user.php"); ?>
                </ul>
            </div>
        </div>
    </div>
       

    <p class="table-caption">View Admin</p>
    <?php if(isset($_SESSION["delete"])): $_SESSION["delete"] = NULL; ?>
    <p class="alert alert-danger">Deleted Successfully</p>
    <?php ?>
    <?php elseif(isset($_SESSION["edit"])): $_SESSION["edit"] = NULL; ?>
    <p class="alert alert-info">Edited Successfully</p>
    <?php elseif(isset($_SESSION["create"])): $_SESSION["create"] = NULL; ?>
    <p class="alert alert-success">Created Successfully</p>
    <?php endif; ?>

    <div class="table-border container">
        <div class="table-responsive">
            <table class="table text-center table-borderless">
                <thead>
                    <td>User Name</td>
                    <td>Password</td>
                    <td>Full Name</td>
                    <td>Contact</td>
                    <td>Email</td>
                    <td>&nbsp;</td>
                    <td> <a href="new.php"><i class="fas fa-plus"></i>&nbsp;Create a Admin</a></td>
                </thead>

                <?php
                    $admin_set = find_all_admin();
                    $count = mysqli_num_rows($admin_set);
                    for($i = 0; $i < $count; $i++):
                        $admin = mysqli_fetch_assoc($admin_set);
                ?>

                <tr>
                    <td><?php echo $admin['username'];?></td>
                    <td><?php echo $admin['password'];?></td>
                    <td><?php echo $admin['fullname'];?></td>
                    <td><?php echo $admin['contact'];?></td>
                    <td><?php echo $admin['email'];?></td>
                    <td><a href=" <?php echo 'edit.php?Username='.$admin['username']; ?>" >
                    <i class="fas fa-pencil-alt"></i>&nbsp;Edit</a></td>
                    <td><a href="<?php echo 'delete.php?Username='.$admin['username']; ?>">
                    <i class="fas fa-eraser"></i>&nbsp;Delete</a></td>
                </tr>
                <?php
                    endfor;
                    mysqli_free_result($admin_set);
                ?>
            </table>
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