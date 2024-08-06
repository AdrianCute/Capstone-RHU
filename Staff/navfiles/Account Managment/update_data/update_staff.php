<?php

include "config.php";
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
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['fname']) && isset($_POST['uname']) ) {
    $id = $_POST['update_user'];

    $name = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $mname = validate($_POST['mname']);
    $username = validate($_POST['uname']);
    $bday = validate($_POST['bday']);
    $address = validate($_POST['address']);
    $age =  calculateAge($bday);
    $age_in_months = calculateAgeMonths($bday);
    $age_years = calculateYears($bday);   
    $number = validate($_POST['number']);



    $sql2 = "UPDATE `users` SET 
    `UserName`='$username' WHERE User_ID ='$id'";
    $result2 = mysqli_query($conn, $sql2);
   
   $sql = "SELECT ui.Record_ID FROM user_information ui INNER JOIN users u ON ui.User_ID = u.User_ID
    WHERE ui.User_ID = '$id'";
      $result = mysqli_query($conn, $sql);

      if ($row = mysqli_fetch_assoc($result)) {
         $Record_ID = $row['Record_ID'];
         $sql3 = "UPDATE `personal_information` SET `FName`='$name', `MName`='$lname', `LName`='$mname',
         `contact_num`='$number', `birthdate`='$bday' WHERE Record_ID = $Record_ID";
$result3 = mysqli_query($conn, $sql3);
$sql4 = "UPDATE `age_table` SET `Age`='$age_years',`Age__months`='$age_in_months',`Age_in_years_months`='$age' 
WHERE Record_ID = $Record_ID";
$result2 = mysqli_query($conn, $sql4);

$sql5 = "UPDATE `address_information` SET `Barangay`='$address' WHERE  Record_ID = $Record_ID";
$result5 = mysqli_query($conn, $sql5);
if ($result2 && $result3 && $result5) {

    header("Location: ../Staff.php?success=Information has been Updated");
    exit();
} else {
    header("Location: ../Staff.php?error=unknown error occurred&$user_data");
    exit();
}    
      }
   
        
} else {
    header("Location: ../Barangay-accounts.php");
    exit();
}
?>
