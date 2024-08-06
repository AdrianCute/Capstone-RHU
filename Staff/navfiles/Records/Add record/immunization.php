<?php
include "config.php";

function generateFamilyNumber($municipalityCode, $barangayName, $lastFamilyNumber) {
    // Extract the first three letters of the barangay name
    $barangayCode = strtoupper(substr($barangayName, 0, 3));
    
    // Extract the numeric part and increment it
    $numericPart = intval(substr($lastFamilyNumber, -4)) + 1;
    
    // Format the numeric part to have leading zeros
    $formattedNumericPart = sprintf("%04d", $numericPart);
    
    // Concatenate the parts to form the new family number
    $newFamilyNumber = $municipalityCode . "-" . $barangayCode . "-" . $formattedNumericPart;
    
    return $newFamilyNumber;
}

$municipalityCode = "SJ";
$barangayName = $_POST['address'];
$lastAssignedNumber = "SJ-DOL-0001";
$newNumber = generateFamilyNumber($municipalityCode, $barangayName, $lastAssignedNumber);
echo $newNumber;

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


if (isset($_POST['address']) && isset($_POST['lname']) && isset($_POST['birthday'])) {


    $date = date("Y-m-d");
    $firstName = validate($_POST['fname']);
    $lastName = validate($_POST['lname']);
    $middleName = validate($_POST['mname']);
    $dateOfBirth = validate($_POST['birthday']);
    $place = validate($_POST['place']);
    $address = validate($_POST['address']);
    $fathers_name = validate($_POST['father']);
    $mothers_name = validate($_POST['mother']);
    $weight = validate($_POST['weight']);
    $height = validate($_POST['height']);
    $sex = validate($_POST['sex']);
    $health = validate($_POST['center']);
    $number = validate($_POST['number']);
    $at_birth = validate($_POST['atbirth']);
    $first = validate($_POST['first']);
    $second = validate($_POST['second']);
    $third = validate($_POST['third']);
    $fourth = validate($_POST['fourth']);
    $fifth = validate($_POST['fifth']);
    $eye = validate($_POST['eye']);
    $vitamin = validate($_POST['vitamin']);
    $feed = validate($_POST['breest']);
    $nb = validate($_POST['nb']);
    $hearing = validate($_POST['hearing']);

    $age =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);

    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
    INNER JOIN age_table age ON pi.Record_ID = age.ID
    INNER JOIN Address_information ta ON pi.Record_ID = ta.ID
    WHERE LName='$lastName' AND FName='$firstName' AND MName='$middleName' 
    AND Age ='$age_years' AND Age__months	 = '$age_in_months' AND Age_in_years_months = '$age' AND Barangay ='$address'";
        $result = mysqli_query($conn, $query);


        if ($row = mysqli_fetch_assoc($result)) {
            $existingID = $row['Record_ID'];

            $sql = "INSERT INTO `immunization`(`atbirth`, `firstDose`, `secondDose`, `thirdDose`, 
                `fourthDose`, `fifthDose`, `ID`, `Date_input`)
                 VALUES('$at_birth','$first','$second','$third','$fourth','$fifth','$existingID', '$date')";

            $result = mysqli_query($conn, $sql);

            $sql1 = "INSERT INTO `immunization_information`(`ID`, `PlaceOfBirth`, `FathersName`, `MothersName`,
                  `Familynum`, `birth_height`, `birth_weight`, `health_center`)
                  VALUES('$existingID','$place','$fathers_name','$mothers_name','$number','$height','$weight', '$health')";

            $result1 = mysqli_query($conn, $sql1);

            $sql9 = "INSERT INTO `baby_information`(`ID`, `eye_prophy`, `vitamin_K`, `breest_feed`, `nb_screening`, `nb_hscreening`)
             VALUES('$existingID', '$eye', '$vitamin', '$vitamin', '$feed', '$nb', '$hearing' )";

             $result9 = mysqli_query($conn, $sql9);
            if ($result && $result1) {
                header("Location: ../Immunization/Immunization-all.php?success=data added");
            } else {
                die("Insert query failed: " . mysqli_error($conn));
            }
        }
     else {
        $sql5 = "INSERT INTO `personal_information`(`LName`, `FName`, `MName`, `birthdate`, `sex`
        ) VALUES ('$lastName', '$firstName',
             '$middleName', '$dateOfBirth', '$sex')";
        $result2 = mysqli_query($conn, $sql5);
    
        if (!$result2) {
        die("Insert query for personal_information failed: " . mysqli_error($conn));
        }
    
        $newID = mysqli_insert_id($conn);

        $sql6 ="INSERT INTO `age_table`(`ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
        ('$newID', '$age_years', '$age_in_months', '$age')";
        $result6 = mysqli_query($conn, $sql6);

        $sql7 ="INSERT INTO `address_information`(`ID`, `Barangay`, `Municipality`, `Province`, `Region`)
         VALUES 
        ('$newID', '$address', 'San Jose', 'Camarines Sur', 'Region V')";

        $result7 = mysqli_query($conn, $sql7);
    
        $sql4 = "INSERT INTO `immunization`(`atbirth`, `firstDose`, `secondDose`, `thirdDose`, 
        `fourthDose`, `fifthDose`, `ID`, `Date_input`)
         VALUES('$at_birth','$first','$second','$third','$fourth','$fifth','$newID', '$date')";
        $result4 = mysqli_query($conn, $sql4);
    
        if (!$result4) {
        die("Insert query for immunization failed: " . mysqli_error($conn));
    }
    
    $sql1 = "INSERT INTO `immunization_information`(`ID`, `PlaceOfBirth`, `FathersName`, `MothersName`,
        `Familynum`, `birth_height`, `birth_weight`, `health_center`)
        VALUES('$newID','$place','$fathers_name','$mothers_name','$number','$height','$weight', '$health')";
    
    $result1 = mysqli_query($conn, $sql1);
    $sql9 = "INSERT INTO `baby_information`(`ID`, `eye_prophy`, `vitamin_K`, `breest_feed`, `nb_screening`, `nb_hscreening`)
    VALUES('$newID', '$eye', '$vitamin', '$feed', '$nb', '$hearing' )";

    $result9 = mysqli_query($conn, $sql9);
    if (!$result1) {
        die("Insert query for immunization_information failed: " . mysqli_error($conn));
    }
    
    header("Location: ../Immunization/Immunization-all.php?success=data added");
    
}
} else {
    header("Location: ../Immunization/Immunitarion-all.php");
    exit();
}


?>
