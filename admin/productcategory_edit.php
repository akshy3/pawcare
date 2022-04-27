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

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> EDIT Category Data </h6>
                </div>
                <div class="card-body">
                    <?php

                    $prod_id = $_POST['prod_id'];
                    if (isset($_POST["updatebtn"])) {

                        $cat_name = $_POST['cat_name'];
                        $image = $_FILES["c_img"]["name"];
                        move_uploaded_file($_FILES["c_img"]["tmp_name"], "uploads/" . $_FILES["c_img"]["name"]);
                        // $rate = $_POST['rate'];

                        $query = "UPDATE `prod_category` SET cat_name='$cat_name',c_img='$image' WHERE prod_id='$prod_id'";
                        $query_run = mysqli_query($con, $query);

                        if ($query_run) {
                            //move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/".$_FILES["image"]["tmp_name"]);
                            echo "<script>swal('Category Data Updated').then(()=>window.location.href='productcategory.php')</script>";
                        } else {
                            echo "<script>swal('Category Data Not Updated').then(()=>window.location.href='productcategory.php')</script>";
                        }
                    }



                    if (isset($_POST["edit_btn"])) {
                        $queryingProduct = "SELECT * FROM `prod_category` WHERE `prod_id` = '$prod_id'";
                        $query2 = $con->query($queryingProduct);
                        if ($query2->num_rows > 0) {
                            while ($row = $query2->fetch_assoc()) {
                    ?>


                                <form action="productcategory_edit.php" method="POST" enctype="multipart/form-data">


                                    <input type="hidden" name="prod_id" value="<?php echo $row['prod_id']; ?>">

                                    <label>Pet</label>


                                    <div class="form-group">
                                        <label> Name </label>
                                        <input type="text" name="cat_name" value="<?php echo $row['cat_name']; ?>" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Image</label>

                                        <input type="file" id="c_img" name="c_img" accept="image/*" class="form-control-file" onchange="preview_Image(event)" /><br>
                                        <!--<input type="file" name="myimg"><br>-->
                                        <!--<img id = "imageDis" src="http://placehold.it/180" alt="your image" />-->
                                    </div>


                                    <a href="productcategory.php" class="btn btn-danger"> CANCEL </a>
                                    <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

                                </form>
                    <?php
                            }
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