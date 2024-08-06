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
    $lname = validate($_POST['lname']);
    $mname = validate($_POST['mname']);
    $username = validate($_POST['uname']);
    $address = validate($_POST['address']);
    $number = validate($_POST['number']);

        // Handle image upload
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_img/'.$image;
        
        // Move the uploaded image to the desired folder
        if (move_uploaded_file($image_tmp_name, $image_folder)) {

            $sql = "SELECT ui.Record_ID FROM user_information ui INNER JOIN users u ON ui.User_ID = u.User_ID
             WHERE ui.User_ID = '".$_SESSION['User_ID']."'";
                $result = mysqli_query($conn, $sql);

                if ($row = mysqli_fetch_assoc($result)) {
                   $Record_ID = $row['Record_ID'];
            

                $sql2 = "UPDATE `users` SET 
                `UserName`='$username', `Profile`='$image' WHERE User_ID ='".$_SESSION['User_ID']."'";
                $result2 = mysqli_query($conn, $sql2);

                $sql3 = "UPDATE `personal_information` SET `FName`='$name', `MName`='$lname', `LName`='$mname',
                `contact_num`='$number' WHERE Record_ID = $Record_ID";
                $result3 = mysqli_query($conn, $sql3);
                $sql4 = "UPDATE `address_information` SET `Barangay`='$address' WHERE Record_ID = $Record_ID";
                $result4 = mysqli_query($conn, $sql4);

                if ($result2 && $result3 && $result4) {
                    // Update the session data with the new image path
                    $_SESSION['Profile'] = $image;
                    $_SESSION['FName'] = $name;
               $_SESSION['MName'] = $mname;
               $_SESSION['LName'] = $lname;

                    $_SESSION['Address'] = $address;
                    $_SESSION['UserName'] = $username;
                    $_SESSION['Contact_num'] = $number;

                
                    header("Location: ../Profile.php?success=Your Personal Information has been Updated");
                    exit();
                } else {
                    header("Location: index.php?error=unknown error occurred&$user_data");
                    exit();
                }
            }   
                             
    }else{
        $sql = "SELECT ui.Record_ID FROM user_information ui INNER JOIN users u ON ui.User_ID = u.User_ID
        WHERE ui.User_ID = '".$_SESSION['User_ID']."'";
           $result = mysqli_query($conn, $sql);

           if ($row = mysqli_fetch_assoc($result)) {
              $Record_ID = $row['Record_ID'];
       

           $sql2 = "UPDATE `users` SET 
           `UserName`='$username' WHERE User_ID ='".$_SESSION['User_ID']."'";
           $result2 = mysqli_query($conn, $sql2);

           $sql3 = "UPDATE `personal_information` SET `FName`='$name', `MName`='$lname', `LName`='$mname',
           `contact_num`='$number' WHERE Record_ID = $Record_ID";
           $result3 = mysqli_query($conn, $sql3);
           $sql4 = "UPDATE `address_information` SET `Barangay`='$address' WHERE Record_ID = $Record_ID";
           $result4 = mysqli_query($conn, $sql4);

           if ($result2 && $result3 && $result4) {
               // Update the session data with the new image path
               $_SESSION['FName'] = $name;
          $_SESSION['MName'] = $mname;
          $_SESSION['LName'] = $lname;

               $_SESSION['Address'] = $address;
               $_SESSION['UserName'] = $username;
               $_SESSION['Contact_num'] = $number;

           
               header("Location: ../Profile.php?success=Your Personal Information has been Updated");
               exit();
           } else {
               header("Location: index.php?error=unknown error occurred&$user_data");
               exit();
           }
       }   
    }
         
    
} else {
    header("Location: index.php");
    exit();
}
?>


?>
