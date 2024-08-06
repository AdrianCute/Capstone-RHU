<?php
session_start();
include "config.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

    return $result;
}

if(isset($_POST['updatedata'])) {   
    $update_id = $_POST['update_id'];

    // Personal Information
 $Lname = isset($_POST['lname']) ? validate($_POST['lname']) : null;
$Fname = isset($_POST['fname']) ? validate($_POST['fname']) : null;
$Mname = isset($_POST['mname']) ? validate($_POST['mname']) : null;
$Address = isset($_POST['barangay']) ? validate($_POST['barangay']) : null;
$dateOfBirth = isset($_POST['bday']) ? validate($_POST['bday']) : null;
$Age = isset($_POST['age']) ? validate($_POST['age']) : null;
$sex = isset($_POST['sex']) ? validate($_POST['sex']) : null;
$PWD = isset($_POST['pwd']) ? validate($_POST['pwd']) : null;
$contact_num = isset($_POST['number']) ? validate($_POST['number']) : null;
$suffix = isset($_POST['suffix']) ? validate($_POST['suffix']) : null;

    $age =  calculateAge($dateOfBirth);
    $age_in_months = calculateAgeMonths($dateOfBirth);
    $age_years = calculateYears($dateOfBirth);
    

    $sql1 = "UPDATE `personal_information` SET 
        `LName`='$Lname',
        `FName`='$Fname',
        `MName`='$Mname',
        `birthdate`='$dateOfBirth',
        `sex`='$sex',
        `contact_num`='$contact_num',
        `suffix`='$suffix'
        WHERE `Record_ID` = '$update_id'";


    $result1 = mysqli_query($conn, $sql1);
    
    $sql6 = "UPDATE `age_table` SET`Age`='$age_years',`Age__months`='$age_in_months',
    `Age_in_years_months`='$age' WHERE Record_ID = '$update_id'";
      $result6 = mysqli_query($conn, $sql6);
$category = isset($_POST['category']) ? validate($_POST['category']) : null;
$comorbidity = isset($_POST['comorbidity']) ? validate($_POST['comorbidity']) : null;
$Unique_Person_ID = isset($_POST['id']) ? validate($_POST['id']) : null;
$Deferral = isset($_POST['deferral']) ? validate($_POST['deferral']) : null;
$Reason_for_Deferral = isset($_POST['reason']) ? validate($_POST['reason']) : null;
$Batch_Number = isset($_POST['batch']) ? validate($_POST['batch']) : null;
$Lot_num = isset($_POST['lot']) ? validate($_POST['lot']) : null;
$Bakuna = isset($_POST['bakuna']) ? validate($_POST['bakuna']) : null;
$Adverse_Event = isset($_POST['adverse']) ? validate($_POST['adverse']) : null;
$Adverse_Condition = isset($_POST['event']) ? validate($_POST['event']) : null;
$Row_hash = isset($_POST['row']) ? validate($_POST['row']) : null;


    $sql2 = "UPDATE `vaccination` SET 
        `Category`='$category',
        `Comorbidity`='$comorbidity',
        `Unique_Person_ID`='$Unique_Person_ID',
        `Deferral`='$Deferral',
        `Reason_for_Deferral`='$Reason_for_Deferral',
        `Batch_Number`='$Batch_Number',
        `Lot_num`='$Lot_num',
        `Bakuna`='$Bakuna',
        `Adverse_Event`='$Adverse_Event',
        `Adverse_Condition`='$Adverse_Condition',
        `Row_hash`='$Row_hash'
        WHERE `Record_ID` = '$update_id'";

    $result2 = mysqli_query($conn, $sql2);

    // Vaccine Information
  $Vaccine_Manufacturer = isset($_POST['vaccine_manufacturer']) ? validate($_POST['vaccine_manufacturer']) : null;
$Vaccinator = isset($_POST['vaccinator']) ? validate($_POST['vaccinator']) : null;
$Vaccination_Date = isset($_POST['vaccine_date']) ? validate($_POST['vaccine_date']) : null;
$First_Dose = isset($_POST['first']) ? validate($_POST['first']) : null;
$Second_Dose = isset($_POST['second']) ? validate($_POST['second']) : null;
$First_Booster = isset($_POST['first_booster']) ? validate($_POST['first_booster']) : null;
$Second_Booster = isset($_POST['second_booster']) ? validate($_POST['second_booster']) : null;


    $sql3 = "UPDATE `vaccine` SET 
        `Vaccine_Manufacturer`='$Vaccine_Manufacturer',
        `Vaccinator`='$Vaccinator',
        `Vaccination_Date`='$Vaccination_Date',
        `First_Dose`='$First_Dose',
        `Second_Dose`='$Second_Dose',
        `First_Booster`='$First_Booster',
        `Second_Booster`='$Second_Booster'
        WHERE `Record_ID` ='$update_id'";

    $result3 = mysqli_query($conn, $sql3);

    // Vaccine Other Information
   $Guardian = isset($_POST['guardian']) ? validate($_POST['guardian']) : null;
$Region = isset($_POST['region']) ? validate($_POST['region']) : null;
$Province = isset($_POST['province']) ? validate($_POST['province']) : null;
$Municipality = isset($_POST['municipality']) ? validate($_POST['municipality']) : null;
$IP = isset($_POST['ip']) ? validate($_POST['ip']) : null;

    $sql4 = "UPDATE `vaccine_other_information` SET 
        `Guardian`='$Guardian',
        `IP`='$IP',
        `PWD` = '$PWD'
        WHERE `Record_ID` = '$update_id'";

    $result4 = mysqli_query($conn, $sql4);

    $sql5 = "UPDATE `address_information` SET 
    `Barangay`='$Address',
    `Region`='$Region',
    `Province`='$Province',
    `Municipality`='$Municipality' 
    WHERE `Record_ID` = '$update_id'";
    $result5 = mysqli_query($conn, $sql5);

    if($result1 && $result2 && $result3 && $result4 && $result5 && $result6){
        header("Location: ../Vaccination/vaccination-all.php? success= update data succcessfully ");
    }else{
        header("Location: ../vacination/vaccination-all.php? error=Error nanaman pota ");
    }
}  
?>