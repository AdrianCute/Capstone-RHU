<?php
session_start();
include "config.php";

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    

    $sql1 = "DELETE FROM `vaccine` WHERE Record_ID = '$id' ";
    $result1 = mysqli_query($conn, $sql1);

    $sql2 = "DELETE FROM `vaccine_other_information` WHERE Record_ID = '$id' ";
    $result2 = mysqli_query($conn, $sql2);

    if ( $result1 && $result2  ) {
        $sql = "DELETE FROM `vaccination` WHERE Record_ID = '$id' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: ../Vaccination/vaccination-all.php?sucess=data deleted successfully");
        }
    } else {
     echo "Failed: " . mysqli_error($conn);
    }
}

?>