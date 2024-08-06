<?php

include "config.php";

if (isset($_POST['fullname']) && isset($_POST['uname']) ) {
    
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

        // Handle image upload
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_img/'.$image;
        
        // Move the uploaded image to the desired folder
        if (move_uploaded_file($image_tmp_name, $image_folder)) {

            $sql = "SELECT * FROM `admin` WHERE UserName='".$_SESSION['UserName']."' ";
            $result = mysqli_query($conn, $sql);

                $sql2 = "UPDATE `admin` SET `FullName`='$name',
                `UserName`='$username', `Profile_img`='$image',`Address`='$address',`PhoneNum`='$number' WHERE UserName='".$_SESSION['UserName']."'";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    // Update the session data with the new image path
                    $_SESSION['Profile_img'] = $image;
                
                    header("Location: ../Profile.php?success=Your Personal Information has been Updated");
                    exit();
                } else {
                    header("Location: index.php?error=unknown error occurred&$user_data");
                    exit();
                }                
    }
    
} else {
    header("Location: index.php");
    exit();
}
?>


?>
