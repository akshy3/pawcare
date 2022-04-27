<?php
//Session & Database initialization
session_start();
include "includes/dbconn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawcare | Register</title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->


        <?php

        // if (!isset($_SESSION['username'])){ 
        // When form submitted, insert values into the database.
        if (isset($_POST['username'])) {
            // removes backslashes

            $username = stripslashes($_POST['username']);
            //escapes special characters in a string
            $username = mysqli_real_escape_string($con, $username);

            $email    = stripslashes($_POST['email']);
            $email    = mysqli_real_escape_string($con, $email);

            $phone    = stripslashes($_POST['phone']);
            $phone    = mysqli_real_escape_string($con, $phone);
            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $password1 = stripslashes($_POST['password1']);
            $password1 = mysqli_real_escape_string($con, $password1);
            $status = "user";
            $data = $_POST;

            if (
                empty($data['username']) ||
                empty($data['password']) ||
                empty($data['email']) ||
                empty($data['phone']) ||
                empty($data['password1'])
            ) {

                die('Please fill all required fields!');
            }



            $username_query = "SELECT * from register where r_name= '$username'";
            $userrows=$con->query($username_query)->num_rows;
            if ($userrows !=0) {
                echo "<script>swal('Username Taken. Please Choose another one').then(()=> {window.location.href='register.php'})</script>";
            } else {
                $query    = "INSERT into `register`(r_name,email,phone,r_password,user_status)
                   VALUES ('$username','$email','$phone','$password','$status')";
                $result   = mysqli_query($con, $query);
                if ($result) {
                    echo "
                <div class='container' align='center'>
                <h3 class='alert alert-success'>You are registered successfully.</h3><br/>
                <a class='btn btn-success' href='login.php'>Log In to continue</a>
                </div>";
                } else {
                    echo "<div class='container'>
                <h3>Required fields are missing.</h3><br/>
                <a class='btn btn-success' href='register.php'>Register again.</a> 
                </div>";
                }
            }
        } else {



        ?>



            <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(images/bg_1.jpg);">
                <div class="container-fluid">
                    <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
                        <div class="col-12 col-md-6 col-lg-4 h-50">
                            <div class="card shadow">
                                <div class="card-body mx-auto">
                                    <h4 class="card-title mt-3 text-center">Create Account</h4>
                                    <p class="text-center">Get started with your free account</p>

                                    <form action="register.php" method="POST" name="user_form" id="form" oninput='password1.setCustomValidity(password1.value != password.value ? "Passwords do not match." : "")'>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            </div>
                                            <input name="username" class="form-control" placeholder="Username" type="text" required>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                            </div>
                                            <input name="email" class="form-control" placeholder="Email address" type="email" required>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                            </div>
                                            <input name="phone" class="form-control" placeholder="Phone Number" type="text" required pattern="[0-9]{10}">
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            </div>
                                            <input name="password" class="form-control" placeholder="Create password" type="password" required>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            </div>
                                            <input name="password1" class="form-control" placeholder="Repeat password" type="password" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                                        </div>
                                        <p class="text-center">Have an account?
                                            <a href="login.php">Log In</a>
                                        </p>
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