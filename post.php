<?php 
include "includes/db.php";
include "includes/header.php";

?>
<!-- Navigation -->
<?php 
include "includes/navigation.php";

?>

<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
        <?php 
        if(isset($_GET['p_id'])) {
            $postId = escape($_GET['p_id']);
        
            $viewQuery = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$postId} ";
            $sendQuery = mysqli_query($connection, $viewQuery);

            if (!$sendQuery) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

            if (isset($_SESSION['userRole'])) {
                if ($_SESSION['userRole'] == 'Admin') {

                $query = "SELECT * FROM posts WHERE post_id = {$postId} ";

            }} else {
                $query = "SELECT * FROM posts WHERE post_id = {$postId} AND post_status = 'Published' ";
            }
        $selectAllPostsQuery = mysqli_query($connection, $query);
        if(mysqli_num_rows($selectAllPostsQuery) < 1) {

            echo "<h1 class='text-center'>Post Not Published</h1>";
        } else { 
        while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
            $postTitle = escape($row['post_title']);
            $postAuthor = escape($row['post_author']) ?: escape($row['post_user']);
            $postDate = escape($row['post_date']);
            $postImage = escape($row['post_image']);
            $postContent = escape($row['post_content']);
            
            ?>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $postTitle ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $postAuthor ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">
            <hr>
            <p><?php echo $postContent ?></p>
            <hr>
        <?php
        }
        ?>
        
        <!-- Blog Comments -->
        <?php 
        
        if(isset($_POST['create_comment'])) {
            $postId = escape($_GET['p_id']);
            $commentAuthor = escape($_POST['comment_author']);
            $commentEmail = escape($_POST['comment_email']);
            $commentContent = escape($_POST['comment_content']);
            $commentContent = trim(str_replace("<p>&nbsp;</p>", "", $commentContent));

            if(!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent) && $commentContent != '') {
            
                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                
                $query .= "VALUES  ('{$postId}', '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', 'unapproved', now() ) ";

                $createCommentQuery = mysqli_query($connection,$query);
                if (!$createCommentQuery) {
                    die("QUERY FAILED". mysqli_error($connection));
                }
            } else {
                echo "<script>alert('Fields Cannot Be Empty');</script>";
            }
        }
        
        ?>
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form action="" method="post" role="form">

                <div class="form-group">
                    <label for="Author">Author</label>
                    <input type="text" name="comment_author"
                class="form-control">
                </div>

                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" name="comment_email"
                class="form-control">
                </div>

                <div class="form-group">
                    <label for="comment">Your Commment</label>
                    <textarea name="comment_content" class="form-control" rows="3" id="body"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
            </form>
        </div>
        <hr>
        <!-- Posted Comments -->
        
        <?php 

    $query = "SELECT * FROM comments WHERE comment_post_id = {$postId} ";
    $query .= "AND comment_status = 'approved' ";
    $query .= "ORDER BY comment_id DESC ";
    $selectCommentQuery = mysqli_query($connection, $query);
    if (!$selectCommentQuery) {
        die ("QUERY FAILED" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_array($selectCommentQuery)) {
        $commentDate = escape($row['comment_date']);
        $commentContent = escape($row['comment_content']);
        $commentAuthor = escape($row['comment_author']);
        ?>
        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $commentAuthor; ?>
                    <small><?php echo $commentDate; ?></small>
                </h4>
                <?php echo $commentContent; ?>
            </div>
        </div>

    <?php
    }}} else {
        redirect("index.php");
    }
        ?>
        
    </div>
    <!-- Blog Sidebar Widgets Column -->
    <?php 
    include "includes/sidebar.php"
    ?>

</div>
<!-- /.row -->

<hr>

<?php 
include "includes/footer.php";
?>