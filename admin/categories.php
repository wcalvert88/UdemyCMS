<?php 
include "includes/adminHeader.php";
?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/adminNavigation.php"; ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <?php include "includes/adminHeading.php";?>
        <div class="col-xs-6">

            <?php 
            insertCategories();
            ?>

            <form action="" method="post">
            <div class="form-group">
            <label for="catTitle">Add Category</label>
            <input class="form-control" type="text" name="catTitle"></div>
            <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="Add Category"></div>
            </form>

            <?php // UPDATE AND INCLUDE QUERY
            if(isset($_GET['edit'])) {
                $catId = escape($_GET['edit']);
                include "includes/adminUpdateCat.php";
            }
            ?>




        </div><!-- Add Category Form-->
        <div class="col-xs-6"></div>
        <div class="col-xs-6">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Title</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                findAllCategories();
                deleteCategories();
                ?>
                </tbody>
            </table>
        </div>
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