<?php
require_once('function.php');

unset($_SESSION['username']);
// $_SESSION['name'] = NULL;

redirect_to('login.php');
exit;
?>