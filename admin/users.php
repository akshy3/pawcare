<?php
//Session & Database initialization
session_start();
include "../includes/dbconn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pawcare | Admin </title>
  <!-- Links to stylesheets -->
  <?php include "includes/links.php" ?>
</head>

<body>
  <!-- Navbar -->
  <?php include "includes/nav.php" ?>
  <div class="container-fluid min-vh-100">
    <!-- Body -->


    <?php

    $sql = "SELECT * FROM register WHERE id>5";
    $data = mysqli_query($con, $sql);

    ?>

    <form action="index.php" method="post">
      <button type="submit" class="btn btn-primary float-right" name="btn_pdf">DashBoard</button>
    </form>
    <div class="row">
      <div class="col">
        <div class="container">
          <div class="card mt-5">
            <div class="card-header">
              <form action="pdfgen.php" method="POST">
                <button type="submit" class="btn btn-success float-left" name="btn_pdf">PDF</button>

              </form>
            </div>
            <div class="card-body">
              <table class="table table-striped">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact</th>
                </tr>
                <?php

                while ($row = mysqli_fetch_assoc($data)) {
                ?>
                  <tr>
                    <td><?php echo $row['r_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                  <?php
                }
                  ?>
              </table>
            </div>
          </div>
        </div>
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