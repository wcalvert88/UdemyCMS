<form action="" method="post">
    <div class="form-group">
    <label for="catTitle">Edit Category</label>
    <?php 
    if (isset($_GET['edit'])) {
        $catId = escape($_GET['edit']);
        $query = "SELECT * FROM categories WHERE cat_id = {$catId}";
        $selectCategoriesId = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectCategoriesId)) {
            $catId = escape($row['cat_id']);
            $catTitle = escape($row['cat_title']);

            ?>
            <input value="<?php if(isset($catTitle)) { echo $catTitle;} ?>" class="form-control" type="text" name="catTitle">
            <?php
        }
    }
    ?>

    <?php 
    // UPDATE QUERY
    if(isset($_POST['updateCategory'])) {
        $catTitle = escape($_POST['catTitle']);
        $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");
        mysqli_stmt_bind_param($stmt, 'si', $catTitle, $catId);
        mysqli_stmt_execute($stmt);
        if (!$stmt) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
        redirect("categories.php");
    }
    
    ?>
    </div>
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="updateCategory" value="Update Category"></div>
</form>