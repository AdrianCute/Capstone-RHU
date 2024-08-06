<?php
session_start();
include "config.php";

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    
    $sql = "DELETE FROM `operation_timbang` WHERE Record_ID = '$id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
    header("Location: ../OTP/OTP-all.php?success=data deleted");
    } else {
     echo "Failed: " . mysqli_error($conn);
    }
}

?>