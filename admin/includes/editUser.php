<?php 
if (isset($_GET['edit_user'])) {
    echo $userId = $_GET['edit_user'];
}
    if(isset($_POST['create_user'])) {

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

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";

        $query .= "VALUES('{$userFirstname}','{$userLastname}','{$userRole}','{$username}','{$userEmail}','{$userPassword}' ) ";

        $createUserQuery = mysqli_query($connection, $query);

        confirmQuery($createUserQuery);
    }


?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <br />
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <br />
        <select name="user_role" id="">
            <option value="subscriber">Select Options</options>
            <option value="admin">Admin</option>
            <option value="subsriber">Subscriber</option>

        </select>
    </div>





    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
        </input>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
        </input>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>

}
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

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";

        $query .= "VALUES('{$userFirstname}','{$userLastname}','{$userRole}','{$username}','{$userEmail}','{$userPassword}' ) ";

        $createUserQuery = mysqli_query($connection, $query);

        confirmQuery($createUserQuery);
    }


?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <br />
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <br />
        <select name="user_role" id="">
            <option value="subscriber">Select Options</options>
            <option value="admin">Admin</option>
            <option value="subsriber">Subscriber</option>

        </select>
    </div>





    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
        </input>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
        </input>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>
