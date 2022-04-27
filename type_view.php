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
  <title>Pawcare | Sub Categories</title>
  <!-- Links to stylesheets -->
  <?php include "includes/links.php" ?>

  <style>
    .profile-card-2 {
      max-width: 300px;
      background-color: #fff;
      box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
      background-position: center;
      overflow: hidden;
      position: relative;
      margin: 10px auto;
      cursor: pointer;
      border-radius: 10px;
    }

    .profile-card-2 img {
      transition: all linear 0.25s;
    }

    .profile-card-2 .profile-name {
      position: absolute;
      left: 30px;
      bottom: 70px;
      font-size: 30px;
      color: #fff;
      text-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
      font-weight: bold;
      transition: all linear 0.25s;
    }

    .profile-card-2 .profile-icons {
      position: absolute;
      bottom: 30px;
      right: 30px;
      color: #fff;
      transition: all linear 0.25s;
    }

    .profile-card-2 .profile-username {
      position: absolute;
      bottom: 50px;
      left: 30px;
      color: #fff;
      font-size: 13px;
      transition: all linear 0.25s;
    }

    .profile-card-2 .profile-icons .fa {
      margin: 5px;
    }

    .profile-card-2:hover .profile-name {
      bottom: 80px;
    }

    .profile-card-2:hover .profile-username {
      bottom: 60px;
    }

    .profile-card-2:hover .profile-icons {
      right: 40px;
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
        //Query to the database
        $query = "SELECT * FROM `prod_category`";
        $run = mysqli_query($con, $query);
        $check = mysqli_num_rows($run) > 0;

        if ($check) {
          while ($row = mysqli_fetch_array($run)) {
        ?>
            <!-- Card -->
            <div class="col-md-4">
              <div onclick="location.href='products.php?prod_id=<?php echo $row['prod_id']; ?>&cat_id=<?php echo $_GET['cat_id']; ?>'" class="profile-card-2"><img src="admin/uploads/<?php echo $row['c_img']; ?>" height="200px" width="200px" class="img img-responsive">
                <div class="profile-name"><?php echo $row['cat_name']; ?></div>
              </div>
            </div>

        <?php
          }
        } else {
          echo "No type found";
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