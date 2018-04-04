<?php 
include "includes/adminHeader.php";
?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/adminNavigation.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php include "includes/adminHeading.php"; ?>


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
        $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . " ";
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
            echo "<td><a href='comments.php?approve={$commentId}'>Approve</td>";
            echo "<td><a href='comments.php?unapprove={$commentId}'>Unapprove</td>";
            echo "<td><a href='comments.php?delete={$commentId}'>Delete</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php 
if(isset($_GET['delete'])){
    $theCommentId = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$theCommentId} ";
    $deleteQuery = mysqli_query($connection, $query);

    header("Location: comments.php");

}

if(isset($_GET['unapprove'])){
    $theCommentId = $_GET['unapprove'];
$query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$theCommentId}";
    $unapproveQuery = mysqli_query($connection, $query);
    if (!$unapproveQuery) {
        die ("QUERY FAILED" . mysqli_error($connection));
    } else {
        echo "UNAPPROVED";
    }
    header("Location: comments.php");

}

if(isset($_GET['approve'])){
    $theCommentId = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$theCommentId}";
    $approveQuery = mysqli_query($connection, $query);
    header("Location: comments.php");

}


?>
    
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