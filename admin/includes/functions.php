<?php 

function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function usersOnline() {
    if (isset($_GET['onlineusers'])) {
        global $connection;
        if(!$connection) {
            session_start();
            include("../../includes/db.php");
            $session = session_id();
            $time = time();
            $timeOutInSeconds = 5;
            $timeOut = $time - $timeOutInSeconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $sendQuery = mysqli_query($connection, $query);
            $count = mysqli_num_rows($sendQuery);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
            } else {    
                mysqli_query($connection, "UPDATE users_online SET time = '{$time}' WHERE session = '$session'");
            }

            $usersOnlineQuery = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$timeOut'");
            echo $countUser = mysqli_num_rows($usersOnlineQuery);
        }
    }
}
usersOnline();

function confirmQuery($result){
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }


}

function insertCategories() {

    global $connection;
    if (isset($_POST['submit'])) {
        $catTitle = escape($_POST['catTitle']);

        if ($catTitle == "" || empty($catTitle)) {

            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$catTitle}')";
            $createCategoryQuery = mysqli_query($connection, $query);
            if (!$createCategoryQuery) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }

}

function findAllCategories() {
    global $connection;
    // FIND ALL CATEGORIES QUERY.
    $query = "SELECT * FROM categories";
    $selectCategories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($selectCategories)) {
        $catId = escape($row['cat_id']);
        $catTitle = escape($row['cat_title']);
        echo "<tr>";
        echo "<td>{$catId}</td>";
        echo "<td>{$catTitle}</td>";
        echo "<td><a href='categories.php?delete={$catId}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$catId}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories() {
    global $connection;
    // DELETE QUERY
    if(isset($_GET['delete'])) {
        $catIdDel = escape($_GET['delete']);
    $query = "DELETE FROM categories WHERE cat_id = {$catIdDel} ";
    $deleteQuery = mysqli_query($connection,$query);
    header("Location: categories.php");
    }
}


function recordCount($table) {
    global $connection;
    $query = "SELECT * FROM {$table} ";
    $selectAllPosts = mysqli_query($connection, $query);
    $result = mysqli_num_rows($selectAllPosts);

    confirmQuery($result);

    return $result;
}

function checkStatus($table, $column, $status) {
    global $connection;
    $query = "SELECT * FROM {$table} WHERE {$column} = '{$status}' ";
    $selectAllPosts = mysqli_query($connection, $query);
    $result = mysqli_num_rows($selectAllPosts);
    return $result;
}

function is_admin($username) {
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row = mysqli_fetch_array($result);

    if($row['user_role'] == 'Admin') {
        return true;
    } else {
        return false;
    }
}

function usernameExists($username) {
    global $connection;
    $query = "SELECT username FROM users WHERE username = '{$username}' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function emailExists($email) {
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email = '{$email}' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function redirect($location) {
    return header("Location:" . $location);
}

function registerUser($username, $email, $password) {
    global $connection;

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES ('{$username}','{$email}','{$password}', 'Subscriber' ) ";
    $registerUserQuery = mysqli_query($connection, $query);
    confirmQuery($registerUserQuery);
    
}

function loginUser($username, $password) {
    global $connection;
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

    if (password_verify($password, $dbUserPassword)) {
        $_SESSION['username'] = $dbUsername;
        $_SESSION['firstname'] = $dbFirstname;
        $_SESSION['lastname'] = $dbLastname;
        $_SESSION['userRole'] = $dbUserRole;
        redirect("../admin");
    } else {
        redirect("../index.php");
    }
}
?>