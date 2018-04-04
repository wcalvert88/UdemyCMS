<?php 
include "includes/adminHeader.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $selectUserProfileQuery = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($selectUserProfileQuery)) {
        $userId = $row['user_id'];
        $username = $row['username'];
        $userPassword = $row['user_password'];
        $userFirstname = $row['user_firstname'];
        $userLastname = $row['user_lastname'];
        $userEmail = $row['user_email'];
        //$userImage = $row['user_image'];
        $userRole = $row['user_role'];
    }
}
?>
<?php 

if(isset($_POST['edit_user'])) {

    $userFirstname = $_POST['user_firstname'];
    $userLastname = $_POST['user_lastname'];
    $userRole = $_POST['user_role'];

    // $postImage = $_FILES['image']['name'];
    // $postImageTemp = $_FILES['image']['tmp_name'];
    $username = $_POST['username'];
    $userEmail = $_POST['user_email'];
    $userPassword = $_POST['user_password'];
    // $postDate = date('d-m-y');
    
//     move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$userFirstname}', ";
    $query .= "user_lastname = '{$userLastname}', ";
    $query .= "user_role = '{$userRole}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$userEmail}', ";
    $query .= "user_password = '{$userPassword}' ";
    $query .= "WHERE username = '{$username}' ";

    $editUserQuery = mysqli_query($connection, $query);
    confirmQuery($editUserQuery);
}

?>
<div id="wrapper">

<!-- Navigation -->
<?php include "includes/adminNavigation.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php include "includes/adminHeading.php"; ?>
                
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user_firstname">Firstname</label>
                <input type="text" class="form-control" name="user_firstname" value=<?php echo $userFirstname;?>>
            </div>
            <br />
            <div class="form-group">
                <label for="user_lastname">Lastname</label>
                <input type="text" class="form-control" name="user_lastname" value=<?php echo $userLastname;?>>
            </div>

            <div class="form-group">
                <label for="user_role">User Role</label>
                <br />
                <select name="user_role" id="">
                    <option value="<?php echo $userRole; ?>"><?php echo $userRole; ?></options>
                    <?php
                    if ($userRole == 'Admin') {
                        echo "<option value='Subsriber'>Subscriber</option>";
                    } else {
                    echo "<option value='Admin'>Admin</option>";
                    }
                    ?>

                </select>
            </div>

            <!-- <div class="form-group">
                <label for="post_image">Post Image</label>
                <input type="file" name="image">
            </div> -->

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value=<?php echo $username;?>>
            </div>

            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" class="form-control" name="user_email" value=<?php echo $userEmail;?>>
                </input>
            </div>

            <div class="form-group">
                <label for="user_password">Password</label>
                <input type="password" class="form-control" name="user_password" value=<?php echo $userPassword;?>>
                </input>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
            </div>
        </form>

    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php 
include "includes/adminFooter.php";
?>