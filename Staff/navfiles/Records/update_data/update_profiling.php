<?php
session_start();
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
// Validate user inputs (as you already did)
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['updatedata']) ) {
    $id = $_POST['update_id'];

    $dateOfVisit = validate($_POST['visit']);
    $householdNumber = validate($_POST['hhnum']);
    $barangay = validate($_POST['address']);
    $numberOfFamilies = validate($_POST['number_fam']);
    $firstName = validate($_POST['fname']);
    $lastName = validate($_POST['lname']);
    $middleName = validate($_POST['mname']);
$relationshipToHHHead = isset($_POST['relationship']) ? validate($_POST['relationship']) : null;
$dateOfBirth = isset($_POST['birthday']) ? validate($_POST['birthday']) : null;
$sex = isset($_POST['sex']) ? validate($_POST['sex']) : null;
$civilStatus = isset($_POST['civil_status']) ? validate($_POST['civil_status']) : null;
$educationalAttainment = isset($_POST['educ']) ? validate($_POST['educ']) : null;
$religion = isset($_POST['religion']) ? validate($_POST['religion']) : null;
$ethnicity = isset($_POST['ethnicity']) ? validate($_POST['ethnicity']) : null;
$fourPsMember = isset($_POST['fourpsmember']) ? validate($_POST['fourpsmember']) : null;
$fourPsNumber = isset($_POST['fourps_num']) ? validate($_POST['fourps_num']) : null;
$philhealthCategory = isset($_POST['phil_category']) ? validate($_POST['phil_category']) : null;
$philhealthNumber = isset($_POST['phil_num']) ? validate($_POST['phil_num']) : null;
$medicalHistory = isset($_POST['history']) ? validate($_POST['history']) : null;
$classification = isset($_POST['classification']) ? validate($_POST['classification']) : null;
$lastMenstrualPeriod = isset($_POST['menstrual']) ? validate($_POST['menstrual']) : null;
$usingAnyFPMethods = isset($_POST['fp_methods']) ? validate($_POST['fp_methods']) : null;
$fpMethodUsed = isset($_POST['method']) ? validate($_POST['method']) : null;
$fpStatus = isset($_POST['fp_status']) ? validate($_POST['fp_status']) : null;
$typeOfWaterSource = isset($_POST['water']) ? validate($_POST['water']) : null;
$typeOfToiletFacility = isset($_POST['toilet']) ? validate($_POST['toilet']) : null;

    $age =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);

    $sql2 = "UPDATE `personal_information` SET `LName`='$lastName', `FName`='$firstName', 
    `MName`='$middleName', `birthdate`='$dateOfBirth', 
    `sex`='$sex' WHERE `Record_ID` = '$id'";

    $result = mysqli_query($conn, $sql2);
    if (!$result) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }
    $sql5 = "UPDATE `address_information` SET `Barangay`='$barangay' WHERE Record_ID = '$id'";
    $result5 = mysqli_query($conn, $sql5);

    if (!$result) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }
    $sql6 = "UPDATE `age_table` SET`Age`='$age_years',`Age__months`='$age_in_months',
    `Age_in_years_months`='$age' WHERE Record_ID = '$id'";
      $result6 = mysqli_query($conn, $sql6);

      if (!$result6) {
          header("Location: index.php?error=unknown error occurred");
          exit();
      }
    $sql1= "UPDATE `other_information` SET `religion`='$religion', `education`='$educationalAttainment',
    `civil_status`='$civilStatus', `Ethinicity`='$ethnicity' WHERE `Record_ID` = '$id'";

    $result1 = mysqli_query($conn, $sql1);
    if (!$result1) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }
    $sql3 = "UPDATE `profiling` SET `Visit`='$dateOfVisit',
    `fourps`='$fourPsMember', `fourps_number`='$fourPsNumber', `phil_category`='$philhealthCategory', 
    `phil_number`='$philhealthNumber', `water`='$typeOfWaterSource', `toilet`='$typeOfToiletFacility', 
    `household_num`='$householdNumber', `number_family`='$numberOfFamilies', 
    `relationship`='$relationshipToHHHead' WHERE `Record_ID` = '$id'";
    
     
    $result2 = mysqli_query($conn, $sql3);
    if (!$result2) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }

    $sql4 = "UPDATE `medical_information` SET `history`='$medicalHistory', 
    `classification`='$classification', `mentraul`='$lastMenstrualPeriod', 
    `UsingFp`='$usingAnyFPMethods', `method_use`='$fpMethodUsed', `fp_status`='$fpStatus'
     WHERE `Record_ID` ='$id'";
     
    $result3 = mysqli_query($conn, $sql4);
    if (!$result3) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }else{
        header("Location: ../Profiling/profiling-all.php?success= updated data successfully ");
    }
}

?>
