<?php

include "config.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    
  
        $sql2 = "UPDATE `appointment` SET Status='Reject' WHERE Appointment_ID = '$id'";
         $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                header("Location: ../../files/Pending Appointments.php?success=data added");
                exit();
            } else {
                header("Location: index.php?error=unknown error occurred&$user_data");
                exit();
            }
}

?>