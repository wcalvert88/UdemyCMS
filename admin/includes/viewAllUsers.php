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


            echo "<td><a href='users.php?approve={$userId}'>Approve</td>";
            echo "<td><a href='users.php?unapprove={$userId}'>Unapprove</td>";
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

if(isset($_GET['unapprove'])){
    $theuserId = $_GET['unapprove'];
$query = "UPDATE users SET user_status = 'unapproved' WHERE user_id = {$theuserId}";
    $unapproveQuery = mysqli_query($connection, $query);
    if (!$unapproveQuery) {
        die ("QUERY FAILED" . mysqli_error($connection));
    } else {
        echo "UNAPPROVED";
    }
    header("Location: users.php");

}

if(isset($_GET['approve'])){
    $theuserId = $_GET['approve'];
    $query = "UPDATE users SET user_status = 'approved' WHERE user_id = {$theuserId}";
    $approveQuery = mysqli_query($connection, $query);
    header("Location: users.php");

}


?>