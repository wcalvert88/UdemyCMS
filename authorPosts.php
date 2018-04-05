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
                $postAuthor = escape($_GET['author']);
            }



        $query = "SELECT * FROM posts WHERE post_author = '{$postAuthor}' OR post_user = '{$postAuthor}' ";
            $selectAllPostsQuery = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
                $postTitle = escape($row['post_title']);
                $postAuthor = escape($row['post_author']);
                $postUser = escape($row['post_user']);
                $postDate = escape($row['post_date']);
                $postImage = escape($row['post_image']);
                $postContent = escape($row['post_content']);
                
                ?>

                <h1 class="page-header">
                Author Posts
                <!-- <small>Secondary Text</small> -->
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    All Posts by <?php if (!empty($postAuthor)) {
                        echo $postAuthor; 
                    } else {
                        echo $postUser;
                    } ?>
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