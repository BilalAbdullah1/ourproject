<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

          <div class="form-group">
            <label> Product Name </label>
            <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
          </div>
          <div class="form-group">
            <label>Designation</label>
            <input type="text" name="product_designation" class="form-control" placeholder="Product Designation"
              required>
          </div>
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="product_description" class="form-control" placeholder="Product Description"
              required>
          </div>
          <div class="form-group">
            <label>Upload Image</label>
            <input type="file" name="product_image" id="product_image" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
              <?php
              $category_query = "SELECT * FROM `categorytb`";
              $category_result = mysqli_query($connection, $category_query);
              while ($category_row = mysqli_fetch_assoc($category_result)) {
                echo '<option value="' . $category_row['cid'] . '">' . $category_row['catname'] . '</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="productaddbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
  DataTales Example
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Admin Profile
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
          Add Admin Profile
        </button>
      </h6>
    </div>

    <div class="card-body">
      <?php
      if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
        echo '<h2>' . $_SESSION['success'] . '</h2>';
        unset($_SESSION['success']);
      }
      if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        echo '<h2 class= "bg-info">' . $_SESSION['status'] . '</h2>';
        unset($_SESSION['status']);
      }
      ?>

      <div class="card-body">
        <form action="" method="GET" id="searchForm" class="mb-3">
          <div class="input-group">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search by product name">
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </div>
        </form>
      </div>

      <?php
      $query = "SELECT p.*, c.catname FROM prodcut p LEFT JOIN categorytb c ON p.category_id = c.cid";
      if (isset($_GET['search'])) {
        $filter = mysqli_real_escape_string($connection, $_GET['search']);
        $query .= " WHERE CONCAT(productname, productdesignation, productdescription, catname) LIKE '%$filter%'";
      }

      $query_result = mysqli_query($connection, $query);
      if (mysqli_num_rows($query_result) > 0) {
      ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Productid</th>
              <th>Product</th>
              <th>Designation </th>
              <th>Description</th>
              <th>Category</th>
              <th>Upload Image</th>
              <th>EDIT </th>
              <th>DELETE </th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($query_result)) {
            ?>
              <tr>
                <td><?php echo $row['pid']; ?></td>
                <td><?php echo $row['productname']; ?></td>
                <td><?php echo $row['productdesignation']; ?></td>
                <td><?php echo $row['productdescription']; ?></td>
                <td><?php echo $row['catname']; ?></td>
                <td><?php echo '<img src="upload/' . $row['prodcutimage'] . '" width="100px" height="100px" alt="images">' ?></td>
                <td>
                  <form action="product_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['pid']; ?>">
                    <button type="submit" name="edit_data_btn" class="btn btn-success"> EDIT</button>
                  </form>
                </td>
                <td>
                  <form action="code.php" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['pid']; ?>">
                    <button type="submit" name="delete_data_btn" class="btn btn-danger"> DELETE</button>
                  </form>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      <?php
      } else {
        echo "No Record Found";
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