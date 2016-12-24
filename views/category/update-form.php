<?php
include_once '../../models/Include.php';
error_reporting(0);
// get category id
$categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : die('ERROR: Category ID not found');

$category->categoryId = $categoryId;

$category->showOne();

?>
<h1>Update Category: <?php echo $category->categoryName; ?></h1>
<form id='update_category' action='javascript://' method='POST' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Category Name</td>
                <td><input type="text" name="categoryName" class='form-control' value="<?php echo $category->categoryName; ?>"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="<?php echo $category->description; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="categoryId" value="<?php echo $categoryId;?>" /></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Save Changes</button></td>
            </tr>       
        </table>    
    </form>