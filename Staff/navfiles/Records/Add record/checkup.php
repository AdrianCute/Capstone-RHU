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

if (isset($_POST['srnum']) && isset($_POST['lname']) && isset($_POST['address'])) {
    $serial_num = validate($_POST['srnum']);
    $firstName = validate($_POST['fname']);
    $lastName = validate($_POST['lname']);
    $middleName = validate($_POST['mname']);
    $dateOfBirth = validate($_POST['birthday']);
    $sex = validate($_POST['sex']);
    $address = validate($_POST['address']);
    $medhistory = validate($_POST['history']);
    $fp = validate($_POST['hhhead']);
    $classification = validate($_POST['classification']);
    $philhealth = validate($_POST['philhealth']);
    $number = validate($_POST['number']);
    $pwd = validate($_POST['pwd']);
    $dateCheckup = validate($_POST['date']);
    $complaint = validate($_POST['complaint']);
    $diagnosis = validate($_POST['diagnosis']);
    $treatment = validate($_POST['treatment']);
    $age =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);
    $date = date("Y-m-d");

    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
    INNER JOIN Address_information ta ON pi.Record_ID = ta.Record_ID
    WHERE LName='$lastName' AND FName='$firstName' AND MName='$middleName' 
    AND Age ='$age_years' AND Age__months	 = '$age_in_months' AND 
    Age_in_years_months = '$age' AND Barangay ='$barangay'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }


    if ($row = mysqli_fetch_assoc($result)) {
        $existingID = $row['Record_ID'];

        $sql1 = "INSERT INTO `checkup`(`Record_ID`, `Date`, `VSChief_Complaint`, `Diagnosis`, `treatment`, 
        `Date_input`, `Family_Serial_num`, `physician`) 
        VALUES ('$existingID','$dateCheckup','$complaint','$diagnosis','$treatment', '$date', '$serial_num', 'Dr. Arnel P. Armenia')";
        $result1 = mysqli_query($conn, $sql1);

        $sql4 = "INSERT INTO `medical_information`(`Record_ID`, `history`, `classification`, `PWD`) VALUES ('$newID','$medhistory', '$classification', '$pwd')";
        $result4 = mysqli_query($conn, $sql4);

        $sql3 = "UPDATE `personal_information` SET `contact_num`='$number' WHERE Record_ID = '$existingID'";
        $result3 = mysqli_query($conn, $sql3);

        $result7 = mysqli_query($conn, $sql7);
        if ($result1 && $result3 && $result4) {
            header("Location: ../checkup/checkup-all.php?success=data added");
        } else {
            die("Insert/update query failed: " . mysqli_error($conn));
        }
    } else {
        $sql = "INSERT INTO `personal_information`(`LName`, `FName`, `MName`,
        `birthdate`, `sex`, `contact_num`) VALUES ('$lastName', '$firstName', '$middleName', '$dateOfBirth', 
        '$sex', '$number')";
        $result2 = mysqli_query($conn, $sql);

        if (!$result2) {
            die("Insert query failed: " . mysqli_error($conn));
        }

        $newID = mysqli_insert_id($conn);

        $sql4 = "INSERT INTO `checkup`(`Record_ID`, `Date`, `VSChief_Complaint`, `Diagnosis`, `treatment`, `Date_input`, `Family_Serial_num`, `physician`, `philhealthnum`, `Head`) VALUES ('$newID','$dateCheckup','$complaint','$diagnosis','$treatment', '$date', '$serial_num', 'Dr. Arnel P. Armenia', '$philhealth', '$fp')";
        $result4 = mysqli_query($conn, $sql4);

        $sql6 ="INSERT INTO `age_table`(`Record_ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
        ('$newID', '$age_years', '$age_in_months', '$age')";
        $result6 = mysqli_query($conn, $sql6);


        $sql7 ="INSERT INTO `address_information`(`Record_ID`, `Barangay`, `Municipality`, `Province`, `Region`)
        VALUES ('$newID', '$address', 'San Jose', 'Camarines Sur', 'Region V')";
        $result7 = mysqli_query($conn, $sql7);

        $sql3 = "INSERT INTO `medical_information`(`Record_ID`, `history`, `classification`, `PWD`) VALUES ('$newID','$medhistory', '$classification', '$pwd')";
        $result3 = mysqli_query($conn, $sql3);

        if ($result4 && $result3) {
            header("Location: ../checkup/checkup-all.php?success=data added");
        } else {
            die("Insert query failed: " . mysqli_error($conn));
        }
    }
} else {
    header("Location: ../checkup/checkup-all.php");
    exit();
}
?>
