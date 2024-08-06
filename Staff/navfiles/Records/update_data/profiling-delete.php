<?php
session_start();
include "config.php";

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    
    $sql = "DELETE FROM `profiling` WHERE Record_ID = '$id' ";
    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM `medical_information` WHERE Record_ID = '$id' ";
    $result = mysqli_query($conn, $sql);
    
    $sql = "DELETE FROM `other_information` WHERE Record_ID = '$id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
    header("Location: ../Profiling/profiling-all.php?success=data deleted successfully");
    } else {
     echo "Failed: " . mysqli_error($conn);
    }
}

?>