<?php

include "config.php";

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    
    $sql = "DELETE FROM `appointment` WHERE Appointment_ID = '$id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
    header("Location: ../../files/Records.php?sucess=Record Successfully Deleted");
    } else {
     echo "Failed: " . mysqli_error($conn);
    }
}

?>