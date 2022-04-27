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
    <title>Pawcare | Edit Profile</title>
    <!-- Links to stylesheets -->
    <?php include "includes/links.php" ?>
    <style>
        .img-account-profile {
            height: 10rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
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



        if (isset($_POST['submitdp'])) {
            $target_dir = "images/uploads/";
            $target_file = $target_dir . date('s') . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            // Check if image file is a actual image or fake image
            if (file_exists($_FILES['fileToUpload']['tmp_name'])) {

                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "<script>swal('File is not an image')</script>";
                    $uploadOk = 0;
                }
            }


            // Check if file already exists
            if (file_exists($target_file)) {
                // echo "Sorry, file already exists.";
                echo "<script>swal('Sorry, file already exists.')</script>";

                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                // echo "Sorry, your file is too large.";
                echo "<script>swal('Sorry, your file is too large.')</script>";

                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                echo "<script>swal('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
                echo "<script>swal('Sorry, your file was not uploaded.').then(()=> window.location.href = 'edit_profile.php')</script>";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], '../'.$target_file)) {

                    //deleting old profile picture
                    // $oldpic = $row['dp'];
                    $q = "UPDATE register SET dp='$target_file' WHERE r_name='$name'";
                    $r = $con->query($q);
                    if ($r) {
                        // unlink($oldpic);
                        echo "<script>swal('Successfully changed the profile picture.').then(()=>window.location.href = 'profile.php' )</script>";
                    }
                    // echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                } else {
                    // echo "Sorry, there was an error uploading your file.";
                    echo "<script>swal('Sorry, there was an error uploading your file.').then(()=>window.location.href = 'profile.php' )</script>";

                    // echo "<script>swal('Sorry, your file was not uploaded.').then(()=> window.location.href = 'edit_profile.php')</script>";
                }
            }
        }
        ?>

        <div class="container-xl px-4 mt-4">

            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" src="<?php echo ''.$row['dp'] ?>" alt="">
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <form action="edit_profile.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="fileToUpload" id="fileToUpload" required>

                                <button class="btn btn-primary" type="submit" name="submitdp">Upload new image</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['updateSubmit'])) {
                    $username = $_POST['inputUsername'];
                    $email = $_POST['inputEmail'];
                    $phone = $_POST['inputPhone'];
                    $password = $_POST['inputPassword'];
                    $bio = $_POST['inputBio'];

                    $q = "UPDATE register SET r_name='$username',email='$email',phone='$phone',bio='$bio',r_password='$password' WHERE r_name='$name'";
                    try {
                        $r = $con->query($q);
                    } catch (exception $e) {
                        echo $e;
                    }
                    if ($r) {
                        echo "<script>swal('Successfully edited the profile.').then(()=>window.location.href = 'profile.php' )</script>";
                        // echo "<script>window.location.href = 'profile.php';</script>";
                        // header("Location: profile.php");
                    }
                }
                ?>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form action="edit_profile.php" method="POST" name="user_form" id="form" oninput='password1.setCustomValidity(password1.value != password.value ? "Passwords do not match." : "")'>
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                    <input class="form-control" name="inputUsername" id="inputUsername" type="text" placeholder="Enter your username" value="<?php echo $row['r_name']; ?>" required>
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" name="inputEmail" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?php echo $row['email']; ?>" required>
                                </div>
                                <!-- Form Row-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputPhone">Mobile Number</label>
                                    <input class="form-control" name="inputPhone" id="inputPhone" type="text" placeholder="Phone number" value="<?php echo $row['phone']; ?>" required>
                                </div>
                                <!-- Form Row-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputBio">Bio</label>
                                    <input class="form-control" name="inputBio" id="inputBio" type="text" placeholder="Bio" value="<?php echo $row['bio']; ?>">
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input class="form-control" name="inputPassword" id="inputPassword" type="password" name="password" placeholder="Password" value="<?php echo $row['r_password']; ?>" required>
                                    </div>
                                    <!-- Form Group (birthday)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputRepeatPassword">Repeat Password</label>
                                        <input class="form-control" id="inputRepeatPassword" type="password" name="password1" placeholder="Repeat Password" value="" required>
                                    </div>
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit" name="updateSubmit">Save changes</button>
                            </form>
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