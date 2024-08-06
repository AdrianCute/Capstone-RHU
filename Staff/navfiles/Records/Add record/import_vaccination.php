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
                    $category = $row[0];
                    $comorbidity = $row[1];
                    $id = $row[2];
                    $pwd = $row[3];
                    $ip = $row[4];
                    $Lname = $row[5];
                    $Fname = $row[6];
                    $Mname = $row[7];
                    $Suffix = $row[8];
                    $number = $row[9];
                    $guardian = $row[10];
                    $region = $row[11];
                    $province = $row[12];
                    $municipality = $row[13];
                    $barangay = $row[14];
                    $sex = $row[15];
                    $bday = $row[16];
                    $deferral = $row[17];
                    $reason = $row[18];
                    $vaccine_date = $row[19];
                    $batch = $row[20];
                    $lot = $row[21];
                    $bakuna = $row[22];
                    $vaccinator_name = $row[23];
                    $first = $row[24];
                    $second = $row[25];
                    $first_booster = $row[26];
                    $second_booster = $row[27];
                    $adverse = $row[28];
                    $event = $row[29];
                    $row = $row[30];
                    $age =  calculateAge($bday);
                    $age_in_months = calculateAgeMonths($bday);
                    $age_years = calculateYears($bday);
                    $date = date("Y-m-d"); 

                    
                    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
                    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
                    INNER JOIN address_information ta ON pi.Record_ID = ta.Record_ID
                    WHERE LName='$lastName' AND FName='$firstName' AND MName='$middleName' 
                    AND Age ='$age_years' AND Age__months	 = '$age_in_months' AND Age_in_years_months = '$age' AND Barangay ='$barangay'";
                    $result = mysqli_query($conn, $query);
                
                
                        if ($row = mysqli_fetch_assoc($result)) {
                            $existingID = $row['Record_ID'];
                
                            $sql = "INSERT INTO `vaccination`(`Record_ID`, `Category`, `Comorbidity`, `Unique_Person_ID`, `Deferral`, `Reason_for_Deferral`, 
                            `Batch_Number`, `Lot_num`, `Bakuna`, `Adverse_Event`, `Adverse_Condition`, `Row_hash`, `Date_input`) 
                            VALUES('$existingID', '$category', '$comorbidity', '$id', '$deferral', '$reason', '$batch', '$lot', '$bakuna', '$adverse', '$event', '$row', '$date')";
                    
                
                            $result = mysqli_query($conn, $sql);
                
                            $sql1 = "INSERT INTO `vaccine`(`Record_ID`, `Vaccine_Manufacturer`, `Vaccinator`, `Vaccination_Date`, `First_Dose`,
                         `Second_Dose`, `First_Booster`, `Second_Booster`) VALUES ('$existingID', '$bakuna', '$vaccinator_name', '$vaccine_date', '$first', 
                         '$second', '$first_booster', '$second_booster')";
                
                
                            $result1 = mysqli_query($conn, $sql1);
                
                            $sql2 = "INSERT INTO `vaccine_other_information`(`Record_ID`, `Guardian`, `IP`, `PWD`) 
                            VALUES ('$existingID','$guardian', '$ip', '$pwd')";
                            $result2 = mysqli_query($conn, $sql2);
                
                            if ($result && $result1) {
                                header("Location: ../Vaccination/vaccination-all.php?success=data added");
                            } else {
                                die("Insert query failed: " . mysqli_error($conn));
                            }
                
                        }
     else {
        $sql5 = "INSERT INTO `personal_information`(`LName`, `FName`, `MName`, `birthdate`, `sex`, `suffix`, `contact_num`) 
        VALUES ('$Lname', '$Fname', '$Mname', '$bday', '$sex', '$Suffix', '$number')";
        
        $result2 = mysqli_query($conn, $sql5);
    
        if (!$result2) {
        die("Insert query for personal_information failed: " . mysqli_error($conn));
        }
    
        $newID = mysqli_insert_id($conn);

        $sql6 ="INSERT INTO `age_table`(`Record_ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
        ('$newID', '$age_years', '$age_in_months', '$age')";

        $result6 = mysqli_query($conn, $sql6);
        $sql = "INSERT INTO `vaccination`(`Record_ID`, `Category`, `Comorbidity`, `Unique_Person_ID`, `Deferral`, `Reason_for_Deferral`, 
            `Batch_Number`, `Lot_num`, `Bakuna`, `Adverse_Event`, `Adverse_Condition`, `Row_hash`, `Date_input`) 
            VALUES('$newID', '$category', '$comorbidity', '$id', '$deferral', '$reason', '$batch', '$lot', '$bakuna', '$adverse', '$event', '$row', '$date')";
            $result = mysqli_query($conn, $sql);

            $sql7 ="INSERT INTO `address_information`(`Record_ID`, `Barangay`, `Municipality`, `Province`, `Region`)
            VALUES 
           ('$newID', '$barangay', '$municipality', '$province', '$region')";
           $result7 = mysqli_query($conn, $sql7);

            $sql1 = "INSERT INTO `vaccine`(`Record_ID`, `Vaccine_Manufacturer`, `Vaccinator`, `Vaccination_Date`, `First_Dose`,
         `Second_Dose`, `First_Booster`, `Second_Booster`) VALUES ('$newID', '$bakuna', '$vaccinator_name', '$vaccine_date', '$first', 
         '$second', '$first_booster', '$second_booster')";


            $result1 = mysqli_query($conn, $sql1);

            $sql2 = "INSERT INTO `vaccine_other_information`(`Record_ID`, `Guardian`, `IP`, `PWD`) 
            VALUES ('$newID', '$guardian', '$ip', '$pwd')";

   
               $result2 = mysqli_query($conn, $sql2);
    
        if (!$result2) {
        die("Insert query for immunization failed: " . mysqli_error($conn));
    }
    
    header("Location: ../Vaccination/vaccination-all.php?success=data added");
    
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
