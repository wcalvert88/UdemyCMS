<?php 
include "includes/adminHeader.php";
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/adminNavigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">

                            <?php 
                            if (isset($_POST['submit'])) {
                                $catTitle = $_POST['catTitle'];

                                if ($catTitle == "" || empty($catTitle)) {

                                    echo "This field should not be empty";
                                } else {
                                    $query = "INSERT INTO categories(cat_title) ";
                                    $query .= "VALUE('{$catTitle}')";
                                    $createCategoryQuery = mysqli_query($connection, $query);
                                    if (!$createCategoryQuery) {
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                }




                            }
                            
                            
                            
                            
                            ?>






                            <form action="" method="post">
                            <div class="form-group">
                            <label for="catTitle">Add Category</label>
                            <input class="form-control" type="text" name="catTitle"></div>
                            <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category"></div>
                            </form>
                        </div><!-- Add Category Form-->
<div class="col-xs-6"></div>
<?php 
    
    
    ?>
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
                                // FIND ALL CATEGORIES QUERY.
                                $query = "SELECT * FROM categories";
                                $selectCategories = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($selectCategories)) {
                                    $catId = $row['cat_id'];
                                    $catTitle = $row['cat_title'];
                                    echo "<tr>";
                                    echo "<td>{$catId}</td>";
                                    echo "<td>{$catTitle}</td>";
                                    echo "<td><a href='categories.php?delete={$catId}'>Delete</a></td>";
                                    echo "</tr>";
                                }
                                ?>

                                <?php // DELETE QUERY
                                if(isset($_GET['delete'])) {
                                    $catIdDel = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE cat_id = {$catIdDel} ";
                                $deleteQuery = mysqli_query($connection,$query);
                                header("Location: categories.php");
                                }
                                
                                
                                
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