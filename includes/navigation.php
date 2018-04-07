<?php //include "./admin/includes/functions.php"; ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS HOME</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                    $query = "SELECT * FROM categories";
                    $selectAllCategoriesQuery = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($selectAllCategoriesQuery)) {
                        $catTitle = escape($row['cat_title']);
                        $catId = escape($row['cat_id']);
                        $categoryClass = '';
                        $registrationClass = '';
                        $contactClass = '';
                        $pageName = basename($_SERVER['PHP_SELF']);
                        $registration = 'registration.php';
                        $contact = 'contact.php';
                        if(isset($_GET['category']) && $_GET['category'] == $catId) {
                            $categoryClass = 'active';
                        } else if ($pageName == $registration) {
                            $registrationClass = 'active';
                        } else if ($pageName == $contact) {
                            $contactClass = 'active';
                        }
                        echo "<li class='{$categoryClass}'><a href='category.php?category={$catId}'>{$catTitle}</a></li>";
                    }
                    ?>


                    <li>
                        <a href="admin">Admin</a>
                    </li>

                    <li class='<?php echo $registrationClass; ?>'>
                        <a href="registration.php">Registration</a>
                    </li>
                    <?php 
                    if (isset($_SESSION['userRole'])) {
                        if (isset($_GET['p_id'])) {
                            $postId = escape($_GET['p_id']);
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$postId}'>Edit Post</a></li>";

                        }


                    }
                    
                    
                    ?>
                    <li class='<?php echo $contactClass?>'>
                        <a href="contact.php">Contact</a>
                    </li> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>