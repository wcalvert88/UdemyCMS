<?php session_start();
include "db.php";
include "../admin/includes/functions.php";

if (isset($_POST['login'])) {
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);
    loginUser($username, $password);
}
?>