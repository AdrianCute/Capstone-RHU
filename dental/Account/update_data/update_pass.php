<?php

include "config.php";


if (isset($_POST['current']) && isset($_POST['newpass']) ) {
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $raw_current =validate($_POST['current']);
    $raw_new = validate($_POST['newpass']);
    $newpass = password_hash( $raw_new, PASSWORD_DEFAULT);
    $confirm = validate($_POST['confirm']);


    if (!password_verify( $raw_current, $_SESSION['Password'])) {
            header("Location: ../Account settings.php?error=inputted current password isn't Match to the Password");
       
    }else if(!password_verify($confirm, $newpass)){
        header("Location: ../Account settings.php?error=Password confirmation doesn't match");

    }else{
        $sql2 = "UPDATE `users` SET `Password`='$newpass' WHERE User_ID = '".$_SESSION['User_ID']."'";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {        
            header("Location: ../Account settings.php?success=Your Personal Information has been Updated");
            exit();
        } 
    }
    
} else {
    header("Location: index.php");
    exit();
}
?>

=
