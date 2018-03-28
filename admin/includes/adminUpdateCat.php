<form action="" method="post">
    <div class="form-group">
    <label for="catTitle">Edit Category</label>
    <?php 
    if (isset($_GET['edit'])) {
        $catId = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = {$catId}";
        $selectCategoriesId = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectCategoriesId)) {
            $catId = $row['cat_id'];
            $catTitle = $row['cat_title'];

            ?>
            <input value="<?php if(isset($catTitle)) { echo $catTitle;} ?>" class="form-control" type="text" name="catTitle">
            <?php
        }
    }
    ?>

    <?php 
    // UPDATE QUERY
    if(isset($_POST['updateCategory'])) {
        $catTitleEdit = $_POST['catTitle'];
        $query = "UPDATE categories SET cat_title = '{$catTitleEdit}'WHERE cat_id = {$catId} ";
        $updateQuery = mysqli_query($connection,$query);
        if (!$updateQuery) {
            die("Update Query Failed" . mysqli_error($connection));
        }
    }
    
    ?>
    </div>
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="updateCategory" value="Update Category"></div>
</form>