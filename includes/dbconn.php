<?php
$con = mysqli_connect("localhost", "root", "", "pawcare_db");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
