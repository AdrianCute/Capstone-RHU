<?php
// check_username.php
include "config.php";

// Your database connection logic goes here

// Retrieve the username from the POST request
$username = $_POST['username'];


$query = "SELECT * FROM users WHERE UserName = '$username'";
 $result = mysqli_query($conn, $query);

 if (mysqli_num_rows($result) > 0) {
    echo 'taken';
} else {
    echo 'available';
}
?>
