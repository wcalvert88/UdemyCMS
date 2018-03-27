<?php 

function confirmQuery($result){
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }


}

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

function findAllCategories() {
    global $connection;
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
        echo "<td><a href='categories.php?edit={$catId}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories() {
    global $connection;
    // DELETE QUERY
    if(isset($_GET['delete'])) {
        $catIdDel = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$catIdDel} ";
    $deleteQuery = mysqli_query($connection,$query);
    header("Location: categories.php");
    }
}








?>