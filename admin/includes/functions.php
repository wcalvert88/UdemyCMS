<?php 
function insertCategories() {

    global $connection;
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
    
    
    
    




}













?>