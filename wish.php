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
  <title>Pawcare | Wishlist</title>
  <!-- Links to stylesheets -->
  <?php include "includes/links.php" ?>
  <style>
    .profile-card-3 {
      background-color: #FFF;
      border-radius: 5px;
      box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      position: relative;
      margin: 10px auto;
      cursor: pointer;
      padding: 25px 15px;
    }

    .profile-card-3 .profile-name {
      font-weight: bold;
      color: #21304e;
    }

    .profile-card-3 .profile-location {
      color: #999;
      font-size: 13px;
      font-weight: 600;
    }

    .profile-card-3 img {
      height: 100px;
      width: 100px;
      object-fit: cover;
      margin: 10px auto;
      border-radius: 50%;
      transition: all linear 0.25s;
    }

    .profile-card-3 .profile-description {
      font-size: 13px;
      color: #777;
      padding: 10px;
    }

    .profile-card-3 .profile-icons {
      margin: 15px 0px;
    }

    .profile-card-3 .profile-icons .fa {
      color: #fe455a;
      margin: 0px 5px;
    }

    .profile-card-3:hover img {
      height: 110px;
      width: 110px;
      margin: 5px auto;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include "includes/nav.php" ?>
  <div class="container-fluid min-vh-100">
    <!-- Body -->

    <?php

    $user_id = $_SESSION['r_id'];
    if (isset($_GET['p_id'])) {

      $p_id = $_GET['p_id'];
      $query = "INSERT INTO wishlist (user_id, p_id) VALUES ('$user_id','$p_id')";

      $run = $con->query($query);
      if ($run) {
        echo "<script>swal('Successfully added to wishlist.')</script>";
      }
      
      // else {
      //   echo ("Failed to add the product to wishlist" . $con->error);echo "<script>swal('Failed to add the product to wishlist')</script>";
      // } 
    }


    $query = "SELECT * FROM wishlist INNER JOIN products ON wishlist.p_id = products.p_id WHERE user_id='$user_id'";
    $run = mysqli_query($con, $query);
    $check = mysqli_num_rows($run) > 0;

    if (isset($_GET['action'])) {
      if ($_GET['action'] == 'delete') {
        $pid = $_GET['delete_id'];
        $q = "DELETE FROM wishlist WHERE user_id='$user_id' AND p_id='$pid'";
        $r = $con->query($q);
        if ($r) {
          echo "<script>swal('Deleted the item from your wishlist.').then(()=> window.location.href='wish.php')</script>";
        }
      }
    }

    if ($check) {

    ?>

      <div class="container">
        <div class="row">
          <?php
          while ($row = mysqli_fetch_array($run)) {
          ?>
            <div class="col-md-4">
              <div class="profile-card-3"><img src="admin/uploads/<?php echo $row['p_img']; ?>" class="img img-responsive">
                <div class="profile-name"><?php echo $row["p_name"]; ?></div>
                <div class="profile-username">Rs <?php echo $row["price"]; ?></div>
                <form method="post" action="cart.php?action=add&id=<?php echo $row["p_id"]; ?>">

                  <input type="text" name="quantity" value="" placeholder="Quantity" class="form-control" required />

                  <input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>" />

                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                </form>
                <a href="wish.php?action=delete&delete_id=<?php echo $row['p_id'] ?>" class="btn btn-danger">Delete</a>

              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    <?php
    } else {
      echo "No product found";
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