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

function selectAllCategory() {
    global $con;

    $sql = "select * from category";
    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

function insertProduct($product) {
    global $con;

    $sql = "insert into product(name, dimension, material, price, description, image, catid)
    values(
        '{$product['name']}', 
        '{$product['dimension']}', 
        '{$product['material']}', 
        '{$product['price']}', 
        '{$product['description']}', 
        '{$product['image']}', 
        '{$product['category']}'
    )";

    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

function selectAllProduct() {
    global $con;

    $sql = "select * from product";
    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

function getColumnName() {
    global $con;

    $sql = "SELECT COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = 'rcdb' AND TABLE_NAME = 'product';";
    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

function selectProductByID($id) {
    global $con;

    $sql = "select * from product where productid = $id";
    $result = mysqli_query($con, $sql);
    checkQuery($result);
    $product = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $product;
}

function deleteProductByID($id) {
    global $con;

    $sql = "delete from product where productid = $id limit 1";
    $result = mysqli_query($con, $sql);
    return checkQuery($result);
}

function updateProduct($product) {
    global $con;

    $sql = "update product
    set name = '{$product['name']}', 
        dimension = '{$product['dimension']}', 
        material = '{$product['material']}', 
        price = '{$product['price']}', 
        description = '{$product['description']}', 
        image = '{$product['image']}', 
        catid = '{$product['category']}'
    where productid = '{$product['id']}'
    limit 1;";

    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

// image = '{$product['image']}', 

function selectAllImage() {
    global $con;

    $sql = "select image from product";
    $result = mysqli_query($con, $sql);

    return checkQuery($result);
}

?>