<?php

include "config.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function calculateYears($birthdate)
{
    $today = new DateTime();
    $birthDate = new DateTime($birthdate);
    $age = $today->diff($birthDate);
    return $age->y; // Return the age in years
}
if(isset($_POST['updatedata']))
{   
    $id = $_POST['update_record_id'];

        
        $medicine = validate($_POST['medicine']   );
        $tooth = validate($_POST['tooth']);
        $name = validate($_POST['fullname']);
        $bday = validate($_POST['bday']);
        $appointment = validate($_POST['appointment']);
        $address = validate($_POST['address']);
        $number = validate($_POST['number']);
         $age = calculateYears($bday);

        $sql2 = "UPDATE `appointment` SET `Appointment_date`='$appointment', `Medicine_given`='$medicine', `tooth`='$tooth' WHERE User_ID = '$id'";
         $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                $sql = "UPDATE `user_information` SET `FullName`='$name',`Address`='$address',`Contact_num`='$number',
                `Age`='$age',`Birthday`='$bday'
                 WHERE ID = '$id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("Location: ../../files/Records.php?success=Records Updated successfully");    
                    exit();
           
                 }
            } else {
                header("Location: index.php?error=unknown error occurred&$user_data");
                exit();
            }
}

?>