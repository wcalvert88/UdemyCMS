<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * FROM users";
        $selectUsers = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectUsers)) {
            $userId = escape($row['user_id']);
            $username = escape($row['username']);
            $userPassword = escape($row['user_password']);
            $userFirstname = escape($row['user_firstname']);
            $userLastname = escape($row['user_lastname']);
            $userEmail = escape($row['user_email']);
            $userImage = escape($row['user_image']);
            $userRole = escape($row['user_role']);

            echo "<tr>";
            echo "<td>{$userId}</td>";
            echo "<td>{$username}</td>";

            echo "<td>{$userFirstname}</td>";
            echo "<td>{$userLastname}</td>";
            echo "<td>{$userEmail}</td>";
            echo "<td>{$userRole}</td>";
            // $query = "SELECT * FROM posts WHERE post_id = {$userPostId} ";
            // $selectPostIdQuery = mysqli_query($connection, $query);
            // while ($row = mysqli_fetch_assoc($selectPostIdQuery)) {
            //     $postId = $row['post_id'];
            //     $postTitle = $row['post_title'];
            // }

            echo "<td><a href='users.php?change_to_admin={$userId}'>Admin</td>";
            echo "<td><a href='users.php?change_to_sub={$userId}'>Subscriber</td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$userId}'>Edit</td>";
            echo "<td><a href='users.php?delete={$userId}'>Delete</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php 
if(isset($_GET['delete'])){

    if(isset($_SESSION['userRole'])){
        if($_SESSION['userRole'] == 'Admin') {

    
        $theuserId = escape($_GET['delete']);
        $query = "DELETE FROM users WHERE user_id = {$theuserId} ";
        $deleteQuery = mysqli_query($connection, $query);

        header("Location: users.php");
        }
    }
}

if(isset($_GET['change_to_sub'])){
    $theuserId = escape($_GET['change_to_sub']);
    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$theuserId}";
    $changeSubQuery = mysqli_query($connection, $query);

    header("Location: users.php");
}

if(isset($_GET['change_to_admin'])){
    $theuserId = escape($_GET['change_to_admin']);
    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$theuserId}";
    $changeAdminQuery = mysqli_query($connection, $query);
    header("Location: users.php");
}


?>