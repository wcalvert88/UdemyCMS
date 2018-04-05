<?php include "db.php"; ?>
<?php include "../admin/includes/functions.php"; ?>
<?php session_start(); ?>
<?php 

if (isset($_POST['login'])) {
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);
}
$username = escape($username);
$password = escape($password);
echo $username;
echo $password;
$query = "SELECT * FROM users WHERE username = '{$username}' ";
$selectUserQuery = mysqli_query($connection, $query);
if (!$selectUserQuery) {
    die ("QUERY FAILED" . mysqli_error($connection));
}
while ($row = mysqli_fetch_array($selectUserQuery)) {
    $dbUserId = escape($row['user_id']);
    $dbUsername = escape($row['username']);
    $dbUserPassword = escape($row['user_password']);
    $dbUserFirstname = escape($row['user_firstname']);
    $dbUserLastname = escape($row['user_lastname']);
    $dbUserRole = escape($row['user_role']);
}

// $password =crypt($password, $dbUserPassword);


if (password_verify($password, $dbUserPassword)) {
    $_SESSION['username'] = $dbUsername;
    $_SESSION['firstname'] = $dbFirstname;
    $_SESSION['lastname'] = $dbLastname;
    $_SESSION['userRole'] = $dbUserRole;
    header("Location: ../admin");
} else {
    header("Location: ../index.php");
}
?>