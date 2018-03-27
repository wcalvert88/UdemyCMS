<?php 

    if(isset($_POST['create_post'])) {
        $postTitle = $_POST['title'];
        $postAuthor = $_POST['author'];
        $postCategoryId = $_POST['post_category_id'];
        $postStatus = $_POST['post_status'];

        $postImage = $_FILES['image']['name'];
        $postImageTemp = $_FILES['image']['tmp_name'];

        $postTags = $_POST['post_tags'];
        $postContent = $_POST['post_content'];
        $postDate = date('d-m-y');
        $postCommentCount = 4;
        
        move_uploaded_file($postImageTemp, "../images/$postImage");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";

        $query .= "VALUES({$postCategoryId},'{$postTitle}','{$postAuthor}',now(),'{$postImage}','{$postContent}','{$postTags}','{$postCommentCount}','{$postStatus}' ) ";

        $createPostQuery = mysqli_query($connection, $query);

        confirmQuery($createPostQuery);
    }


?>

<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <input type="text" class="form-control" name="post_category_id">
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
