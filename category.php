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
            <?php
             if (is_admin($_SESSION['username'])) {

                $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? ORDER BY post_date DESC LIMIT ?, ? ");

            } else {
                $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ORDER BY post_date DESC LIMIT ?, ? ");
                $published = 'published';
            }
            if(isset($stmt1)) {
                mysqli_stmt_bind_param($stmt1, "iii", $postCategoryId, $page1, $perPage);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_bind_result($stmt1, $postId, $postTitle, $postAuthor, $postDate, $postImage, $postContent);
                
                mysqli_stmt_store_result($stmt1);
                $count = mysqli_stmt_num_rows($stmt1);
                $count = ceil($count / $perPage);
                mysqli_stmt_fetch($stmt1);
                $stmt = $stmt1;
            } else {
                mysqli_stmt_bind_param($stmt2, "isii", $postCategoryId, $published, $page1, $perPage);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $postId, $postTitle, $postAuthor, $postDate, $postImage, $postContent);
                
                mysqli_stmt_store_result($stmt2);
                $count = mysqli_stmt_num_rows($stmt2);
                $count = ceil($count / $perPage);
                mysqli_stmt_fetch($stmt2);
                $stmt = $stmt2;
            }
            // $selectAllPostsQueryCount = mysqli_query($connection, $query);
            // $count = mysqli_stmt_num_rows($stmt);
            // $count = ceil($count / $perPage);

            // $query .= "ORDER BY post_date DESC LIMIT {$page1},$perPage ";
            // $selectAllPostsQuery = mysqli_query($connection, $query);
            
            if(mysqli_stmt_num_rows($stmt) < 1) {

                echo "<h1 class='text-center'>No Published Posts in this Category</h1>";
            } else {
            while(mysqli_stmt_fetch($stmt)):
                ?>

                
                

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $postId; ?>"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="authorPosts.php?author=<?php echo $postAuthor; ?>"><?php echo $postAuthor ?></a>
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
            endwhile; } } else {
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
    <ul class="pager">
    <?php 
    for ($i = 1; $i <= $count; $i++) {
        
        if($i == $page) {
            
            echo "<li><a class='active_link' href='category.php?category={$postCategoryId}&page={$i}'>{$i}</a></li>";
        } else {


        echo "<li><a href='category.php?category={$postCategoryId}&page={$i}'>{$i}</a></li>";
        }
    }
    
    
    ?>



    </ul>

<?php 
include "includes/footer.php";
?>