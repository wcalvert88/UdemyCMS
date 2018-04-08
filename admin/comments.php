<?php 
include "includes/adminHeader.php";
if(!is_admin($_SESSION['username'])) {
    header("Location: index.php");
}
?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/adminNavigation.php"; ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php include "includes/adminHeading.php"; ?>

        <?php 
        
        if (isset($_GET['source'])) {

            $source = escape($_GET['source']);

        } else {
            $source = '';
        }
        
        switch($source) {
            case "add_post";
                include "includes/addPost.php";
                break;
            case "edit_post";
                include "includes/editPost.php";
                break;
            default;
                include "includes/viewAllComments.php";
                break;
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