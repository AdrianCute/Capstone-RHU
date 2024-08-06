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


function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

function calculateHeight($age, $height) {
    if ($age < 60) {
        if ($height < $age) {
            return "SSt";
        } elseif ($height >= $age && $height < $age * 2) {
            return "St";
        } elseif ($height >= $age * 2 && $height <= $age * 3) {
            return "N";
        } elseif ($height > $age * 3) {
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

if (isset($_POST['address']) && isset($_POST['lname']) && isset($_POST['birthday'])) {

    $date = date("Y-m-d"); 
    $zone = validate($_POST['zone']);
    $address = validate($_POST['address']);
    $mothers_name = validate($_POST['mother']);
    $firstName = validate($_POST['fname']);
    $lastName = validate($_POST['lname']);
    $middleName = validate($_POST['mname']);
    $IP = validate($_POST['IP']);
    $sex = validate($_POST['sex']);
    $dateOfBirth = validate($_POST['birthday']);
    $date_measured = validate($_POST['date_measured']);
    $weight = validate($_POST['weight']);
    $height = validate($_POST['height']);
    $age =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);    
    // Call the appropriate functions to calculate results
    $calculateWeight = calculateWeight($age, $weight);
    $calculateHeight = calculateHeight($age, $height);
    $calculateWeightAndLength = calculateWeightAndLength($age, $weight, $height);
    
    // Insert data into the database
    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
    INNER JOIN Address_information ta ON pi.Record_ID = ta.Record_ID
    WHERE LName='$lastName' AND FName='$firstName' AND MName='$middleName' 
    AND Age ='$age_years' AND Age__months = '$age_in_months' AND Age_in_years_months = '$age' AND Barangay ='$address'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $existingID = $row['Record_ID'];

            $sql = "INSERT INTO `operation_timbang`(`Record_ID`, `MothersName`, `DateMeasured`, 
            `Weight`, `Height`, 
            `Weight_in_Age_stat`, `Height_in_Age_stat`, `Weight_in_LTandHt_stat`, `Date_input`, `IP`)
                 VALUES('$existingID','$mothers_name','$date_measured','$weight','$height',
                 '$calculateWeight', '$calculateHeight', '$calculateWeightAndLength', '$date', '$IP')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
    header("Location: ../OTP/OTP-all.php?success=data added");
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
    
       
        $sql = "INSERT INTO `operation_timbang`(`Record_ID`, `MothersName`, `DateMeasured`, 
        `Weight`, `Height`, 
        `Weight_in_Age_stat`, `Height_in_Age_stat`, `Weight_in_LTandHt_stat`, `Date_input`, `IP`)
             VALUES('$newID','$mothers_name','$date_measured','$weight','$height',
             '$calculateWeight', '$calculateHeight', '$calculateWeightAndLength', '$date', '$IP')";

        $result = mysqli_query($conn, $sql);

        $sql6 ="INSERT INTO `age_table`(`Record_ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
        ('$newID', '$age_years', '$age_in_months', '$age')";
        $result6 = mysqli_query($conn, $sql6);

        $sql7 ="INSERT INTO `address_information`(`Record_ID`, `Barangay`, `Municipality`, `Province`, `Region`, `zone`)
         VALUES 
        ('$newID', '$address', 'San Jose', 'Camarines Sur', 'Region V', '$zone')";

        $result7 = mysqli_query($conn, $sql7);

    
    
    if (!$result && !$result6 && !$result7) {
        die("Insert query for immunization_information failed: " . mysqli_error($conn));
    }
    
    header("Location: ../OTP/OTP-all.php?success=data added");
    
}
} else {
    header("Location: index.php");
    exit();
}
?>
