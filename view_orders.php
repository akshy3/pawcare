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
    <title>Pawcare | My Orders</title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->
        <div class="container">


            <?php
            $u_id = $_SESSION['r_id'];
            $query = "SELECT * FROM orders WHERE u_id='$u_id' ORDER BY created_at DESC";
            $result = $con->query($query);
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $data = unserialize($row['data']);
                    echo "

                <h5>Order Details - <span>" . date("jS F, Y", strtotime($row['created_at'])) . "</span></h5>
                <div class='table-responsive'>
                    <table class='table table-bordered'>
                        <tr>
                            <th width='40%'>Item Name</th>
                            <th width='10%'>Quantity</th>
                            <th width='20%'>Price</th>
                            <th width='15%'>Total</th>
                        </tr>
                        ";
                    $total = 0;
                    foreach ($data as $keys => $values) {
                        echo "
                            <tr>
                                <td>" . $values['item_name'] . "</td>
                                <td>" . $values['item_quantity'] . "</td>
                                <td>Rs " . $values['item_price'] . "</td>
                                <td>Rs " . number_format($values['item_quantity'] * $values['item_price'], 2) . "</td>
                            </tr>
                            ";
                        $total = $total + ($values['item_quantity'] * $values['item_price']);
                    }
                    echo "
                        <tr>
                            <td colspan='3' align='right'>Total</td>
                            <td align='right'>Rs " . number_format($total, 2) . "</td>
                        </tr>
                        </table></div>
                        ";
                }
            } else {
                echo "You haven't ordered anything yet.";
            }

            ?>




        </div>

        <!-- End of Body -->
    </div>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>

    <!-- Scripts -->
    <?php include "includes/scripts.php" ?>
</body>

</html>