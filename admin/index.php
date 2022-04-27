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
    <title>Pawcare | Admin Dashboard </title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->

        <h4>Admin Dashboard</h4>

        <?php
        $usertotal=0;
        $productstotal=0;
        $categorytotal=0;
        $prodcategorytotal=0;
        $ordertotal=0;
        $petsittotal=0;



        //getting total users
        if($con->query("SELECT COUNT(*) as total FROM register")){
            
            $usertotal =  (($con->query("SELECT COUNT(*) as total FROM register")->fetch_assoc())['total']);
        }
        else{
            $usertotal=0;
        }

        //getting total products
        if($con->query("SELECT COUNT(*) as total FROM products")){
            
            $productstotal =  (($con->query("SELECT COUNT(*) as total FROM products")->fetch_assoc())['total']);
        }
        else{
            $productstotal=0;
        }
        //getting total categories
        if($con->query("SELECT COUNT(*) as total FROM category")){
            
            $categorytotal =  (($con->query("SELECT COUNT(*) as total FROM category")->fetch_assoc())['total']);
        }
        else{
            $categorytotal=0;
        }
        //getting total product categories
        if($con->query("SELECT COUNT(*) as total FROM prod_category")){
            
            $prodcategorytotal =  (($con->query("SELECT COUNT(*) as total FROM prod_category")->fetch_assoc())['total']);
        }
        else{
            $prodcategorytotal=0;
        }
        //getting total orders
        if($con->query("SELECT COUNT(*) as total FROM order")){
            
            $ordertotal =  (($con->query("SELECT COUNT(*) as total FROM order")->fetch_assoc())['total']);
        }
        else{
            $ordertotal=0;
        }
        //getting total pet sit bookings
        if($con->query("SELECT COUNT(*) as total FROM petsit")){
            
            $petsittotal =  (($con->query("SELECT COUNT(*) as total FROM petsit")->fetch_assoc())['total']);
        }
        else{
            $petsittotal=0;
        }





        ?>
        <div class="mt-4 container">
            <div class="row py-2">
                <div class="col-md-6">
                    <div class="border border-primary rounded px-4">

                        <span class="h2"><?php echo $usertotal ?></span> Users
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border border-primary rounded px-4">

                        <span class="h2"><?php echo $productstotal ?></span> Products
                    </div>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-6">
                    <div class="border border-primary rounded px-4">

                        <span class="h2"><?php echo $categorytotal ?></span> Pet Categories
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border border-primary rounded px-4">

                        <span class="h2"><?php echo $prodcategorytotal ?></span> Product Categories
                    </div>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-md-6">
                    <div class="border border-primary rounded px-4">

                        <span class="h2"><?php echo $ordertotal ?></span> Orders
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border border-primary rounded px-4">

                        <span class="h2"><?php echo $petsittotal ?></span> Pet sitting bookings
                    </div>
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