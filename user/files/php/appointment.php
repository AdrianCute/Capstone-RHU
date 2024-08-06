<?php
include "../update_data/config.php";

function getLoggedInUserId() {
    if (isset($_SESSION['User_ID'])) {
        return $_SESSION['User_ID'];
    } else {
        return null; 
    }
}
function calculateAgeMonths($birthdate)
{
    $today = new DateTime();
    $birthDate = new DateTime($birthdate);
    $age = $today->diff($birthDate);
    
    $yearsInMonths = $age->y * 12;
    $months = $age->m;
    
    $totalMonths = $yearsInMonths + $months;
    
    return $totalMonths; // Return the age in months
}

function calculateYears($birthdate)
{
    $today = new DateTime();
    $birthDate = new DateTime($birthdate);
    $age = $today->diff($birthDate);
    return $age->y; // Return the age in years
}

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function calculateAge($birthDate) {
    // Convert the birth date to a Unix timestamp
    $birthTimestamp = strtotime($birthDate);

    if ($birthTimestamp === false) {
        return "Invalid date format";
    }

    // Get the current Unix timestamp
    $currentTimestamp = time();

    $diffYears = date("Y", $currentTimestamp) - date("Y", $birthTimestamp);
    $diffMonths = date("n", $currentTimestamp) - date("n", $birthTimestamp);

    if ($diffMonths < 0) {
        $diffYears--;
        $diffMonths += 12;
    }

    // Construct the result string
    $result = $diffYears . " Years, " . $diffMonths . " Months";

    return $result;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    
    if (isset($_POST['Fname']) && isset($_POST['address'])) {
     
    
        $id = getLoggedInUserId(); 
        $fname = validate($_POST['Fname']);
        $mname = validate($_POST['Mname']);
        $lname = validate($_POST['Lname']);
        $dateOfBirth = validate($_POST['birthday']);
        $number = validate($_POST['number']);
        $address = validate($_POST['address']);
        $Service = validate($_POST['Service']);
        $age =  calculateAge($dateOfBirth);
        $age_in_months = calculateAgeMonths($dateOfBirth);
        $age_years = calculateYears($dateOfBirth);


        $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
        INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
        INNER JOIN Address_information ta ON pi.Record_ID = ta.Record_ID
        WHERE LName='$lname' AND FName='$fname' AND MName='$mname' 
        AND Age ='$age_years' AND Age__months = '$age_in_months' AND Age_in_years_months = '$age' AND Barangay ='$address'";
        $result = mysqli_query($conn, $query);
    
        if ($row = mysqli_fetch_assoc($result)) {
                $existingID = $row['Record_ID'];

                echo  $existingID.' '.$_SESSION['User_ID'];

                $sql1 ="SELECT * FROM `appointment` WHERE Record_ID = '$existingID' and Status = 'Pending' AND User_ID ='".$_SESSION['User_ID']."'";
                $result1 = mysqli_query($conn, $sql1);

                if ($result1->num_rows > 0) {
                    // Appointment already exists, handle accordingly
                    header("Location: ../Appointment.php?error=You already have an appointment. Please wait for it to be processed.");
                    exit();
                }else {
                    $sql2 = "INSERT INTO `appointment`(`User_ID`,
                    `Date`, `Status`, `Service`, `Record_ID`) VALUES ('".$_SESSION['User_ID']."', NOW(), 'Pending','$Service', '$existingID')";
                    $result2 = mysqli_query($conn, $sql2);
    
                    if ($result2) {
                        header("Location: ../Appointment.php?success=Your Appointment has susccesfully sent, Please wait for it to be approved and your date of appointment");
                        exit();
                    } else {
                        header("Location: ../Appointment.php?error=unknown error occurred");
                        exit();
                    }
                }
            
            } else {
                        header("Location: ../Appointment.php?error=unknown error occurred");
                        exit();
                    }
   
    }else{
        header("Location: ../Appointment.php??error=unknown error occurred");}
}else{
    header("Location: ../Appointment.php??error=unknown error occurred");
}
?>
