<?php
require __DIR__ . '../../../../vendor/autoload.php';
use Twilio\Rest\Client;
include "config.php";

if (isset($_POST['updatedata'])) {
    $id = $_POST['update_id'];
    $date = $_POST['appointment_date'];
    
    $dateTime = new DateTime($date);

    // Format the date as desired
    $formattedDate = $dateTime->format('l, F j, Y');
    
    // Check if the date is already available
    $dateCheckQuery = "SELECT COUNT(*) as count FROM `appointment` WHERE Appointment_date = '$date'";
    $dateCheckResult = mysqli_query($conn, $dateCheckQuery);
    $dateCheckRow = mysqli_fetch_assoc($dateCheckResult);

    // Check if the number of rows with that date is less than 10
    if ($dateCheckRow['count'] < 10) {
        // Update the appointment date
        $updateQuery = "UPDATE `appointment` SET Status='Approve', Appointment_date='$date' WHERE Appointment_ID = '$id'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
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
            } else {
                $row = mysqli_fetch_assoc($result1);
                $userPhoneNumber = $row['contact_num'];
                try {
                    // Send an SMS to the user
                    $message = $client->messages->create(
                        $userPhoneNumber,
                        [
                            'from' => '+12512702652',
                            'body' => 'Your Appointment has been approved. The Date of your Appointment is ' . $formattedDate . '.'
                        ]
                    );

                    header("Location: ../../index.php?success=Data updated successfully");
                } catch (Exception $e) {
                    // Handle any errors that occur during SMS sending
                    header("Location: ../../index.php?error=Error sending SMS: " . $e->getMessage());
                }
            }
        } else {
            header("Location: ../../index.php?error= The date selected is already full, 
            it already have 10 appointments, Please select another date of appointment ");
        }
    } else {
        // Error: Date not available or already has 10 appointments
        header("Location: ../../index.php?error=Date not available or already has 10 appointments");
    }
}
?>
