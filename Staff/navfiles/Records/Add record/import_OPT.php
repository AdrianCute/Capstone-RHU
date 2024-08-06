<?php
session_start();
    include "config.php";
    
    require '../../../../vendor/autoload.php';

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
    function splitAddress($add) {
        $addresssplit = explode(', ', $add);
    $zone = '';
        $brgy = '';
        $muni = '';
        $pro = '';
    
        if (isset( $addresssplit[0])) {
            $zone =  $addresssplit[0];
        }
        if (isset( $addresssplit[1])) {
            $brgy =  $addresssplit[1];
        }
        if (isset( $addresssplit[2])) {
            $muni =  $addresssplit[2];
        }
    
        if (count( $addresssplit) > 3) {
            $pro = implode(' ', array_slice( $addresssplit, 2));
        }
    
        return array(
            'zone'=> $zone,
            'brgy' => $brgy,
            'muni' => $muni,
            'pro' => $pro
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
                    $date = date("Y-m-d"); 

                   $address = isset($row[0]) ? splitAddress($row[0]) : null;
$mothers_name = isset($row[1]) ? $row[1] : null;
$name = isset($row[2]) ? splitFullName($row[2]) : null;
$IP = isset($row[3]) ? $row[3] : null;
$sex = isset($row[4]) ? $row[4] : null;
$bday = isset($row[5]) ? $row[5] : null;
$date_measured = isset($row[6]) ? $row[6] : null;
$weight = isset($row[7]) ? $row[7] : null;
$height = isset($row[8]) ? $row[8] : null;
$age = isset($row[9]) ? $row[9] : null;
$calculateWeight = isset($row[10]) ? $row[10] : null;
$calculateHeight = isset($row[11]) ? $row[11] : null;
$calculateWeightAndLength = isset($row[12]) ? $row[12] : null;

                    $age_years = calculateYears($bday);
                    $age_years_months = calculateAge($bday);
                    
                    
                 
          $lName = mysqli_real_escape_string($conn, validate($name['lastName'], array(', ', ',')));
$FName = mysqli_real_escape_string($conn, validate($name['firstName'], array(', ', ',')));
$MName = mysqli_real_escape_string($conn, validate($name['middleName'], array(', ', ',')));
$addr = mysqli_real_escape_string($conn, validate($address['brgy'], array(', ', ',')));

                    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
                    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
                    INNER JOIN address_information ta ON pi.Record_ID = ta.Record_ID
                    WHERE  LName='$lName' AND FName='$FName' AND MName='$MName' AND Age ='$age_years'
                     AND Age__months = '$age' AND Age_in_years_months = '$age_years_months'
                    AND Barangay ='$addr'";
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
                header("Location: ../OTP/OTP-all.php?success= OPT data added successfully");
                        } else {
                            header("Location: ../OTP/OTP-all.php?error=Insert query failed: " . mysqli_error($conn));
                        }
                    }
                 else {
                    $sql5 = "INSERT INTO `personal_information`(`LName`, `FName`, `MName`, `birthdate`, `sex`
                    ) VALUES ('$lName', '$FName',
                         '$MName', '$bday', '$sex')";
                    $result2 = mysqli_query($conn, $sql5);
                
                    if (!$result2) {
                        header("Location: ../OTP/OTP-all.php?error=Insert query failed: " . mysqli_error($conn));
                    }
                
                    $newID = mysqli_insert_id($conn);
                
                   
                    $sql = "INSERT INTO `operation_timbang`(`Record_ID`, `MothersName`, `DateMeasured`, 
                    `Weight`, `Height`, 
                    `Weight_in_Age_stat`, `Height_in_Age_stat`, `Weight_in_LTandHt_stat`, `Date_input`, `IP`)
                         VALUES('$newID','$mothers_name','$date_measured','$weight','$height',
                         '$calculateWeight', '$calculateHeight', '$calculateWeightAndLength', '$date', '$IP')";
            
                    $result = mysqli_query($conn, $sql);
            
                    $sql6 ="INSERT INTO `age_table`(`Record_ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
                    ('$newID', '$age_years', '$age', '$age_years_months')";
                    $result6 = mysqli_query($conn, $sql6);
            
                    $sql7 ="INSERT INTO `address_information`(`Record_ID`, `Barangay`, `Municipality`, `Province`, `Region`, `zone`)
                     VALUES 
                    ('$newID', '$addr', 'San Jose', 'Camarines Sur', 'Region V', '{$address['zone']}')";
            
                    $result7 = mysqli_query($conn, $sql7);
            
                
                
                if (!$result && !$result6 && !$result7) {
                    header("Location: ../OTP/OTP-all.php?error=Insert query for immunization_information failed: " . mysqli_error($conn));
                }
                
                header("Location: ../OTP/OTP-all.php?success= OPT data added successfully");
                
            }
                    
                }
                $count="1"; // Increment count
            }if ($result) {
                header("Location: ../OTP/OTP-all.php?success= OPT data added successfully");
                exit();
            } else {
                $error_message = mysqli_error($conn); // Get the MySQL error message
                header("Location: ../OTP/OTP-all.php?error=database error: " . urlencode($error_message));
                exit();
            }
        } else {
            header("Location: ../OTP/OTP-all.php?error=invalid file format");
            exit();
        }
    } else {
        header("Location: ../OTP/OTP-all.php?error=missing import parameter");
        exit();
    }
?>
