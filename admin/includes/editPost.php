<?php 
if(isset($_GET['p_id'])) {
    $pId = escape($_GET['p_id']);
}
$query = "SELECT * FROM posts WHERE post_id = $pId";
$selectPostsById = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($selectPostsById)) {
    $postId = escape($row['post_id']);
    $postUser = escape($row['post_user']);
    $postTitle = escape($row['post_title']);
    $postCategoryId = escape($row['post_category_id']);
    $postStatus = escape($row['post_status']);
    $postImage = escape($row['post_image']);
    $postContent = escape($row['post_content']);
    $postTags = escape($row['post_tags']);
    $postCommentCount = escape($row['post_comment_count']);
    $postDate = escape($row['post_date']);
}

if (isset($_POST['update_post'])) {
    $postTitle = escape($_POST['title']);
    $postUser = escape($_POST['post_user']);
    $postCategoryId = escape($_POST['post_category']);
    $postStatus = escape($_POST['post_status']);

    $postImage = escape($_FILES['image']['name']);
    $postImageTemp = escape($_FILES['image']['tmp_name']);

    $postTags = escape($_POST['post_tags']);
    $postContent = escape($_POST['post_content']);

    move_uploaded_file($postImageTemp, "../images/$postImage");

    if (empty($postImage)) {
        $query = "SELECT * FROM posts WHERE post_id = $postId ";
        $selectImage = mysqli_query($connection, $query);
        
        while ($row = mysqli_fetch_array($selectImage)) {
            $postImage = escape($row['post_image']);
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$postTitle}', ";
    $query .= "post_category_id = '{$postCategoryId}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$postUser}', ";
    $query .= "post_status = '{$postStatus}', ";
    $query .= "post_tags = '{$postTags}', ";
    $query .= "post_content = '{$postContent}', ";
    $query .= "post_image = '{$postImage}' ";
    $query .= "WHERE post_id = {$pId} ";

    $updatePost = mysqli_query($connection, $query);

    confirmQuery($updatePost);

    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$postId}'>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";

}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Post Title</label>
        <input value="<?php echo $postTitle; ?>"type="text" class="form-control" name="title">
        <br />
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br />
        <select name="post_category" id="">
        <?php 
        
        $query = "SELECT * FROM categories";
        $selectCategories = mysqli_query($connection, $query);
        confirmQuery($selectCategories);
        while($row = mysqli_fetch_assoc($selectCategories)) {
            $catId = escape($row['cat_id']);
            $catTitle = escape($row['cat_title']);

            if($catId == $postCategoryId) {
                echo "<option selected value='{$catId}'>{$catTitle}</option>";
            } else {
                echo "<option value='$catId'>{$catTitle}</option>";
            }
        
        }
        
        ?>

        </select>
    </div>

    <!-- <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php //echo $postAuthor; ?>" type="text" class="form-control" name="author">
    </div> -->

    <div class="form-group">
        <label for="users">Users</label>
        <br />
        <select name="post_user" id="">
        <option value='<?php echo $postUser; ?>'><?php echo $postUser; ?></option>
        <?php 
        
        $query = "SELECT * FROM users";
        $selectUsers = mysqli_query($connection, $query);
        confirmQuery($selectUsers);
        while($row = mysqli_fetch_assoc($selectUsers)) {
            $userId = escape($row['user_id']);
            $username = escape($row['username']);

            echo "<option value='$username'>{$username}</option>";
        
        }
        
        ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br />
        <select name="post_status" id="">
            <option value='<?php echo $postStatus; ?>'><?php echo $postStatus; ?></option>
            <?php 
            if ($postStatus == 'Published') {
                echo "<option value='Draft'>Draft</option>";
            } else {
                echo "<option value='Published'>Published</option>";
            }
            
            ?>
        </select>
    </div>

    <div class="form-group">
    <label for="post_image">Edit Image</label><br />
        <img width="100" src="../images/<?php echo $postImage; ?>" alt=""><br />
        
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $postTags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $postContent ?>
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>
