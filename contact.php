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
    <title>Pawcare | Contact</title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->



        <?php

        // Adding the message to database

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];


        $query = "INSERT INTO contact (fullname,email,subject,message) VALUES ('$name', '$email', '$subject', '$message')";
        $result = $con->query($query);
        if ($result) {
        ?>

            <script>
                swal("Successfully sent the message!").then(() => {
                    window.location.href = "index.php";
                })
            </script>
        <?php

        } else {

        ?>

            <script>
                swal("Failed to send the message!").then(() => {
                    window.location.href = "index.php";
                })
            </script>

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