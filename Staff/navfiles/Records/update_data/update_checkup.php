<?php
session_start();
include "config.php";

function validate($data) {
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

if (isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];


    $firstName = validate($_POST['fname']);
    $lastName = validate($_POST['lname']);
    $middleName = validate($_POST['mname']);
    $address = validate($_POST['address']);
    $dateOfBirth = validate($_POST['birthday']);
    $number = validate($_POST['number']);
    $sex = validate($_POST['sex']);
    $pwd = validate($_POST['pwd']);
    $classification = validate($_POST['classification']);
    $medhistory = validate($_POST['history']);
    $age =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);

    
    $sql5 = "UPDATE `address_information` SET 
    `Barangay`='$address'
    WHERE Record_ID ='$id'";
    $result5 = mysqli_query($conn, $sql5);

    $sql3 = "UPDATE `medical_information` SET 
    `history`='$medhistory',
    `classification`='$classification',
    `PWD`='$pwd' WHERE Record_ID ='$id' ";
    $result3 = mysqli_query($conn, $sql3);

    $sql6 = "UPDATE `age_table` SET `Age`='$age_years',`Age__months`='$age_in_months',
    `Age_in_years_months`='$age' WHERE Record_ID = '$id'";
      $result6 = mysqli_query($conn, $sql6);

    $sql1 = "UPDATE `personal_information` 
             SET `LName`=?, `FName`=?, `MName`=?, `birthdate`=?, `sex`=?, `contact_num` =?
             WHERE `Record_ID` = ?";

    $stmt1 = mysqli_prepare($conn, $sql1);

    if ($stmt1) {
        mysqli_stmt_bind_param($stmt1, "sssssds", $lastName, $firstName, $middleName, $dateOfBirth, $sex, $number, $id);

        if (mysqli_stmt_execute($stmt1)) {
            mysqli_stmt_close($stmt1);
        } else {
            echo "Update failed (personal_information): " . mysqli_error($conn);
            exit();
        }
    } else {
        echo "Error preparing statement (personal_information): " . mysqli_error($conn);
        exit();
    }

    $serial_num = validate($_POST['srnum']);
    $philhealth = validate($_POST['philhealth']);
    $fp = validate($_POST['hhhead']);
    $date = validate($_POST['date']);
    $complaint = validate($_POST['complaint']);
    $diagnosis = validate($_POST['diagnosis']);
    $treatment = validate($_POST['treatment']);


    $sql2 = "UPDATE `checkup` 
             SET `Family_Serial_num`=?, `philhealthnum`=?, `Head`=?, `Date`=?, `VSChief_Complaint`=?, `Diagnosis`=?, `treatment`=?
             WHERE `Record_ID` = ?";

    $stmt2 = mysqli_prepare($conn, $sql2);

    if ($stmt2) {
        mysqli_stmt_bind_param($stmt2, "sssssssd", $serial_num, $philhealth, $fp, $date, $complaint, $diagnosis, $treatment, $id);

        if (mysqli_stmt_execute($stmt2)) {
            header("Location: ../checkup/checkup-all.php?success= Record updated  successfully");
            exit();
        } else {
            echo "Update failed (checkup): " . mysqli_error($conn);
            exit();
        }
    } else {
        echo "Error preparing statement (checkup): " . mysqli_error($conn);
        exit();
    }
}
?>
