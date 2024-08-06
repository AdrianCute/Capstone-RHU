<?php

    include "config.php";
    
    require '../../../../vendor/autoload.php';
        function splitAddress($add) {
        $addresssplit = explode(', ', $add);
    
        $brgy = '';
        $muni = '';
        $pro = '';
    
        if (isset( $addresssplit[0])) {
            $brgy =  $addresssplit[0];
        }
        if (isset( $addresssplit[1])) {
            $muni =  $addresssplit[1];
        }
    
        if (count( $addresssplit) > 2) {
            $pro = implode(' ', array_slice( $addresssplit, 2));
        }
    
        return array(
            'brgy' => $brgy,
            'muni' => $muni,
            'pro' => $pro
        );
    }
    function splitFullName($fullName) {
        $nameParts = explode(', ', $fullName);
    
        $lastName = '';
        $firstName = '';
        $middleName = '';
    
        if (isset($nameParts[0])) {
            $lastName = $nameParts[0];
        }
        if (isset($nameParts[1])) {
            $firstName = $nameParts[1];
        }
    
        if (count($nameParts) > 2) {
            $middleName = implode(' ', array_slice($nameParts, 2));
        }
    
        return array(
            'lastName' => $lastName,
            'firstName' => $firstName,
            'middleName' => $middleName
        );
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

function validate($data, $excludeChars = array()) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    // Exclude specific characters
    if (!empty($excludeChars)) {
        $data = str_replace($excludeChars, '', $data);
    }

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
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if(isset($_POST['import']))
    {
        $fileName = $_FILES['excel']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
        $allowed_ext = ['xls', 'csv', 'xlsx'];
    
        if(in_array($file_ext, $allowed_ext))
        {
            $inputFileNamePath = $_FILES['excel']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();
    
            $count = 0; // Initialize count
            foreach($data as $row)
            {
                if($count > 0)
                {
                 $serial_num = isset($row[0]) ? $row[0] : null;
$name = isset($row[1]) ? splitFullName($row[1]) : null;
$dateOfBirth = isset($row[2]) ? $row[2] : null;
$age_years = isset($row[3]) ? $row[3] : null;
$sex = isset($row[4]) ? $row[4] : null;
$address = isset($row[5]) ? splitAddress($row[5]) : null;
$medhistory = isset($row[6]) ? $row[6] : null;
$attend = isset($row[7]) ? $row[7] : null;
$fp = isset($row[8]) ? $row[8] : null;
$classification = isset($row[9]) ? $row[9] : null;
$philhealth = isset($row[10]) ? $row[10] : null;
$phonenum = isset($row[11]) ? $row[11] : null;
$pwd = isset($row[12]) ? $row[12] : null;
$dateCheckup = isset($row[13]) ? $row[13] : null;
$complaint = isset($row[14]) ? $row[14] : null;
$diagnosis = isset($row[15]) ? $row[15] : null;
$treatment = isset($row[16]) ? $row[16] : null;

                    $date = date("Y-m-d"); 
                    $age =  calculateAge($dateOfBirth);
                    $age_in_months = calculateAgeMonths($dateOfBirth);
                    
           $lName = mysqli_real_escape_string($conn, validate($name['lastName'], array(', ', ',')));
$FName = mysqli_real_escape_string($conn, validate($name['firstName'], array(', ', ',')));
$MName = mysqli_real_escape_string($conn, validate($name['middleName'], array(', ', ',')));
$addr = mysqli_real_escape_string($conn, validate($address['brgy'], array(', ', ',')));

                    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
                    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
                    INNER JOIN address_information ta ON pi.Record_ID = ta.Record_ID
                    WHERE  LName='$lName' AND FName='$FName' AND MName='$MName' AND 
                    Age ='$age_years' AND Age__months = '$age_in_months' AND Age_in_years_months = '$age'
                    AND Barangay ='$addr'";
                    $result = mysqli_query($conn, $query);
                
                    if ($row = mysqli_fetch_assoc($result)) {
                        $existingID = $row['Record_ID'];
                
                        $sql1 = "INSERT INTO `checkup`(`Record_ID`, `Date`, `VSChief_Complaint`, `Diagnosis`, `treatment`, 
                            `Date_input`, `Family_Serial_num`, `physician`) 
                            VALUES ('$existingID','$dateCheckup','$complaint','$diagnosis','$treatment', '$date', '$serial_num', 'Dr. Arnel P. Armenia')";
                            $result1 = mysqli_query($conn, $sql1);

                            $sql4 = "INSERT INTO `medical_information`(`Record_ID`, `history`, `classification`, `PWD`) 
                            VALUES ('$existingID','$medhistory', '$classification', '$pwd')";
                            $result4 = mysqli_query($conn, $sql4);

                            $sql3 = "UPDATE `personal_information` SET `contact_num`='$phonenum' WHERE Record_ID = '$existingID'";
                            $result3 = mysqli_query($conn, $sql3);

                            if ($result1 && $result3 && $result4) {
                                header("Location: ../checkup/checkup-all.php?success=data added successfully");
                            } else {
                             header("Location: ../checkup/checkup-all.php?error=Insert query failed: " . mysqli_error($conn));
                            }
                    } else {
                        $sql = "INSERT INTO `personal_information`(`LName`, `FName`, `MName`,  
                        `birthdate`, `sex`, `contact_num`) VALUES ('{$name['lastName']}', '{$name['firstName']}',
                         '{$name['middleName']}', '$dateOfBirth',  '$sex', '$phonenum')";
                        $result2 = mysqli_query($conn, $sql);
                
                            if ($result2) {

                             $newID = mysqli_insert_id($conn);

                            $sql4 = "INSERT INTO `checkup`(`Record_ID`, `Date`, `VSChief_Complaint`, `Diagnosis`, `treatment`, `Date_input`, `Family_Serial_num`, `physician`, `philhealthnum`, `Head`) VALUES ('$newID','$dateCheckup','$complaint','$diagnosis','$treatment', '$date', '$serial_num', ' $attend', '$philhealth', '$fp')";
                            $result4 = mysqli_query($conn, $sql4);

                            $sql6 ="INSERT INTO `age_table`(`Record_ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
                            ('$newID', '$age_years', '$age_in_months', '$age')";
                            $result6 = mysqli_query($conn, $sql6);


                            $sql7 ="INSERT INTO `address_information`(`Record_ID`, `Barangay`, `Municipality`, `Province`, `Region`)
                            VALUES ('$newID', '$addr', 'San Jose', 'Camarines Sur', 'Region V')";
                            $result7 = mysqli_query($conn, $sql7);

                            $sql3 = "INSERT INTO `medical_information`(`Record_ID`, `history`, `classification`, `PWD`) VALUES ('$newID','$medhistory', '$classification', '$pwd')";
                            $result3 = mysqli_query($conn, $sql3);

                            if ($result4 && $result3) {
                                header("Location: ../checkup/checkup-all.php?success=data added");
                            } else {
                                header("Location: ../checkup/checkup-all.php?error=Insert query failed: " . mysqli_error($conn));
                            }
    }

}
                    
                }
                $count="1"; // Increment count
            }if ($result) {
                header("Location: ../checkup/checkup-all.php?success=data added successfully");
                exit();
            } else {
                $error_message = mysqli_error($conn); // Get the MySQL error message
                header("Location: ../checkup/checkup-all.php?error=database error: " . urlencode($error_message));
                exit();
            }
        } else {
            header("Location: ../checkup/checkup-all.php?error=invalid file format");
            exit();
        }
    } else {
        header("Location: ../checkup/checkup-all.php?error=missing import parameter");
        exit();
    }
?>
