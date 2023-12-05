<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
        </div>
        <div class="card-body">
            <?php

            if (isset($_POST['edit_data_btn'])) {
                $id = $_POST['edit_id'];

                $query = "SELECT * FROM `prodcut` WHERE pid='$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
                    ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="edit_id" value="<?php echo $row['pid'] ?>">

                        <div class="form-group">
                            <label> Product Name </label>
                            <input type="text" name="edit_product" value="<?php echo $row['productname'] ?>"
                                class="form-control" placeholder="Enter Product">
                        </div>
                        <div class="form-group">
                            <label>Product Designation</label>
                            <input type="text" name="edit_designation" value="<?php echo $row['productdesignation'] ?>"
                                class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <input type="text" name="edit_description" value="<?php echo $row['productdescription'] ?>"
                                class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="product_image" id="product_image"
                                value="<?php echo $row['prodcutimage'] ?>" class="form-control">
                        </div>
                        <select name="category_id" class="form-control" required>
                            <?php
                            $category_query = "SELECT * FROM `categorytb`";
                            $category_result = mysqli_query($connection, $category_query);
                            while ($category_row = mysqli_fetch_assoc($category_result)) {
                                echo '<option value="' . $category_row['cid'] . '">' . $category_row['catname'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="mt-3">
                            <a href="product.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="updateprodcutbtn" class="btn btn-primary"> Update </button>
                        </div>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>