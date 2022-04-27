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
  <title>Pawcare | Products</title>
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

    <div class="container">
      <div class="row mt-4">

        <?php

        $prod_id = $_GET['prod_id'];
        $cat_id = $_GET['cat_id'];
        $query = "SELECT * FROM `products` WHERE cat_id='$cat_id' AND prod_id='$prod_id'";
        $run = mysqli_query($con, $query);
        $check = mysqli_num_rows($run) > 0;

        if ($check) {
          while ($row = mysqli_fetch_array($run)) {
        ?>
            <!-- Card -->
            <div class="col-md-4">
              <div class="profile-card-3"><img src="admin/uploads/<?php echo $row['p_img']; ?>" class="img img-responsive">
                <div class="profile-name"><?php echo $row["p_name"]; ?></div>
                <div class="profile-username">Rs <?php echo $row["price"]; ?></div>
                <a href="product_view.php?p_id=<?php echo $row['p_id']; ?>" class="btn btn-success" style="decoration:none; padding:10px;">Details</a>
                <a href="wish.php?p_id=<?php echo $row['p_id']; ?>" name="wish" class="btn btn-outline-danger">Wishlist<i class="fa fa-heart"></i></a>
              </div>
            </div>

        <?php
          }
        } else {
          echo "No product found";
        }

        ?>
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