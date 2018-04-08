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
            $commentId = escape($row['comment_id']);
            $commentPostId = escape($row['comment_post_id']);
            $commentAuthor = escape($row['comment_author']);
            $commentContent = escape($row['comment_content']);
            $commentEmail = escape($row['comment_email']);
            $commentStatus = escape($row['comment_status']);
            $commentDate = escape($row['comment_date']);

            echo "<tr>";
            echo "<td>{$commentId}</td>";
            echo "<td>{$commentAuthor}</td>";
            echo "<td>{$commentContent}</td>";
            echo "<td>{$commentEmail}</td>";
            echo "<td>{$commentStatus}</td>";

            $query = "SELECT * FROM posts WHERE post_id = {$commentPostId} ";
            $selectPostIdQuery = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($selectPostIdQuery)) {
                $postId = escape($row['post_id']);
                $postTitle = escape($row['post_title']);
            }

            echo "<td><a href='../post.php?p_id={$postId}'>$postTitle</a></td>";
            echo "<td>{$commentDate}</td>";
            echo "<td><a class='btn btn-primary' href='comments.php?approve={$commentId}'>Approve</td>";
            echo "<td><a class='btn btn-primary' href='comments.php?unapprove={$commentId}'>Unapprove</td>";
            ?>
            <form method="post">
                <input type="hidden" name="comment_id" value="<?php echo $commentId; ?>">

                <?php echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>'; ?>
            </form>
            <?php echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php 
if(isset($_POST['delete'])){
    $theCommentId = escape($_POST['comment_id']);
    $query = "DELETE FROM comments WHERE comment_id = {$theCommentId} ";
    $deleteQuery = mysqli_query($connection, $query);
    redirect("comments.php");
}

if(isset($_GET['unapprove'])){
    $theCommentId = escape($_GET['unapprove']);
$query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$theCommentId}";
    $unapproveQuery = mysqli_query($connection, $query);
    if (!$unapproveQuery) {
        die ("QUERY FAILED" . mysqli_error($connection));
    } else {
        echo "UNAPPROVED";
    }
    redirect("comments.php");
}

if(isset($_GET['approve'])){
    $theCommentId = escape($_GET['approve']);
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$theCommentId}";
    $approveQuery = mysqli_query($connection, $query);
    redirect("comments.php");
}
?>