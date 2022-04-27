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
    <title>Pawcare | Profile</title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>

    <style>
        .card {
            width: 350px;
            background-color: #efefef;
            border: none;
            cursor: pointer;
            transition: all 0.5s
        }

        .image img {
            transition: all 0.5s
        }

        .card:hover .image img {
            transform: scale(1.5)
        }

        .btn {
            height: 140px;
            width: 140px;
            border-radius: 50%
        }

        .name {
            font-size: 22px;
            font-weight: bold
        }

        .idd {
            font-size: 14px;
            font-weight: 600
        }

        .idd1 {
            font-size: 12px
        }

        .number {
            font-size: 22px;
            font-weight: bold
        }

        .follow {
            font-size: 12px;
            font-weight: 500;
            color: #444444
        }

        .btn1 {
            height: 40px;
            width: 150px;
            border: none;
            background-color: #000;
            color: #aeaeae;
            font-size: 15px
        }

        .text span {
            font-size: 13px;
            color: #545454;
            font-weight: 500
        }

        .icons i {
            font-size: 19px
        }

        hr .new1 {
            border: 1px solid
        }

        .join {
            font-size: 14px;
            color: #a0a0a0;
            font-weight: bold
        }

        .date {
            background-color: #ccc
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include "includes/nav.php" ?>
    <div class="container-fluid min-vh-100">
        <!-- Body -->

        <?php
        $name = $_SESSION['r_name'];
        $query = "SELECT * FROM register WHERE r_name='$name'";
        $result = $con->query($query);
        $row = $result->fetch_assoc();

        ?>


        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
            <div class="card p-4">
                <div class=" image d-flex flex-column justify-content-center align-items-center"> <button class="btn btn-secondary"> <img src="<?php echo ''.$row['dp'] ?>" height="100" width="100" /></button> <span class="name mt-3"><?php echo $name; ?></span> <span class="idd"><?php echo $row['email']; ?></span>
                    <div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span class="idd1">ID: <?php echo $row['id']; ?></span> <span><i class="fa fa-copy"></i></span> </div>
                    <div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span class="number"><?php echo $row['phone']; ?> </span> </div>
                    <div class=" d-flex mt-2"> <button class="btn1 btn-dark" onclick="location.href='edit_profile.php';">Edit Profile</button> </div>
                    <div class="text mt-3"> <span><?php echo $row['bio']; ?></span> </div>
                    <div class=" px-2 rounded mt-4 date "> <span class="join">Joined <?php echo date("F,Y", strtotime($row['created_at'])); ?></span> </div>
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