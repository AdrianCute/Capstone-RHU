<?php
session_start();
include "config.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];
    
    $firstName = validate($_POST['fname']);
    $lastName = validate($_POST['lname']);
    $middleName = validate($_POST['mname']);
    $dateOfBirth = validate($_POST['birthday']);
   $place = isset($_POST['place']) ? validate($_POST['place']) : null;
$address = isset($_POST['address']) ? validate($_POST['address']) : null;
$fathers_name = isset($_POST['father']) ? validate($_POST['father']) : null;
$mothers_name = isset($_POST['mother']) ? validate($_POST['mother']) : null;
$weight = isset($_POST['weight']) ? validate($_POST['weight']) : null;
$height = isset($_POST['height']) ? validate($_POST['height']) : null;
$sex = isset($_POST['sex']) ? validate($_POST['sex']) : null;
$health = isset($_POST['center']) ? validate($_POST['center']) : null;
$number = isset($_POST['number']) ? validate($_POST['number']) : null;
$at_birth = isset($_POST['atbirth']) ? validate($_POST['atbirth']) : null;
$first = isset($_POST['first']) ? validate($_POST['first']) : null;
$second = isset($_POST['second']) ? validate($_POST['second']) : null;
$third = isset($_POST['third']) ? validate($_POST['third']) : null;
$fourth = isset($_POST['fourth']) ? validate($_POST['fourth']) : null;
$fifth = isset($_POST['fifth']) ? validate($_POST['fifth']) : null;
$eye = isset($_POST['eye']) ? validate($_POST['eye']) : null;
$vitamin = isset($_POST['vitamin']) ? validate($_POST['vitamin']) : null;
$feed = isset($_POST['breest']) ? validate($_POST['breest']) : null;
$nb = isset($_POST['nb']) ? validate($_POST['nb']) : null;
$hearing = isset($_POST['hearing']) ? validate($_POST['hearing']) : null;

    
    $age =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);
    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE `personal_information` SET `LName`='$lastName', `FName`='$firstName', `MName`='$middleName', `birthdate`='$dateOfBirth', `sex`='$sex' WHERE Record_ID = '$id'";
 
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }
    $sql5 = "UPDATE `address_information` SET `Barangay`='$address' WHERE Record_ID = '$id'";
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

    $sql2 = "UPDATE `immunization_information` SET `PlaceOfBirth`='$place', `FathersName`='$fathers_name', `MothersName`='$mothers_name', `Familynum`='$number', `birth_height`='$height', `birth_weight`='$weight', `health_center`='$health' WHERE Record_ID = '$id'";
 
    $result2 = mysqli_query($conn, $sql2);
    if (!$result2) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }

    $sql3 = "UPDATE `immunization` SET `atbirth`='$at_birth', `firstDose`='$first', `secondDose`='$second', `thirdDose`='$third', `fourthDose`='$fourth', `fifthDose`='$fifth' WHERE Record_ID = '$id'";
 
    $result3 = mysqli_query($conn, $sql3);

    $sql4 = "UPDATE baby_information SET 
    eye_prophy = '$eye',
    vitamin_K = '$vitamin',
    breest_feed = '$feed',
    nb_screening = '$nb',
    nb_hscreening = '$hearing' 
    WHERE Record_ID = '$id'";
      $result8 = mysqli_query($conn, $sql4);
    if (!$result8) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }else{
        header("Location: ../Immunization/Immunization-all.php?success= Record updated  successfully ");
    }
}
?>
