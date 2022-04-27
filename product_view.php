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
  <title>Pawcare | View Product</title>
  <!-- Links to stylesheets -->
  <?php include "includes/links.php" ?>
</head>

<body>
  <!-- Navbar -->
  <?php include "includes/nav.php" ?>
  <div class="container-fluid min-vh-100">
    <!-- Body -->

    <?php
    if (isset($_GET["p_id"])) {
      $id = $_GET['p_id'];
      $query = "SELECT * FROM `products` WHERE `p_id`='$id'";
      $run = mysqli_query($con, $query);
    }


    $query = "SELECT * FROM `products` WHERE `p_id`='$id'";
    $run = mysqli_query($con, $query);
    $check = mysqli_num_rows($run) > 0;

    if ($check) {
      while ($row = mysqli_fetch_array($run)) {
    ?>
        <div class="container">

          <h3><?php echo $row["p_name"] ?></h3>
          <img src="admin/uploads/<?php echo $row['p_img']; ?>" height="300px" width="300px" alt="">
          <div class="col-md-7">

            <h5><?php echo $row["meta_desc"] ?></h5>
            <p><?php echo $row["p_desc"] ?></p>
            <h5> Price RS: <?php echo $row["price"] ?> /-</h5>
          </div>

          <form method="post" action="cart.php?action=add&id=<?php echo $row["p_id"]; ?>">

            <input type="text" name="quantity" value="" class="form-control" placeholder="Quantity" required />
            <!-- Passing information as hidden values -->
            <input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>" />

            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

        </div>
        </form>

    <?php

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