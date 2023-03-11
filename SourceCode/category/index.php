<?php
include_once('database.php');
require_once('function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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

    .table-caption {
        text-align: center;
        margin-top: 30px;
        font-size: 32px;
        color: black;
        font-family: 'Satisfy', cursive;
    }

    .table {
        widtd: 100%;
    }

    .thead td{
        /* color: pink; */
        /* font-family: 'Satisfy', cursive; */
        padding: 20px 0px !important;
        font-weight: 700 !important;
    }

    tbody > tr:hover {
        /* background-color: rgb(245, 234, 236); */
        background: #f2f2f2;
    }

    .table-border {
        border-radius: 30px;
        border: 1px solid lightgray;
    }

    tbody td {
        border-top: 1px solid lightgray !important;
    }
    .signup {
        color: pink;
        font-size: 14px;
        text-decoration: underline;
        text-align: right;
    }
    </style>
</head>
<body>


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


<?php if(!isset($_SESSION['username'])):
        redirect_to('../admin/login.php');
    endif;?>

    <p class="table-caption">View Category</p>

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

<br><br>
<table class="table text-center table-borderless">
    <thead>
        <td>Category Name</td>
        <td colspan="2"><a href="new.php"><i class="fas fa-plus"></i>&nbsp;Create a Category</a></td>
    </thead>
        <?php  
        $allcategory = all_category();
        $count = mysqli_num_rows($allcategory);
        for ($i = 0; $i < $count; $i++):
            $category = mysqli_fetch_assoc($allcategory); 
        ?>
            <tr>
                <td><?php echo $category['catname']; ?></td>
                <td><a href="<?php echo 'edit.php?id='.$category['catid']; ?>"><i class="fas fa-pencil-alt"></i>&nbsp;Edit</a></a></td>
                <td><a href="<?php echo 'delete.php?id='.$category['catid']; ?>"><i class="fas fa-eraser"></i>&nbsp;Delete</a></a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($allcategory);
        ?>
       
        </table>

        <script src="../library/js/jquery-3.6.0.min.js"></script>
        <script src="../library/js/bootstrap.min.js"></script>
        <script src="../library/js/all.js"></script>


</body>
</html>
<?php
db_disconnect($db);
?>
