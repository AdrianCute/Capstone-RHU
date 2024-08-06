<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    // Set up email parameters
    $to = "acayao254@gmail.com";
    $subject = "User sent a message";
    $message = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";
    
 
    if (mail($to, $subject, $message, $headers)) {
       header("Location:../index.php?sucess= email sent successfully");
    } else {
        echo "Failed to send the email. Please try again later.";
    }
}else{
    header("localtion:../index.php?error= Sending email failed");

}
?>
