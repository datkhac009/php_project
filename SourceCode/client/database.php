<?php

$con = mysqli_connect("localhost", "root", "", "rcdb");

function disconnect($con) {
    if(isset($con)) {
        mysqli_close($con);
    }
    return;
}

function checkQuery($result) {
    global $con;

    if(!$result) {
        echo mysqli_error($con);
        mysqli_close($con);
        exit;
    }
    
    return $result;
}

function find_product_by_id($id) {
    global $con;

    $sql = "select * from product where productid = $id";
    $result = mysqli_query($con, $sql);
    checkQuery($result);
    $product = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $product;
}

function find_all_category() {
    global $con;

    $sql = "select * from category";
    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

function find_product_by_category($catid) {
    global $con;

    $sql = "select * from product where catid='$catid'";
    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

function find_all_product() {
    global $con;

    $sql = "select * from product order by productid desc";
    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

function search($text) {
    global $con;

    $sql = "SELECT * FROM product WHERE MATCH(name, DIMENSION, material, price, description) AGAINST ('$text' IN NATURAL LANGUAGE MODE)";
    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}
?>