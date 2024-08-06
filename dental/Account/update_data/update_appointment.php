<?php

include "config.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['updatedata']))
{   
    $id = $_POST['update_id'];

        $medicine = validate($_POST['medicine']   );
        $tooth = validate($_POST['tooth']);

        $sql2 = "UPDATE `appointment` SET Status='Complete', `Medicine_given`='$medicine', `tooth`='$tooth' WHERE Appointment_ID = '$id'";
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