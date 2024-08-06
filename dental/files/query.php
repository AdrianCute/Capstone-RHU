<?php
include "../Account/update_data/config.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Manila'); // Replace 'Your/Timezone' with the actual timezone identifier

// Query to retrieve unique dates with at least 10 occurrences
$sql = "SELECT Appointment_date FROM appointment GROUP BY Appointment_date HAVING COUNT(*) >= 10";
$result = $conn->query($sql);

$appointmentDates = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointmentDates[] = $row['Appointment_date'];
    }
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($appointmentDates);
?>
