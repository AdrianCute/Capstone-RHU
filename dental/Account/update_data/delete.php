<?php

include "config.php";

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    
    $sql = "DELETE FROM `appointment` WHERE Appointment_ID = '$id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
    header("Location: ../../index.php?sucess=Appointment Successfully Rejected rejected");
    } else {
     echo "Failed: " . mysqli_error($conn);
    }
}

?>
<?php
require __DIR__ . '../../../../vendor/autoload.php'; // Include the Twilio PHP library

use Twilio\Rest\Client;

include "config.php";

if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];

    $sql = "UPDATE `appointment` SET Status='Reject' WHERE Appointment_ID = '$id'";
    $result = mysqli_query($conn, $sql);


    if ($result) {
        // Account SID and Auth Token from your Twilio account
        $accountSid = 'AC55c3bc434e3a7a394cb565d8f0c440e7';
        $authToken = 'd7e434dde0e4b64a15843880611ca284';

        // Create a new Twilio client
        $client = new Client($accountSid, $authToken);

        $query = "SELECT pi.contact_num
        FROM appointment ui
        INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
        WHERE ui.Appointment_ID = '$id'";
        
        $result1 = mysqli_query($conn, $query);
        
        if (!$result1) {
            header("Location: ../../index.php?error=Error sending SMS: " . $e->getMessage());
        }else{
        
        $row = mysqli_fetch_assoc($result1);
        
        $userPhoneNumber = $row['contact_num'];
        try {
            // Send an SMS to the user
            $message = $client->messages->create(
                $userPhoneNumber,
                [
                    'from' => '+12512702652', 
                    'body' => 'Your Appointment was Rejected due to you do not have record in Profiling'          
                        ]
            );

            header("Location: ../../index.php?success=Appointment Rejected successfully");
        } catch (Exception $e) {
            // Handle any errors that occur during SMS sending
            header("Location: ../../index.phperror=Error sending SMS: " . $e->getMessage());
        }
    }
    }
}
?>
