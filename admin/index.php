<?php 
include "includes/adminHeader.php";
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

        <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class='huge'><?php echo $postCounts = recordCount('posts'); ?></div>
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

                            <div class='huge'><?php echo $commentCounts = recordCount('comments'); ?></div>
                            
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
                            

                            <div class='huge'><?php echo $userCounts = recordCount('users');?></div>
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
                            <div class='huge'><?php echo $categoryCounts = recordCount('categories'); ?></div>
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
    
    $postPublishedCounts = checkStatus('posts', 'post_status', 'published');

    $postDraftCounts = checkStatus('posts', 'post_status', 'draft');

    $commentUnapproveCounts = checkStatus('comments', 'comment_status', 'unapproved');
    
    $userRoleCounts = checkStatus('users', 'user_role', 'subscriber');
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script>
$(document).ready(function() {

    Pusher.logToConsole = true;
    var pusher = new Pusher('5484de4edf80a49f87c8', {
      cluster: 'us2',
      encrypted: true
    });

    var notificationChannel =  pusher.subscribe('notifications');

    notificationChannel.bind('new_user', function(notification){

    var message = notification.message;

    toastr.success(`${message} just registered`);

    });
})
</script>