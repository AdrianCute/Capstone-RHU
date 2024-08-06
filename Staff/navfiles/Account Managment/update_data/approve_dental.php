<?php
require __DIR__ . '../../../../../vendor/autoload.php'; // Include the Twilio PHP library

use Twilio\Rest\Client;

include "config.php";

if (isset($_POST['approvedata'])) {
    $id = $_POST['approve_id'];

    // Update the user's status to 'Approve' in the database
    $sql = "UPDATE `users` SET Status='Approve' WHERE User_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Account SID and Auth Token from your Twilio account
        $accountSid = 'AC55c3bc434e3a7a394cb565d8f0c440e7';
        $authToken = 'd7e434dde0e4b64a15843880611ca284';

        // Create a new Twilio client
        $client = new Client($accountSid, $authToken);

        $query = "SELECT pi.contact_num
        FROM user_information ui
        INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
        WHERE ui.User_ID = '$id'";
        
        $result1 = mysqli_query($conn, $query);
        
        if (!$result1) {
            header("Location:../Dental-Accounts.php?error=Error sending SMS: " . $e->getMessage());
        }else{
        
        $row = mysqli_fetch_assoc($result1);
        
        $userPhoneNumber = $row['contact_num'];
        try {
            // Send an SMS to the user
            $message = $client->messages->create(
                $userPhoneNumber,
                [
                    'from' => '+12512702652', 
                    'body' => 'Your account has been approved. You can now log in.'
                ]
            );

            header("Location:../Dental-Accounts.php?success=Data updated successfully");
        } catch (Exception $e) {
            // Handle any errors that occur during SMS sending
            header("Location:../Dental-Accounts.php?error=Error sending SMS: " . $e->getMessage());
        }
    }
    }
}
?>
