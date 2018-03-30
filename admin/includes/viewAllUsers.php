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
            $userId = $row['user_id'];
            $username = $row['username'];
            $userPassword = $row['user_password'];
            $userFirstname = $row['user_firstname'];
            $userLastname = $row['user_lastname'];
            $userEmail = $row['user_email'];
            $userImage = $row['user_image'];
            $userRole = $row['user_role'];

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
            echo "<td><a href='users.php?delete={$userId}'>Delete</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php 
if(isset($_GET['delete'])){
    $theuserId = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$theuserId} ";
    $deleteQuery = mysqli_query($connection, $query);

    header("Location: users.php");

}

if(isset($_GET['change_to_sub'])){
    $theuserId = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$theuserId}";
    $changeSubQuery = mysqli_query($connection, $query);

    header("Location: users.php");

}

if(isset($_GET['change_to_admin'])){
    $theuserId = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$theuserId}";
    $changeAdminQuery = mysqli_query($connection, $query);
    header("Location: users.php");

}


?>