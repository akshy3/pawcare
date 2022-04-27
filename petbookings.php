<?php
//Session & Database initialization
session_start();
include "includes/dbconn.php";
include "includes/loginredirect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawcare | My Pet Sitting Bookings</title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->
        <?php
        $u_id = $_SESSION['r_id'];
        $query = "SELECT * FROM petsit WHERE u_id='$u_id' ORDER BY created_at DESC";
        $result = $con->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "

                <h5>Booking Details - <span>" . date("jS F, Y", strtotime($row['created_at'])) . "</span></h5>
                <div class='table-responsive'>
                    <table class='table table-bordered'>
                        <tr>
                            <th width='40%'>From</th>
                            <th width='10%'>To</th>
                            <th width='20%'>Type</th>
                            <th width='15%'>Address</th>
                        </tr>
                        <tr>
                                <td>" . $row['fromdate'] . "</td>
                                <td>" . $row['todate'] . "</td>
                                <td>" . $row['type'] . "</td>
                                <td>" . $row['address'] . "</td>
                            </tr>
                            
                        </table></div>
                        ";
            }
        }
        else {
            echo "<div class='container mt-4'>You haven't booked anything yet.</div>";
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