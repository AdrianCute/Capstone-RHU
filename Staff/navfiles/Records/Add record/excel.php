<?php
    include "config.php";
    
    require '../../../../vendor/autoload.php';
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
                    $dateOfVisit = validate($row[0]);
                    $householdNumber = validate($row[1]);
                    $barangay = validate($row[2]);
                    $numberOfFamilies = validate($row[3]);
                    $lastName = validate($row[4]);
                    $firstName = validate($row[5]);
                    $middleName = validate($row[6]);
                    $relationshipToHHHead = validate($row[7]);
                    $dateOfBirth = validate($row[8]);
                    $age = validate($row[9]);
                    $sex = validate($row[10]);
                    $civilStatus = validate($row[11]);
                    $educationalAttainment = validate($row[12]);
                    $religion = validate($row[13]);
                    $ethnicity = validate($row[14]);
                    $fourPsMember = validate($row[15]);
                    $fourPsNumber = validate($row[16]);
                    $philhealthCategory = validate($row[17]);
                    $philhealthNumber = validate($row[18]);
                    $medicalHistory = validate($row[19]);
                    $classificationByAgeHealthRiskGroup = validate($row[20]);
                    $lastMenstrualPeriod = validate($row[21]);
                    $usingAnyFPMethods = validate($row[22]);
                    $fpMethodUsed = validate($row[23]);
                    $fpStatus = validate($row[24]);
                    $water = validate($row[25]);
                    $toilet = validate($row[26]);
                    
                    $age_years = calculateYears($dateOfBirth);
                    $age_in_months = calculateAgeMonths($dateOfBirth);
                    $date = date("Y-m-d"); // Format the date as per your database schema

                    
                    // print_r($row);

                    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
                    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
                    INNER JOIN Address_information ta ON pi.Record_ID = ta.Record_ID
                    WHERE LName='$lastName' AND FName='$firstName' AND MName='$middleName' 
                    AND Age ='$age_years' AND Age__months	 = '$age_in_months' AND Age_in_years_months = '$age' AND Barangay ='$barangay'";
                    $result = mysqli_query($conn, $query);
                    
                
                    if ($row = mysqli_fetch_assoc($result)) {
                        $existingID = $row['Record_ID'];
                       
                        $sql1= "INSERT INTO `profiling`(`Record_ID`, `Visit`,  `fourps`, `fourps_number`, `phil_category`,
                         `phil_number`, `water`, `toilet`, `household_num`, `number_family`, `relationship`, 
                         `Date_input`) VALUES('$existingID','$dateOfVisit','$fourPsMember','$fourPsNumber',
                         '$philhealthCategory','$philhealthNumber','$water', '$toilet','$householdNumber','$numberOfFamilies','$relationshipToHHHead', '$date')";
                          
                          $result1 = mysqli_query($conn, $sql1);
            
            
                          $sql3 ="INSERT INTO `medical_information`(`Record_ID`, `history`, `classification`, 
                          `mentraul`, `UsingFp`, `method_use`, `fp_status`) VALUES ('$existingID','$medicalHistory',
                          '$classification','$lastMenstrualPeriod','$usingAnyFPMethods','$fpMethodUsed','$fpStatus')";
                        
                                
                $sql4 ="INSERT INTO `other_information`(`Record_ID`, `religion`, `education`, `civil_status`, `Ethinicity`) 
                VALUES ('$existingID', '$religion', '$educationalAttainment', '$civilStatus', '$ethnicity')";
                 $result4 = mysqli_query($conn, $sql4);
              $result3 = mysqli_query($conn, $sql3);
              
                        $result3 = mysqli_query($conn, $sql3);
            
                        if($result1 AND $result3){
                            header("Location: ../Profiling/profiling-all.php?success=data added");
                        }else{
                            header("Location: ../Profiling/profiling-all.php?error=error beh dae nag gana");
            
                        }
            
            
                    }
                 else {
            
                    $sql ="INSERT INTO `personal_information`(`LName`, `FName`, `MName`, 
                    `birthdate`, `sex`)
                     VALUES('$lastName','$firstName','$middleName','$dateOfBirth','$sex')";  
                     
                     $result2 = mysqli_query($conn, $sql);
            
                     if($result2){
            
                        $newID = mysqli_insert_id($conn);
            
            
                        $sql4 ="INSERT INTO `other_information`(`Record_ID`, `religion`, `education`, `civil_status`, `Ethinicity`) 
                        VALUES ('$newID', '$religion', '$educationalAttainment', '$civilStatus', '$ethnicity')";
                         $result4 = mysqli_query($conn, $sql4);
            
            
                         $sql6 ="INSERT INTO `age_table`(`Record_ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
                          ('$newID', '$age_years', '$age_in_months', '$age')";
                          $result6 = mysqli_query($conn, $sql6);
            
                          $sql7 ="INSERT INTO `address_information`(`Record_ID`, `Barangay`, `Municipality`, `Province`, `Region`)
                           VALUES 
                          ('$newID', '$barangay', 'San Jose', 'Camarines Sur', 'Region V')";
            
                          $result7 = mysqli_query($conn, $sql7);
             
            
                        $sql1= "INSERT INTO `profiling`(`Record_ID`, `Visit`, `fourps`, `fourps_number`, `phil_category`,
                        `phil_number`, `water`, `toilet`, `household_num`, `number_family`, `relationship`, 
                        `Date_input`) VALUES('$newID','$dateOfVisit','$fourPsMember','$fourPsNumber',
                        '$philhealthCategory','$philhealthNumber','$water', '$toilet','$householdNumber','$numberOfFamilies','$relationshipToHHHead', '$data')";
                         
                         $result1 = mysqli_query($conn, $sql1);
                         
                        $sql3 ="INSERT INTO `medical_information`(`Record_ID`, `history`, `classification`, 
                        `mentraul`, `UsingFp`, `method_use`, `fp_status`) VALUES ('$newID','$medicalHistory',
                        '$classification','$lastMenstrualPeriod','$usingAnyFPMethods','$fpMethodUsed','$fpStatus')";
                    
                        $result3 = mysqli_query($conn, $sql3);
            
                        if($result2 AND $result3){
                            header("Location: ../Profiling/profiling-all.php?success=data added");
                        }else{
                            header("Location: ../Profiling/profiling-all.php?error=error beh dae nag gana");
            
                        }
            
                     }
            
                    
                    }
                }
                $count="1"; // Increment count
            }if ($result) {
                header("Location: ../Profiling/profiling-all.php?success=data added");
                exit();
            } else {
                $error_message = mysqli_error($conn); // Get the MySQL error message
                header("Location: index.php?error=database error: " . urlencode($error_message));
                exit();
            }
        } else {
            header("Location: index.php?error=invalid file format");
            exit();
        }
    } else {
        header("Location: index.php?error=missing import parameter");
        exit();
    }
?>
