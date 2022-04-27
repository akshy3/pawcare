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
        <?php
        if (isset($_POST['save'])) {

            $p_name = $_POST['p_name'];
            $cat_id = $_POST['cat_id'];
            $prod_id = $_POST['prod_id'];
            $meta_desc = $_POST['meta_desc'];
            $p_desc = $_POST['p_desc'];
            $quantity = $_POST['quantity'];
            // $p_img = $_POST['p_img'];
            $price = $_POST['price'];
            $image = $_FILES["p_img"]["name"];

            if (empty($p_name) || empty($cat_id) || empty($prod_id) || empty($meta_desc) || empty($p_desc) || empty($quantity) || empty($price) || empty($image)) {
                echo "<script>swal('All fields are mandatory').then(()=>window.location.href='products.php')</script>";
            } else {
                $val_image = $_FILES["p_img"]["type"] == "image/jpg" || $_FILES["p_img"]["type"] == "image/jpg" ||
                    $_FILES["p_img"]["type"] == "image/jpg";

                if ($val_image) {
                } else {
                    echo "<script>swal('Only jpg,jpeg or png files are alloded').then(()=>window.location.href='products.php')</script>";
                }


                move_uploaded_file($_FILES["p_img"]["tmp_name"], "uploads/" . $_FILES["p_img"]["name"]);
                $price = $_POST['price'];

                $query = "INSERT INTO `products` (cat_id,prod_id,p_name,meta_desc,p_desc,quantity,p_img,price) VALUES ('$cat_id','$prod_id','$p_name','$meta_desc','$p_desc','$quantity','$image','$price')";
                $run = mysqli_query($con, $query);

                if ($run) {
                    echo "<script>swal('Product Added').then(()=>window.location.href='products.php')</script>";
                } else {
                    echo "<script>swal('Product Not Added').then(()=>window.location.href='products.php')</script>";
                }
            }
        }


        if (isset($_POST['updatebtn'])) {


            $p_name = $_POST['p_name'];
            $cat_id = $_POST['cat_id'];
            $prod_id = $_POST['prod_id'];
            $meta_desc = $_POST['meta_desc'];
            $p_desc = $_POST['p_desc'];
            $quantity = $_POST['quantity'];

            $price = $_POST['price'];

            $id = $_POST['edit_id'];
            if ($_FILES['p_img']['name'] == '') {
                $q = "SELECT * FROM products WHERE p_id='$id'";
                $r = $con->query($q);
                $ro = $r->fetch_assoc();
                $image = $ro['p_img'];
            } else {

                $image = $_FILES["p_img"]["name"];
                move_uploaded_file($_FILES["p_img"]["tmp_name"], "uploads/" . $_FILES["p_img"]["name"]);
            }

            $query = "UPDATE `products` SET p_name='$p_name', cat_id='$cat_id', prod_id='$prod_id', meta_desc='$meta_desc',p_desc='$p_desc',quantity='$quantity', price='$price', p_img='$image' WHERE p_id='$id'";



            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                echo "<script>swal('Product Updated').then(()=>window.location.href='products.php')</script>";
            } else {
                echo "<script>swal('Product is Not Updated').then(()=>window.location.href='products.php')</script>";
            }
        }
        ?>


        <!-- End of Body -->
    </div>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>

    <!-- Scripts -->
    <?php include "includes/scripts.php" ?>
</body>

</html>