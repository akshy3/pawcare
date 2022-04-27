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

        if (isset($_POST['delete_btn'])) {
            $p_id = $_POST['delete_id'];
            $query = "DELETE FROM prod_category WHERE prod_id='$p_id' ";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                echo "<script>swal('Category Deleted').then(()=>window.location.href='productcategory.php')</script>";
            } else {
                echo "<script>swal('Category is Not Deleted').then(()=>window.location.href='productcategory.php')</script>";
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