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

                        <?php 
                        
                        if (isset($_GET['source'])) {

                            $source = $_GET['source'];

                        } else {
                            $source = '';
                        }
                        
                        switch($source) {
                            case "34";
                                echo "34";
                                break;
                            case "100";
                                echo "100";
                                break;
                            case "200";
                                echo "200";
                                break;
                            default;
                                include "includes/viewAllPosts.php";
                                break;

                        }
                        
                        
                        
                        
                        
                        ?>





                                    <td>10</td>
                                    <td>Bootstrap framework</td>
                                    <td>Edwin Diaz</td>
                                    <td>Bootstrap</td>
                                    <td>Status</td>
                                    <td>Image</td>
                                    <td>Tags</td>
                                    <td>Comments</td>
                                    <td>Date</td>
                                
                            </tbody>
                        </table>
                        
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