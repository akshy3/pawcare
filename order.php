<?php
//Session & Database initialization
session_start();
include "includes/loginredirect.php";

include "includes/dbconn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawcare | Order</title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->
        <?php
        if (isset($_SESSION['shopping_cart'])) {

            $u_id = $_SESSION['r_id'];
            $data = serialize($_SESSION['shopping_cart']);
            $totalprice = $_POST['totalprice'];
            $query = "INSERT INTO orders (u_id,data,totalprice) VALUES ('$u_id','$data','$totalprice')";

            if ($con->query($query)) {
                unset($_SESSION['shopping_cart']);
                echo "<script>swal('Thank you. Your order will be shipped to you soon.').then(()=> window.location.href='cart.php');</script>";
            } else {
                echo $con->error;
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