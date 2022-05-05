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
    <title>Pawcare | Booking Pet Sitting</title>
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
            $fromdate = $_POST['fromdate'];
            $todate = $_POST['todate'];
            $type = $_POST['type'];
            $address = $_POST['address'];
            $u_id = $_SESSION['r_id'];

            $data = $_POST;

            if (
                empty($data['fromdate']) ||
                empty($data['todate']) ||
                empty($data['type']) ||
                empty($data['address'])
            ) {

                die('Please fill all required fields!');
            }



            if (strtotime(date("d/m/Y")) > strtotime($fromdate)) {
                echo "
                <script>swal('Pick a future date to book appointment.').then(()=> window.location.href='petsit.php')</script>
                ";
            } else {


                $query    = "INSERT into `petsit`(u_id,fromdate,todate,type,address)
                   VALUES ('$u_id','$fromdate','$todate','$type','$address')";
                $result   = mysqli_query($con, $query);

                if ($result) {
                    echo "
                <script>swal('Booked successfully').then(()=> window.location.href='petbookings.php')</script>
                ";
                } else {
                    echo "
                <script>swal('Failed to book. Try again later.').then(()=> window.location.href='petsit.php')</script>
                ";
                }
            }
        } 
        
        
        
        else {



        ?>



            <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(images/bg_1.jpg);">
                <div class="container-fluid">
                    <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
                        <div class="col-12 col-md-6 col-lg-4 h-50">
                            <div class="card shadow">
                                <div class="card-body mx-auto">
                                    <h4 class="card-title mt-3 text-center">Booking for Pet Sitting</h4>
                                    <p class="text-center">Fill in the details to get started.</p>

                                    <form action="petsit.php" method="POST" name="user_form" id="form">

                                        <div class="form-group input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            <input type="text" name="fromdate" class="form-control" placeholder="From Date">
                                            <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>

                                            <div class="input-group-addon">
                                                <!-- <span class="glyphicon glyphicon-th"></span> -->
                                            </div>
                                        </div>



                                        <div class="form-group input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            <input type="text" name="todate" class="form-control" placeholder="To Date">
                                            <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                                            <div class="input-group-addon">
                                                <!-- <span class="glyphicon glyphicon-th"></span> -->
                                            </div>
                                        </div>
                                        <div class="form-group input-group">
                                            <select name="type" class="form-select" aria-label="Default select example">
                                                <option value="Boarding" selected>Boarding</option>
                                                <option value="House Sitting">House Sitting</option>
                                            </select>


                                        </div>


                                        <div class="form-group input-group">

                                            <input name="address" class="form-control" placeholder="Address" type="text" required>
                                        </div>

                                        <div class="form-group">
                                            <button name="submit" type="submit" class="btn btn-primary btn-block">Book Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php } ?>

        <!-- End of Body -->
    </div>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>

    <!-- Scripts -->
    <?php include "includes/scripts.php" ?>
</body>

</html>