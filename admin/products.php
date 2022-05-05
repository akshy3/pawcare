<?php
//Session & Database initialization
session_start();
include "../includes/dbconn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pawcare | Admin </title>
  <!-- Links to stylesheets -->
  <?php include "includes/links.php" ?>
</head>

<body>
  <!-- Navbar -->
  <?php include "includes/nav.php" ?>
  <div class="container-fluid min-vh-100">
    <!-- Body -->


    <div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="product_action.php" method="POST" enctype="multipart/form-data">

            <div class="modal-body">
              <div class="form-group">

                <label>Pet</label>
                <select name="cat_id">
                  <option value="" disabled>Select Category</option>
                  <?php
                  $result1 = "SELECT * from category";
                  $result = $con->query($result1);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                  }

                  ?>


                </select>
              </div>
              <div class="form-group">
                <label> Name </label>
                <input type="text" name="p_name" class="form-control" placeholder="">
              </div>

              <div class="form-group">
                <label>Type</label>
                <select name="prod_id">
                  <option value="" disabled>Select Category</option>
                  <?php
                  $result1 = "SELECT * from prod_category";
                  $result = $con->query($result1);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row['prod_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                  }

                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Meta Description</label>
                <input type="text" name="meta_desc" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="p_desc" class="form-control" placeholder=""></textarea>
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="p_img" class="form-control" placeholder="" onchange="preview_Image(event)">
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" placeholder="">
              </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="save" class="btn btn-primary">Save</button>
            </div>
          </form>

        </div>
      </div>
    </div>


    <div class="container-fluid">
      <!-- Topbar Search -->


      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Products
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addproduct">
              Add Product

            </button>
          </h6>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <?php
            $res = "SELECT * FROM products";
            $res_run = mysqli_query($con, $res);
            ?>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>

                  <th>Name </th>
                  <th>Pet category </th>
                  <th>Type</th>
                  <th>Meta Descriptiion</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>EDIT </th>
                  <th>DELETE </th>
                </tr>
              </thead>
              <tbody>
                <?php

                if (mysqli_num_rows($res_run) > 0) {
                  while ($row = mysqli_fetch_assoc($res_run)) {
                    $resul = "SELECT cat_name FROM category where `cat_id` = $row[cat_id]";

                    $res_run1 = mysqli_query($con, $resul);
                    $row1 = mysqli_fetch_assoc($res_run1);
                    $category_name = $row1['cat_name'];

                    $resu = "SELECT cat_name FROM prod_category where `prod_id` = $row[prod_id]";

                    $resu_run = mysqli_query($con, $resu);
                    $row2 = mysqli_fetch_assoc($resu_run);
                    error_reporting(0);
                    $product_name = $row2['cat_name'];
                    error_reporting(0);

                ?>
                    <tr>

                      <td><?php echo $row['p_name']; ?></td>
                      <td><?php echo $category_name; ?> </td>
                      <td><?php echo $product_name; ?> </td>
                      <td><?php echo $row['meta_desc']; ?> </td>
                      <td><?php echo $row['p_desc']; ?> </td>
                      <td><?php echo $row['quantity']; ?> </td>

                      <td>
                        <img src="uploads/<?php echo $row['p_img']; ?>" alt="" width="100" height="50">
                      </td>

                      <td><?php echo $row['price']; ?> </td>
                      <td>
                        <form action="product_edit.php" method="post">
                          <input type="hidden" name="edit_id" value="<?php echo $row['p_id'] ?>">
                          <button type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                        </form>
                      </td>
                      <td>
                        <form action="product_delete.php" method="post">
                          <input type="hidden" name="delete_id" value="<?php echo $row['p_id']; ?>">
                          <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                        </form>
                      </td>
                  <?php }
                } else {
                  echo "No record Found";
                }
                  ?>
                    </tr>

              </tbody>
            </table>

          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /.container-fluid -->
  <!-- End of Body -->
  </div>

  <!-- Footer -->
  <?php include "includes/footer.php" ?>

  <!-- Scripts -->
  <?php include "includes/scripts.php" ?>
</body>

</html>