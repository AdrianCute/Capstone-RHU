<?php
session_start();
include "config.php";

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    

    $sql1 = "DELETE FROM `immunization_information` WHERE Record_ID = '$id' ";
    $result2 = mysqli_query($conn, $sql1);

    $sql4 = "DELETE FROM `baby_information` WHERE Record_ID = '$id' ";
    $result4 = mysqli_query($conn, $sql4);

    if ( $result2 && $result4) {
        $sql = "DELETE FROM `immunization` WHERE Record_ID = '$id' ";
        $result1 = mysqli_query($conn, $sql);
        if ($result1) {
            header("Location: ../Immunization/Immunization-all.php?sucess=data deleted");        }
    } else {
     echo "Failed: " . mysqli_error($conn);
    }
}

?>