<?php
session_start();
include "config.php";

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    
    $sql = "DELETE FROM checkup WHERE `Record_ID` = '$id' ";
    $result = mysqli_query($conn, $sql);
  
    $sql4 = "DELETE FROM other_information WHERE `Record_ID` = '$id'";
    $result4 = mysqli_query($conn, $sql4);

    $sql2 = "DELETE FROM medical_information WHERE `Record_ID` = '$id'";
    $result2 = mysqli_query($conn, $sql2);
    
    if ($result && $result2 && $result4) {
    header("Location: ../checkup/checkup-all.php?sucess=data deleted");
    } else {
     echo "Failed: " . mysqli_error($conn);
    }
}

?>