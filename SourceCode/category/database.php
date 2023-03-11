<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "RCDB");


function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

$db = db_connect();

function db_disconnect($connection) { 
    if(isset($connection)) {
      mysqli_close($connection);
    }
}
function confirm_query_result($result){
    global $db;
    if (!$result){
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    } else {
        return $result;
    }
  }
function insert_category($category){
    global $db;

    $sql = "INSERT INTO category ";
    $sql .= "(catname) ";
    $sql .= "VALUES (";
    $sql .= "'" . $category['name'] . "'";
    $sql .= ")";

    $result= mysqli_query($db,$sql);
    confirm_query_result($result);
}
function all_category(){
    global $db;

    $sql="SELECT * FROM category ";
    $sql.="ORDER BY catname";

    $result = mysqli_query($db,$sql);
    return $result;
}
function find_category_id($id){
  global $db;

$sql = "SELECT * FROM category ";
$sql .= "WHERE catid ='" . $id . "'";

$result = mysqli_query($db, $sql);
confirm_query_result($result);

$category = mysqli_fetch_assoc($result);
mysqli_free_result($result);
return $category; 
}
function update_subject($category){
  global $db;

  $sql = "UPDATE category SET ";
  $sql .= "catname='" . $category['name'] . "' ";
  $sql .= "WHERE catid ='" . $category['id'] . "' ";
  $sql .= "LIMIT 1";

$result = mysqli_query($db,$sql);

return confirm_query_result($result);

}
function delete_category($id) {
    global $db;
  
    $sql = "DELETE FROM category ";
    $sql .= "WHERE catid ='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
  
    confirm_query_result($result);
}

function delete_products_by_catid($catid) {
    global $db;

    $sql = "delete from product where catid = '$catid'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
?>