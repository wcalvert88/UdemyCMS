<?php
if (isset($_POST['checkBoxArray'])){
    $postCheckBoxArray = escape($_POST['checkBoxArray']);
    foreach($postCheckBoxArray as $postValueId) {
        $bulkOptions = escape($_POST['bulkOptions']);

        switch ($bulkOptions) {
            case 'Published':
                $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = '{$postValueId}'";
                $updateToPublishedStatus = mysqli_query($connection, $query);
                confirmQuery($updateToPublishedStatus);
                break;
            case 'Draft':
                $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = '{$postValueId}'";
                $updateToDraftStatus = mysqli_query($connection, $query);
                confirmQuery($updateToDraftStatus);
                break;

            case 'Delete':
                $query = "DELETE FROM posts WHERE post_id = '{$postValueId}'";
                $updateToDeleteStatus = mysqli_query($connection, $query);
                confirmQuery($updateToDeleteStatus);
                break;
            
            case 'Clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $selectPostQuery = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($selectPostQuery)) {
                    $postTitle = escape($row['post_title']);
                    $postCategoryId = escape($row['post_category_id']);
                    $postDate = escape($row['post_date']);
                    $postAuthor = escape($row['post_author']);
                    $postStatus = escape($row['post_status']);
                    $postImage = escape($row['post_image']);
                    $postTags = escape($row['post_tags']);
                    $postContent = escape($row['post_content']);
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES({$postCategoryId}, '{$postTitle}', '{$postAuthor}', '{$postDate}', '{$postImage}', '{$postContent}', '{$postTags}','{$postStatus}') ";

                $copyQuery = mysqli_query($connection, $query);
                if(!$copyQuery) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                break;
        }

    }
}

?>
<form action="" method= "post">
<table class="table table-bordered table-hover">
    <div class="row">
        <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulkOptions" id="">
            <option value="">Select Options</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
            <option value="Delete">Delete</option>
            <option value="Clone">Clone</option>
        </select>
        </div>
        
        <div class="col-xs-4" style="padding: 0px;">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
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
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Views</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * FROM posts ORDER BY post_id DESC ";
        $selectPosts = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectPosts)) {
            $postId = escape($row['post_id']);
            $postAuthor = escape($row['post_author']);
            $postUser = escape($row['post_user']);
            $postTitle = escape($row['post_title']);
            $postCategoryId = escape($row['post_category_id']);
            $postStatus = escape($row['post_status']);
            $postImage = escape($row['post_image']);
            $postTags = escape($row['post_tags']);
            $postCommentCount = escape($row['post_comment_count']);
            $postDate = escape($row['post_date']);
            $postViewsCount = escape($row['post_views_count']);
            echo "<tr>";

            ?>

                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $postId; ?>'></td>

            <?php
            echo "<td>{$postId}</td>";

            if(!empty($postAuthor)) {
                
                echo "<td>{$postAuthor}</td>";

            } elseif (!empty($postUser)){
                echo "<td>{$postUser}</td>";

            }
            
            
            echo "<td>{$postTitle}</td>";


            $query = "SELECT * FROM categories WHERE cat_id = {$postCategoryId}";
            $selectCategoriesId = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($selectCategoriesId)) {
                $catId = escape($row['cat_id']);
                $catTitle = escape($row['cat_title']);


            echo "<td>{$catTitle}</td>";

            }


            echo "<td>{$postStatus}</td>";
            echo "<td><img width='100' src='../images/{$postImage}' alt='image'</td>";
            echo "<td>{$postTags}</td>";

            $query = "SELECT * FROM comments WHERE comment_post_id = $postId";
            $sendCommentQuery = mysqli_query($connection, $query);

            $row = mysqli_fetch_array($sendCommentQuery);
            $commentId = escape($row['comment_id']);
            $countComments = mysqli_num_rows($sendCommentQuery);
            echo "<td><a href='postComments.php?id=$postId'>$countComments</a></td>";
            
            
            
            
            echo "<td>{$postDate}</td>";
            echo "<td><a href='../post.php?p_id={$postId}'>View Post</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$postId}'>Edit</td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \"href='posts.php?delete={$postId}'>Delete</td>";
            echo "<td><a href='posts.php?reset={$postId}'>{$postViewsCount}</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</form>
<?php 
if(isset($_GET['delete'])){
    $thePostId = escape($_GET['delete']);
    $query = "DELETE FROM posts WHERE post_id = {$thePostId} ";
    $deleteQuery = mysqli_query($connection, $query);
    header("Location: posts.php");

}

if(isset($_GET['reset'])){
    $thePostId = escape($_GET['reset']);
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$thePostId} ";
    $resetQuery = mysqli_query($connection, $query);
    header("Location: posts.php");

}

?>