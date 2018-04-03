<?php 
include "includes/adminHeader.php";
?>
<?php 
$session = session_id();
$time = time();
$timeOutInSeconds = 60;
$timeOut = $time - $timeOutInSeconds;

$query = "SELECT * FROM users_online WHERE session = '$session'";
$sendQuery = mysqli_query($connection, $query);
$count = mysqli_num_rows($sendQuery);

if ($count == NULL) {
    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
} else {    
    mysqli_query($connection, "UPDATE users_online SET time = '{$time}' WHERE session = '$session'");
}

$usersOnlineQuery = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$timeOut'");
$countUser = mysqli_num_rows($usersOnlineQuery);


?>
<div id="wrapper">

<!-- Navigation -->
<?php include "includes/adminNavigation.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php
        include "includes/adminHeading.php";
        
        ?>
        
        <!-- /.row -->
    
        <!-- /.row -->
        
        <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <?php 
                            
                            $query = "SELECT * FROM posts";
                            $selectAllPosts = mysqli_query($connection, $query);
                            $postCounts = mysqli_num_rows($selectAllPosts);

                            echo "<div class='huge'>{$postCounts}</div>";
                            ?>
                            <div>Posts</div>
                        </div>
                    </div>
                </div>
                <a href="posts.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <?php 
                            
                            $query = "SELECT * FROM comments";
                            $selectAllComments = mysqli_query($connection, $query);
                            $commentCounts = mysqli_num_rows($selectAllComments);

                            echo "<div class='huge'>{$commentCounts}</div>";
                            ?>

                        <div>Comments</div>
                        </div>
                    </div>
                </div>
                <a href="comments.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <?php 
                            
                            $query = "SELECT * FROM users";
                            $selectAllUsers = mysqli_query($connection, $query);
                            $userCounts = mysqli_num_rows($selectAllUsers);

                            echo "<div class='huge'>{$userCounts}</div>";
                            ?>
                            <div> Users</div>
                        </div>
                    </div>
                </div>
                <a href="users.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <?php 
                            
                            $query = "SELECT * FROM categories";
                            $selectAllCategories = mysqli_query($connection, $query);
                            $categoryCounts = mysqli_num_rows($selectAllCategories);

                            echo "<div class='huge'>{$categoryCounts}</div>";
                            ?>
                            <div>Categories</div>
                        </div>
                    </div>
                </div>
                <a href="categories.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
        <!-- /.row -->

    <?php 
    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
    $selectAllPublishedPosts = mysqli_query($connection, $query);
    $postPublishedCounts = mysqli_num_rows($selectAllPublishedPosts);

    $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
    $selectAllDraftPosts = mysqli_query($connection, $query);
    $postDraftCounts = mysqli_num_rows($selectAllDraftPosts);

    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
    $selectAllCommentUnapprove = mysqli_query($connection, $query);
    $commentUnapproveCounts = mysqli_num_rows($selectAllCommentUnapprove);
    
    $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
    $selectAllUserRole = mysqli_query($connection, $query);
    $userRoleCounts = mysqli_num_rows($selectAllUserRole);
    ?>



    <div class="row">
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

            <?php 
            
            $elementText = ['All Posts', 'Active Posts', 'Draft Posts','Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
            $elementCount = [$postCounts, $postPublishedCounts, $postDraftCounts, $commentCounts, $commentUnapproveCounts, $userCounts, $userRoleCounts, $categoryCounts];

            for ($i = 0; $i < count($elementText); $i++) {
                echo "['{$elementText[$i]}'" . "," . "{$elementCount[$i]}],";
            }            
            ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php 
include "includes/adminFooter.php";
?>