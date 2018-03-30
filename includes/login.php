<?php include "db.php"; ?>
<?php 

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}
$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $username);

$query = "SELECT * FROM users WHERE username = '{$username}' ";
$selectUserQuery = mysqli_query($connection, $query);
if (!$selectUserQuery) {
    die ("QUERY FAILED" . mysqli_error($connection));
}
while ($row = mysqli_fetch_array($selectUserQuery)) {
    echo $dbId = $row['user_id'];
}
?>