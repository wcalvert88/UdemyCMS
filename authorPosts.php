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
    <h1 class="page-header">
    Author Posts
    <!-- <small>Secondary Text</small> -->
    </h1>
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php 
            $perPage = 5;
            if(isset($_GET['page'])) {

                
                $page = escape($_GET['page']);
            } else {
                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page1 = 0;
            } else {
                $page1 = ($page * $perPage) - $perPage;
            }
            if(isset($_GET['p_id'])) {
                $postId = escape($_GET['p_id']);
            }
            if(isset($_GET['author'])) {
                $postAuthor = escape($_GET['author']);
            }

            $query = "SELECT * FROM posts WHERE post_author = '{$postAuthor}' OR post_user = '{$postAuthor}' AND post_status = 'Published' ";
            $selectAllPostsQueryCount = mysqli_query($connection, $query);
            $count = mysqli_num_rows($selectAllPostsQueryCount);
            $count = ceil($count / $perPage);

            $query .= "ORDER BY post_date DESC LIMIT {$page1},$perPage ";
            $selectAllPostsQuery = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
                $postTitle = escape($row['post_title']);
                $postAuthor = escape($row['post_author']);
                $postUser = escape($row['post_user']);
                $postDate = escape($row['post_date']);
                $postImage = escape($row['post_image']);
                $postContent = escape($row['post_content']);
                
                ?>

                

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
    <ul class="pager">
    <?php 
    for ($i = 1; $i <= $count; $i++) {
        
        if($i == $page) {

            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
        } else {


        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
    }
    
    
    ?>



    </ul>
<?php 
include "includes/footer.php";
?>