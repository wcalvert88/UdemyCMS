<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * FROM comments";
        $selectComments = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectComments)) {
            $commentId = $row['comment_id'];
            $commentPostId = $row['comment_post_id'];
            $commentAuthor = $row['comment_author'];
            $commentContent = $row['comment_content'];
            $commentEmail = $row['comment_email'];
            $commentStatus = $row['comment_status'];
            $commentDate = $row['comment_date'];

            echo "<tr>";
            echo "<td>{$commentId}</td>";
            echo "<td>{$commentAuthor}</td>";
            echo "<td>{$commentContent}</td>";
            

            // $query = "SELECT * FROM categories WHERE cat_id = {$postCategoryId}";
            // $selectCategoriesId = mysqli_query($connection, $query);
            // while($row = mysqli_fetch_assoc($selectCategoriesId)) {
            //     $catId = $row['cat_id'];
            //     $catTitle = $row['cat_title'];


            // echo "<td>{$catTitle}</td>";

            // }


            echo "<td>{$commentEmail}</td>";
            echo "<td>{$commentStatus}</td>";

            $query = "SELECT * FROM posts WHERE post_id = {$commentPostId} ";
            $selectPostIdQuery = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($selectPostIdQuery)) {
                $postId = $row['post_id'];
                $postTitle = $row['post_title'];

            }




            echo "<td><a href='../post.php?p_id={$postId}'>$postTitle</a></td>";
            echo "<td>{$commentDate}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id='>Approve</td>";
            echo "<td><a href='posts.php?delete='>Unapprove</td>";
            echo "<td><a href='posts.php?delete='>Delete</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php 
if(isset($_GET['delete'])){
    $thePostId = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$thePostId} ";
    $deleteQuery = mysqli_query($connection, $query);
    header("Location: posts.php");

}

?>