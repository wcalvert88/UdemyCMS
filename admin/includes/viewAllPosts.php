<?php
if (isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue) {
        echo $checkBoxValue;


    }
}

?>
<form action="" method= "post">
<table class="table table-bordered table-hover">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulkOptions" id="">
            <option value="">Select Options</option>
            <option value="">Publish</option>
            <option value="">Draft</option>
            <option value="">Delete</option>
        
        </select>
    
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="add_post.php">Add New</a>
    </div>

    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * FROM posts";
        $selectPosts = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectPosts)) {
            $postId = $row['post_id'];
            $postAuthor = $row['post_author'];
            $postTitle = $row['post_title'];
            $postCategoryId = $row['post_category_id'];
            $postStatus = $row['post_status'];
            $postImage = $row['post_image'];
            $postTags = $row['post_tags'];
            $postCommentCount = $row['post_comment_count'];
            $postDate = $row['post_date'];
            echo "<tr>";

            ?>

                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $postId; ?>'></td>

            <?php
            echo "<td>{$postId}</td>";
            echo "<td>{$postAuthor}</td>";
            echo "<td>{$postTitle}</td>";


            $query = "SELECT * FROM categories WHERE cat_id = {$postCategoryId}";
            $selectCategoriesId = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($selectCategoriesId)) {
                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];


            echo "<td>{$catTitle}</td>";

            }


            echo "<td>{$postStatus}</td>";
            echo "<td><img width='100' src='../images/{$postImage}' alt='image'</td>";
            echo "<td>{$postTags}</td>";
            echo "<td>{$postCommentCount}</td>";
            echo "<td>{$postDate}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$postId}'>Edit</td>";
            echo "<td><a href='posts.php?delete={$postId}'>Delete</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</form>
<?php 
if(isset($_GET['delete'])){
    $thePostId = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$thePostId} ";
    $deleteQuery = mysqli_query($connection, $query);
    header("Location: posts.php");

}

?>