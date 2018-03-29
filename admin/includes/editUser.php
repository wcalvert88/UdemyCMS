<?php 
if(isset($_GET['p_id'])) {
    $pId = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $pId";
$selectPostsById = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($selectPostsById)) {
    $postId = $row['post_id'];
    $postAuthor = $row['post_author'];
    $postTitle = $row['post_title'];
    $postCategoryId = $row['post_category_id'];
    $postStatus = $row['post_status'];
    $postImage = $row['post_image'];
    $postContent = $row['post_content'];
    $postTags = $row['post_tags'];
    $postCommentCount = $row['post_comment_count'];
    $postDate = $row['post_date'];
}

if (isset($_POST['update_post'])) {
    $postTitle = $_POST['title'];
    $postAuthor = $_POST['author'];
    $postCategoryId = $_POST['post_category'];
    $postStatus = $_POST['post_status'];

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postTags = $_POST['post_tags'];
    $postContent = $_POST['post_content'];

    move_uploaded_file($postImageTemp, "../images/$postImage");

    if (empty($postImage)) {
        $query = "SELECT * FROM posts WHERE post_id = $postId ";
        $selectImage = mysqli_query($connection, $query);
        
        while ($row = mysqli_fetch_array($selectImage)) {
            $postImage = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$postTitle}', ";
    $query .= "post_category_id = '{$postCategoryId}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$postAuthor}', ";
    $query .= "post_status = '{$postStatus}', ";
    $query .= "post_tags = '{$postTags}', ";
    $query .= "post_content = '{$postContent}', ";
    $query .= "post_image = '{$postImage}' ";
    $query .= "WHERE post_id = {$pId} ";

    $updatePost = mysqli_query($connection, $query);

    confirmQuery($updatePost);

}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Post Title</label>
        <input value="<?php echo $postTitle; ?>"type="text" class="form-control" name="title">
        <br />
    </div>

    <div class="form-group">
        <select name="post_category" id="">
        <?php 
        
        $query = "SELECT * FROM categories";
        $selectCategories = mysqli_query($connection, $query);
        confirmQuery($selectCategories);
        while($row = mysqli_fetch_assoc($selectCategories)) {
            $catId = $row['cat_id'];
            $catTitle = $row['cat_title'];

            echo "<option value='$catId'>{$catTitle}</option>";
        
        }
        
        ?>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $postAuthor; ?>" type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $postStatus; ?>" type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $postImage; ?>" alt=""><br />
        <label for="post_image">Edit Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $postTags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $postContent ?>
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>
