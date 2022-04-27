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
    <title>Pawcare | Login</title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->

        <?php
        //$errors=array();
        // When form submitted, check and create user session.
        if (isset($_POST['submit'])) {
            $user = stripslashes($_REQUEST['r_name']); // removes backslashes
            $user = mysqli_real_escape_string($con, $user);
            $password = stripslashes($_REQUEST['r_password']);
            $password = mysqli_real_escape_string($con, $password);
            // Check user is exist in the database
            $query = "SELECT * FROM register WHERE r_name='$user' AND r_password='$password'";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            $rows = mysqli_num_rows($result);
            if ($user == 'admin') {
                $query1 = "SELECT * FROM register WHERE r_name='$user' AND r_password='$password'";
                $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
                $rows = mysqli_num_rows($result1);
                if ($rows == 1) {

                    $_SESSION['r_name'] = $user;
                    //redirect to admin dashboard
                    header("Location: admin/index.php");
                }
            } else {
                $query = "SELECT * FROM register WHERE r_name='$user' AND r_password='$password'";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                $rows = mysqli_num_rows($result);


                if ($rows == 1) {
                    $row = mysqli_fetch_array($result);
                    $_SESSION['r_name'] = $user;
                    $_SESSION['r_id'] = $row['id'];
                    // Redirect to user dashboard page
                    header("Location: index.php");
                } else {
                    echo "<div class='container'><div class='form m-auto'>
                  <h3 class='alert alert-danger'>Incorrect Username/password.</h3><br/>
                 <a class='btn btn-primary' href='login.php'>Login again.</a>
                  </div></div>";
                }
            }
        } else {
        ?>
            <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(images/bg_1.jpg);">
                <div class="container-fluid">
                    <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
                        <div class="col-12 col-md-6 col-lg-4   h-50 ">
                            <div class="card shadow">
                                <div class="card-body mx-auto">
                                    <h4 class="card-title mt-3 text-center">Log In</h4>
                                    <p class="text-center">Welcome back.</p>

                                    <form action="" type="submit" name="submit" method="POST">

                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            </div>
                                            <input name="r_name" class="form-control" placeholder="Username" type="text">
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            </div>
                                            <input name="r_password" class="form-control" placeholder="Password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-primary btn-block"> Click to Log In </button>
                                        </div>
                                        <p class="text-center">New here?
                                            <a href="register.php">Register</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
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