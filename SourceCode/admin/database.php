<?php 
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "rcdb");

    function db_connect(){
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        return $connection;
    }

    $db = db_connect();

    function db_disconnect($connection){
        if(isset($connection)){
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
    function insert_admin($admin){
        global $db;

        $sql = "INSERT INTO admin ";
        $sql .= "(username,password,fullname,email,contact) ";
        $sql .= "VALUES (";
        $sql .= "'" . $admin['username'] . "',"; 
        $sql .= "'" . $admin['password'] . "',";
        $sql .= "'" . $admin['fullname'] . "',";
        $sql .= "'" . $admin['email'] . "',";
        $sql .= "'" . $admin['contact'] . "' ";
        // $sql .= "'" . $admin['pass'] . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);
        return confirm_query_result($result);
    }

    function find_password($username) {
        global $db;
        $sql = "SELECT Password FROM admin ";
        $sql .= "WHERE Username='" . $username . "'";
        $result = mysqli_query($db, $sql);
        confirm_query_result($result);
        $Login = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $Login; 
    }

    function find_all_admin(){
        global $db;

        $sql = "SELECT * FROM admin ";
        $result = mysqli_query($db, $sql);

        return $result;
    }

    function find_username_column(){
        global $db;

        $sql = "SELECT username FROM admin ";
        $result = mysqli_query($db, $sql);
        
        return confirm_query_result($result);
    }

    function find_admin_by_username($username){
        global $db;

        $sql = "SELECT * FROM admin ";
        $sql .= "WHERE username = '" . $username . "' ";
        $result = mysqli_query($db, $sql);

        confirm_query_result($result);

        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin;
    }

    function update_admin($admin){
        global $db;

        $sql = "UPDATE admin SET ";
        $sql .= "Username = '" . $admin['username'] . "', ";
        $sql .= "Password = '" . $admin['password'] . "', ";
        $sql .= "Fullname = '" . $admin['fullname'] . "', ";
        $sql .= "email = '" . $admin['email'] . "', ";
        $sql .= "contact = '" . $admin['contact'] . "' ";
        // $sql .= "pass = '" . $admin['pass'] . "'";
        $sql .= "WHERE username = '" . $admin['pre_username'] . "' ";
        $sql .= "LIMIT 1;";

        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }

    function delete_admin($admin){
        global $db;

        $sql = "DELETE FROM admin ";
        $sql .= "WHERE username='" . $admin . "' ";
        $sql .= "LIMIT 1;";
        $result = mysqli_query($db, $sql);

        return confirm_query_result($result);
    }
?>