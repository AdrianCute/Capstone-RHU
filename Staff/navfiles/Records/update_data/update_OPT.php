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

function calculateWeightAndLength($age, $weight, $height) {
    if ($age < 60) {
        if ($weight < $height) {
            return "SW";
        } elseif ($weight >= $height && $weight < $height * 2) {
            return "MW";
        } elseif ($weight >= $height * 2 && $weight <= $height * 3) {
            return "N";
        } elseif ($weight > $height * 3 && $weight <= $height * 4) {
            return "OW";
        } elseif ($weight > $height * 4) {
            return "Ob";
        } else {
            return "N/A";
        }
    } else {
        return "Duplicate";
    }
}

function calculateHeight( $age, $height) {
    if ( $age < 60) {
        if ($height < $age) {
            return "SSt";
        } elseif ($height >=  $age && $height <  $age * 2) {
            return "St";
        } elseif ($height >=  $age * 2 && $height <=  $age * 3) {
            return "N";
        } elseif ($height >  $age * 3) {
            return "T";
        } else {
            return "ERR";
        }
    } else {
        return "Duplicate";
    }
}

function calculateWeight($age, $weight) {
    if ($age < 60) {
        if ($weight < 60 && $weight < $age) {
            return "SUW";
        } elseif ($weight < 60 && $weight >= $age && $weight < $age * 2) {
            return "UW";
        } elseif ($weight < 60 && $weight >= $age * 2 && $weight <= $age * 3) {
            return "N";
        } elseif ($weight > 59) {
            return "N/A";
        } elseif ($weight < 60 && $weight > $age * 3) {
            return "OW";
        } else {
            return "ERR";
        }
    } else {
        return "Duplicate";
    }
}

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];

    $address = validate($_POST['address']);
    $mothers_name = validate($_POST['mother']);
    $firstName = validate($_POST['fname']);
    $lastName = validate($_POST['lname']);
$middleName = isset($_POST['mname']) ? validate($_POST['mname']) : null;
$IP = isset($_POST['IP']) ? validate($_POST['IP']) : null;
$sex = isset($_POST['sex']) ? validate($_POST['sex']) : null;
$dateOfBirth = isset($_POST['birthday']) ? validate($_POST['birthday']) : null;
$date_measured = isset($_POST['date_measured']) ? validate($_POST['date_measured']) : null;
$weight = isset($_POST['weight']) ? validate($_POST['weight']) : null;
$height = isset($_POST['height']) ? validate($_POST['height']) : null;

    $aged =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);
    $calculateWeight = calculateWeight($age_in_months, $weight);
    $calculateHeight = calculateHeight($age_in_months, $height);
    $calculateWeightAndLength = calculateWeightAndLength($age_in_months, $weight, $height);

    $sql5 = "UPDATE `address_information` SET `Barangay`='$address' WHERE Record_ID = '$id'";
    $result5 = mysqli_query($conn, $sql5);

    if (!$result5) {
        header("Location: index.php?error=unknown error occurred");
        exit();
    }
    $sql6 = "UPDATE `age_table` SET`Age`='$age_years',`Age__months`='$age_in_months',
    `Age_in_years_months`='$aged' WHERE Record_ID = '$id'";
      $result6 = mysqli_query($conn, $sql6);

      if (!$result6) {
          header("Location: index.php?error=unknown error occurred");
          exit();
      }

    $sql1 = "UPDATE `personal_information` 
             SET `LName`=?, `FName`=?, `MName`=?, `birthdate`=?, `sex`=?, `contact_num`=?
             WHERE `Record_ID` = ?";

    $stmt1 = mysqli_prepare($conn, $sql1);

    if ($stmt1) {
        mysqli_stmt_bind_param($stmt1, "ssssssd", $lastName, $firstName, $middleName, $dateOfBirth, $sex, $contact_num, $id);

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

    $sql2 = "UPDATE `operation_timbang` 
             SET `MothersName`=?, `DateMeasured`=?, `Weight`=?, `Height`=?, `IP`=?
             WHERE `Record_ID` = ?";

    $stmt2 = mysqli_prepare($conn, $sql2);

    if ($stmt2) {
        mysqli_stmt_bind_param($stmt2, "ssddsd", $mothers_name, $date_measured, $weight, $height, $IP, $id);

        if (mysqli_stmt_execute($stmt2)) {
            header("Location: ../OTP/OTP-all.php?success=Updated successfully");
            exit();
        } else {
            echo "Update failed (operation_timbang): " . mysqli_error($conn);
            exit();
        }
    } else {
        echo "Error preparing statement (operation_timbang): " . mysqli_error($conn);
        exit();
    }
}
?>
