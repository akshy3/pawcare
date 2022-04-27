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

                    if (isset($_POST['cat_id'])) {
                        $cat_id = $_POST['cat_id'];
                    }



                    if (isset($_POST["updatebtn"])) {
                        $cat = $_POST['cat_name'];
                        $image = $_FILES["c_img"]["name"];
                        move_uploaded_file($_FILES["c_img"]["tmp_name"], "uploads/" . $_FILES["c_img"]["name"]);

                        $query = "UPDATE `category` SET cat_name='$cat',c_img='$image' WHERE cat_id='$cat_id'";
                        $query_run = mysqli_query($con, $query);
                        if ($query_run) {
                            //move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/".$_FILES["image"]["tmp_name"]);
                            echo "<script>swal('Category Updated').then(()=>window.location.href='category.php')</script>";
                        } else {
                            echo "<script>swal('Category is Not Updated').then(()=>window.location.href='category.php')</script>";
                        }
                    }



                    if (isset($_POST["edit_btn"])) {
                        $queryingProduct = "SELECT * FROM `category` WHERE `cat_id` = '$cat_id'";
                        $query2 = $con->query($queryingProduct);
                        if ($query2->num_rows > 0) {
                            while ($row = $query2->fetch_assoc()) {
                    ?>


                                <form action="#" method="POST" enctype="multipart/form-data">


                                    <input type="hidden" name="cat_id" value="<?php echo $row['cat_id']; ?>">




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


                                    <a href="category.php" class="btn btn-danger"> CANCEL </a>
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