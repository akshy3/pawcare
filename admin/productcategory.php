

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
    <title>Pawcare | Admin  </title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->
        <?php

if (isset($_POST['submit'])) {
  //$time = date("d-m-Y")."-".time();

  $category_name = $_POST['cat_id'];
  $image = $_FILES["c_img"]["name"];
  //$image = $time."-".$image;

  move_uploaded_file($_FILES["c_img"]["tmp_name"], "uploads/" . $image);

  $cat_query = "SELECT * FROM prod_category WHERE cat_name='$category_name' ";
  $cat_query_run = mysqli_query($con, $cat_query);
  if (mysqli_num_rows($cat_query_run) > 0) {
    echo "<script>swal('Category Already Taken. Please Try Another one.').then(()=>window.location.href='productcategory.php')</script>";
  } else {


    $result = "INSERT INTO prod_category(`cat_name`,`c_img`)VALUES('$category_name','$image')";
    $row = mysqli_query($con, $result);
    if ($row) {
      echo "<script>swal('Category Added').then(()=>window.location.href='productcategory.php')</script>";
    }
  }
}
?>


<div class="modal fade" id="addpet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="form-group">
            <label>Pet Category</label>
            <input type="text" name="cat_id" class="form-control" placeholder="" required>
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" name="c_img" class="form-control" placeholder="" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Category List
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addpet">
          Add Category
        </button>
      </h5>
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>

              <th>Category</th>
              <th>Image</th>

              <th>EDIT </th>

              <th>DELETE </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM prod_category";
            $queryk = mysqli_query($con, $query);

            if (mysqli_num_rows($queryk) > 0) {
              while ($row = mysqli_fetch_assoc($queryk)) {
            ?>

                <tr>

                  <td><?php echo $row['cat_name']; ?></td>
                  <td><img src="uploads/<?php echo ($row['c_img']); ?>" height="100px" width="100px"></td>
                  <td>
                    <form action="productcategory_edit.php" method="post">
                      <input type="hidden" name="prod_id" value="<?php echo $row['prod_id']?>">
                      <button type="submit" name="edit_btn" class="btn btn-success">EDIT</button>
                    </form>
                  </td>

                  <td>
                    <form action="productcategory_delete.php" method="post">
                      <input type="hidden" name="delete_id" value="<?php echo $row['prod_id']; ?>">
                      <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                    </form>
                  </td>
                </tr>
            <?php }
            } else {
              echo "No record";
            }

            ?>
          </tbody>
        </table>

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