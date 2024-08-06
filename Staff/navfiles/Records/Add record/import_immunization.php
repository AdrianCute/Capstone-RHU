<?php
    include "config.php";
    
    require '../../../../vendor/autoload.php';
    function splitFullName($fullName) {
        $nameParts = explode(' ', $fullName);
    
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
        $addresssplit = explode(' ', $add);
    
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
    
    }    
    
    function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                    $name = splitFullName($row[0]);
                    $dateOfBirth = $row[1];
                    $place = $row[2];
                    $address = splitAddress($row[3]);
                    $fathers_name = $row[4];
                    $mothers_name = $row[5];
                    $weight = $row[6];
                    $height = $row[7];
                    $sex = $row[8];
                    $health = $row[9];
                    $barangay = $row[10];
                    $number = $row[11];
                    $at_birth = $row[12];
                    $first = $row[13];
                    $second = $row[14];
                    $third = $row[15];
                    $fourth = $row[16];
                    $fifth = $row[17];
                    $eye = $row[18];
                    $vitamin = $row[19] ;
                    $feed =  $row[20];
                    $nb = $row[21];
                    $hearing = $row[22];
                    $age =  calculateAge($dateOfBirth);
                    $age_in_months = calculateAgeMonths($dateOfBirth);
                    $age_years = calculateYears($dateOfBirth);
                    
                    
                    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
                    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
                    INNER JOIN Address_information ta ON pi.Record_ID = ta.Record_ID
                    WHERE  LName='{$name['lastName']}' AND FName='{$name['firstName']}'
                    AND Age ='$age_years' AND Age__months	 = '$age_in_months' AND Age_in_years_months = '$age' AND Barangay ='$address'";
                    
                    
                    $result = mysqli_query($conn, $query);
                     
                     
                             if ($row = mysqli_fetch_assoc($result)) {
                                 $existingID = $row['Record_ID'];
                     
                                 $sql = "INSERT INTO `immunization`(`atbirth`, `firstDose`, `secondDose`, `thirdDose`, 
                                     `fourthDose`, `fifthDose`, `Record_ID`, `Date_input`)
                                      VALUES('$at_birth','$first','$second','$third','$fourth','$fifth','$existingID', '$date')";
                     
                                 $result = mysqli_query($conn, $sql);
                     
                                 $sql1 = "INSERT INTO `immunization_information`(`Record_ID`, `PlaceOfBirth`, `FathersName`, `MothersName`,
                                       `Familynum`, `birth_height`, `birth_weight`, `health_center`)
                                       VALUES('$existingID','$place','$fathers_name','$mothers_name','$number','$height','$weight', '$health')";
                     
                                 $result1 = mysqli_query($conn, $sql1);
                     
            $sql9 = "INSERT INTO `baby_information`(`Record_ID`, `eye_prophy`, `vitamin_K`, `breest_feed`, `nb_screening`, `nb_hscreening`)
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
                             ) VALUES ('{$name['lastName']}', '{$name['firstName']}',
                                  '{$name['middleName']}',  '$dateOfBirth','$sex')";
                             $result2 = mysqli_query($conn, $sql5);
                         
                             if (!$result2) {
                             die("Insert query for personal_information failed: " . mysqli_error($conn));
                             }
                         
                                   $newID = mysqli_insert_id($conn);

                                   $sql6 ="INSERT INTO `age_table`(`Record_ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
                                   ('$newID', '$age_years', '$age_in_months', '$age')";
                                   $result6 = mysqli_query($conn, $sql6);

                                   $sql7 ="INSERT INTO `address_information`(`Record_ID`, `Barangay`, `Municipality`, `Province`, `Region`)
                                    VALUES 
                                   ('$newID', '{$address['brgy']}', '{$address['muni']}', '{$address['pro']}', 'Region V')";

                                   $result7 = mysqli_query($conn, $sql7);

                                   $sql4 = "INSERT INTO `immunization`(`atbirth`, `firstDose`, `secondDose`, `thirdDose`, 
                                   `fourthDose`, `fifthDose`, `Record_ID`, `Date_input`)
                                    VALUES('$at_birth','$first','$second','$third','$fourth','$fifth','$newID', '$date')";
                                   $result4 = mysqli_query($conn, $sql4);

                                   if (!$result4) {
                                   die("Insert query for immunization failed: " . mysqli_error($conn));
                               }

                               $sql1 = "INSERT INTO `immunization_information`(`Record_ID`, `PlaceOfBirth`, `FathersName`, `MothersName`,
                                   `Familynum`, `birth_height`, `birth_weight`, `health_center`)
                                   VALUES('$newID','$place','$fathers_name','$mothers_name','$number','$height','$weight', '$health')";

                               $result1 = mysqli_query($conn, $sql1);
                               $sql9 = "INSERT INTO `baby_information`(`Record_ID`, `eye_prophy`, `vitamin_K`, `breest_feed`, `nb_screening`, `nb_hscreening`)
                               VALUES('$newID', '$eye', '$vitamin', '$feed', '$nb', '$hearing' )";
                               $result9 = mysqli_query($conn, $sql9);

                               if (!$result1) {
                                   die("Insert query for immunization_information failed: " . mysqli_error($conn));
                               }

                               header("Location: ../Immunization/Immunization-all.php?success=data added");

                            }
                }
                $count="1"; // Increment count
            }if ($result) {
                header("Location: ../Immunization/Immunization-all.php?success=data added");
                exit();
            } else {
                $error_message = mysqli_error($conn); // Get the MySQL error message
                header("Location: ../Immunization/Immunization-all.php?error=database error: " . urlencode($error_message));
                exit();
            }
        } else {
            header("Location: ../Immunization/Immunization-all.php?error=invalid file format");
            exit();
        }
    } else {
        header("Location: ../Immunization/Immunization-all.php?error=missing import parameter");
        exit();
    }
?>
