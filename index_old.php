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
                
                $query = "SELECT * FROM posts ";
                $selectAllPostsQuery = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
                    $postId = escape($row['post_id']);
                    $postTitle = escape($row['post_title']);
                    $postAuthor = escape($row['post_author']);
                    $postDate = escape($row['post_date']);
                    $postImage = escape($row['post_image']);
                    $postContent = escape(substr($row['post_content'], 0, 100));
                    $postStatus = escape($row['post_status']);

                    if ($postStatus == 'Published') {
                    
                    ?>

                    <h1 class="page-header">
                    CMS Home Page
                    <!-- <small>Secondary Text</small> -->
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $postId; ?>"><?php echo $postTitle; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="authorPosts.php?author=<?php echo $postAuthor; ?>&p_id=<?php echo $postId; ?>"><?php echo $postAuthor; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $postId; ?>">
                    <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt=""></a>
                    <hr>
                    <p><?php echo $postContent ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $postId; ?>">Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                        
                    <hr>
                <?php
                }}
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