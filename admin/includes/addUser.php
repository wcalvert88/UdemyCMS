<?php 
if(isset($_POST['create_user'])) {

    $userFirstname = escape($_POST['user_firstname']);
    $userLastname = escape($_POST['user_lastname']);
    $userRole = escape($_POST['user_role']);
    // $postImage = $_FILES['image']['name'];
    // $postImageTemp = $_FILES['image']['tmp_name'];
    $username = escape($_POST['username']);
    $userEmail = escape($_POST['user_email']);
    $userPassword = escape($_POST['user_password']);
    $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 10));
    // $postDate = date('d-m-y');
    
//     move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";

    $query .= "VALUES('{$userFirstname}','{$userLastname}','{$userRole}','{$username}','{$userEmail}','{$userPassword}' ) ";

    $createUserQuery = mysqli_query($connection, $query);

    confirmQuery($createUserQuery);

    echo "User Created: " . "<a href='users.php'>View Users</a> " ;
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
            <option value="Admin">Admin</option>
            <option value="subsriber">Subscriber</option>

        </select>
    </div>

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
