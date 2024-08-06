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

if (isset($_POST['address']) && isset($_POST['hhnum']) && isset($_POST['lname']) && isset($_POST['fname'])) {

    $date = date("Y-m-d"); 
    $dateOfVisit = validate($_POST['visit']);
    $householdNumber = validate($_POST['hhnum']);
    $barangay = validate($_POST['address']);
    $numberOfFamilies = validate($_POST['number_fam']);
    $firstName = validate($_POST['fname']);
    $lastName = validate($_POST['lname']);
    $middleName = validate($_POST['mname']);
    $relationshipToHHHead = validate($_POST['relationship']);
    $dateOfBirth = validate($_POST['birthday']);
    $sex = validate($_POST['sex']);
    $civilStatus = validate($_POST['civil_status']);
    $educationalAttainment = validate($_POST['educ']);
    $religion = validate($_POST['religion']);
    $ethnicity = validate($_POST['ethnicity']);
    $fourPsMember = validate($_POST['4ps_Member']);
    $fourPsNumber = validate($_POST['fourps_num']);
    $philhealthCategory = validate($_POST['phil_category']);
    $philhealthNumber = validate($_POST['phil_num']);
    $medicalHistory = validate($_POST['history']);
    $classificationByAgeHealthRiskGroup = validate($_POST['classfication']);
    $lastMenstrualPeriod = validate($_POST['menstrual']);
    $usingAnyFPMethods = validate($_POST['fp_methods']);
    $fpMethodUsed = validate($_POST['method']);
    $fpStatus = validate($_POST['fp_status']);
    $water = validate($_POST['water']);
    $toilet = validate($_POST['toilet']);
    $age =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);
    
    // Create a prepared statement
    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
    INNER JOIN Address_information ta ON pi.Record_ID = ta.Record_ID
    WHERE LName='$lastName' AND FName='$firstName' AND MName='$middleName' 
    AND Age ='$age_years' AND Age__months	 = '$age_in_months' AND Age_in_years_months = '$age' AND Barangay ='$barangay'";
    $result = mysqli_query($conn, $query);
    

        if ($row = mysqli_fetch_assoc($result)) {
            $existingID = $row['Record_ID'];
           
            $sql1= "INSERT INTO `profiling`(`Record_ID`, `Visit`, `fourps`, `fourps_number`, `phil_category`,
             `phil_number`, `water`, `toilet`, `household_num`, `number_family`, `relationship`, 
             `Date_input`) VALUES('$existingID','$dateOfVisit', '$fourPsMember','$fourPsNumber',
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
                header("Location: ../Profiling/profiling-all.php?success=Profiling data has successfully added");
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
            '$philhealthCategory','$philhealthNumber','$water', '$toilet','$householdNumber','$numberOfFamilies','$relationshipToHHHead', '$date')";
             
             $result1 = mysqli_query($conn, $sql1);
             
            $sql3 ="INSERT INTO `medical_information`(`Record_ID`, `history`, `classification`, 
            `mentraul`, `UsingFp`, `method_use`, `fp_status`) VALUES ('$newID','$medicalHistory',
            '$classification','$lastMenstrualPeriod','$usingAnyFPMethods','$fpMethodUsed','$fpStatus')";
        
            $result3 = mysqli_query($conn, $sql3);

            if($result2 AND $result3){
                header("Location: ../Profiling/profiling-all.php?success=Profiling data has successfully added");
            }else{
                header("Location: ../Profiling/profiling-all.php?error=error beh dae nag gana");

            }

         }

        
        }
    

} else {
    header("Location: index.php");
    exit();
}
?>
