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
    <?php include "includes/nav.php";
    ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->


        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> EDIT Pet Data </h6>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_POST['edit_btn'])) {
                        $id = $_POST['edit_id'];
                        $query = "SELECT * FROM products WHERE p_id='$id' ";
                        $query_run = mysqli_query($con, $query);

                        foreach ($query_run as $row) {
                    ?>


                            <form action="product_action.php" method="POST" enctype="multipart/form-data">


                                <input type="hidden" name="edit_id" value="<?php echo $row['p_id']; ?>">

                                <label>Pet Category</label>
                                <select name="cat_id">
                                    <option value="" name="cat" disabled>Select Category</option>
                                    <?php
                                    $result1 = "SELECT * from category";
                                    $result = $con->query($result1);
                                    if ($result->num_rows > 0) {
                                        while ($row1 = $result->fetch_assoc()) {
                                            echo '<option value="' . $row1['cat_id'] . '">' . $row1['cat_name'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                                <label>Product Category</label>
                                <select name="prod_id">
                                    <option value="" name="cat" disabled>Select Category</option>
                                    <?php
                                    $result1 = "SELECT * from prod_category";
                                    $result = $con->query($result1);
                                    if ($result->num_rows > 0) {
                                        while ($row2 = $result->fetch_assoc()) {
                                            echo '<option value="' . $row2['prod_id'] . '">' . $row2['cat_name'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                                <div class="form-group">
                                    <label> Name </label>
                                    <input type="text" name="p_name" value="<?php error_reporting(0);
                                                                            echo $row['p_name']; ?>" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <input type="text" name="meta_desc" value="<?php error_reporting(0);
                                                                                echo $row['meta_desc']; ?>" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea type="text" name="p_desc" value="<?php echo $row['p_desc']; ?>" class="form-control" placeholder="" required><?php echo $row['p_desc']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Upload Image</label>

                                    <input type="file" id="image" name="p_img" accept="image/*" class="form-control-file" onchange="preview_Image(event)" /><br>
                                    <!--<input type="file" name="myimg"><br>-->
                                    <!--<img id = "imageDis" src="http://placehold.it/180" alt="your image" />-->
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control" value="<?php echo $row['quantity'] ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" value="<?php echo $row['price']; ?>" class="form-control" placeholder="" required>
                                </div>


                                <a href="products.php" class="btn btn-danger"> CANCEL </a>
                                <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

                            </form>
                    <?php
                        }
                    }

                    ?>



                </div>
            </div>
        </div>


        <!-- End of Body -->
    </div>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>

    <!-- Scripts -->
    <?php include "includes/scripts.php" ?>
</body>

</html>