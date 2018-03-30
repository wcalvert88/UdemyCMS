<?php include "db.php"; ?>
<?php 

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}
$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);
echo $username;
echo $password;
$query = "SELECT * FROM users WHERE username = '{$username}' ";
$selectUserQuery = mysqli_query($connection, $query);
if (!$selectUserQuery) {
    die ("QUERY FAILED" . mysqli_error($connection));
}
while ($row = mysqli_fetch_array($selectUserQuery)) {
    $dbUserId = $row['user_id'];
    $dbUsername = $row['username'];
    $dbUserPassword = $row['user_password'];
    $dbUserFirstname = $row['user_firstname'];
    $dbUserLastname = $row['user_lastname'];
    $dbUserRole = $row['user_role'];
}

if ($username !== $dbUsername && $password !== $dbUserPassword) {
    header("Location: ../index.php");
} else if ($username == $dbUsername && $password == $dbUserPassword) {
    header("Location: ../admin");
} else {
    header("Location: ../index.php");
}
?>