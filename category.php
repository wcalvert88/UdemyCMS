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

            if(isset($_GET['category'])) {
                $postCategoryId = escape($_GET['category']);
            }

            $query = "SELECT * FROM posts WHERE post_category_id = {$postCategoryId} AND post_status = 'Published' ";
            $selectAllPostsQueryCount = mysqli_query($connection, $query);
            $count = mysqli_num_rows($selectAllPostsQueryCount);
            $count = ceil($count / $perPage);

            $query .= "ORDER BY post_date DESC LIMIT {$page1},$perPage ";
            $selectAllPostsQuery = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
                $postId = escape($row['post_id']);
                $postTitle = escape($row['post_title']);
                $postAuthor = escape($row['post_author']);
                $postDate = escape($row['post_date']);
                $postImage = escape($row['post_image']);
                $postContent = escape(substr($row['post_content'], 0, 100));
                
                ?>

                <h1 class="page-header">
                <?php
                $titleQuery = "SELECT * FROM categories WHERE cat_id = $postCategoryId";
                $getCatTitle = mysqli_query($connection, $titleQuery);
                $rowCat = mysqli_fetch_assoc($getCatTitle);
                $catTitle = escape($rowCat['cat_title']);
                echo $catTitle; 
                ?>
                <!-- <small>Secondary Text</small> -->
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $postId; ?>"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $postId; ?>">
                <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt=""></a>
                <hr>
                <p><?php echo $postContent ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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