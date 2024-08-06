<?php

include "config.php";

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    
    $sql = "DELETE FROM `user_information` WHERE ID = '$id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $sql1 = "DELETE FROM `users` WHERE User_ID = '$id' ";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            header("Location: ../users.php?sucess=Account Requestion Successfully deleted!");
        }
    } else {
     echo "Failed: " . mysqli_error($conn);
    }
}

?>