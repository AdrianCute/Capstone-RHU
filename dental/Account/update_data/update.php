<?php

include "config.php";

if (isset($_POST['fullname']) && isset($_POST['uname']) ) {
    $id = $_POST['update_user'];
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['fullname']);
    $username = validate($_POST['uname']);
    $address = validate($_POST['address']);
    $number = validate($_POST['number']);
    $raw_pass =  validate($_POST['password']);
    $newpass = password_hash($raw_pass, PASSWORD_DEFAULT);
    $repass = validate($_POST['confirm']);


    if (empty($username) || empty($newpass) || empty($repass) || empty($name)) {
        header("Location: ../users.php?error=All fields are required&$user_data");
        exit();
    } elseif (!password_verify($repass, $newpass)) {
        header("Location: ../users.php?error=The confirmation password does not match&$user_data");
        exit();
    } else {


    $sql2 = "UPDATE `users` SET 
    `UserName`='$username', `Password` = '$newpass' WHERE User_ID ='$id'";
    $result2 = mysqli_query($conn, $sql2);

    $sql3 = "UPDATE `user_information` SET `FullName`='$name',`Address`='$address',
    `Contact_num`='$number'WHERE ID='$id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result2 && $result3) {

        header("Location: ../users.php?success=Your Personal Information has been Updated");
        exit();
    } else {
        header("Location: ../users.php?error=unknown error occurred&$user_data");
        exit();
    }             
}
} else {
    header("Location: ../users.php");
    exit();
}
?>


?>
