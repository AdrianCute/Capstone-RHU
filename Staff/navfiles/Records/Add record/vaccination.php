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

if (isset($_POST['category']) && isset($_POST['id']) && isset($_POST['fname']) && isset($_POST['barangay'])) {

    $date = date("Y-m-d"); // Format the date as per your database schema

    $category = validate($_POST['category']);
    $comorbidity = validate($_POST['comorbidity']);
    $id = validate($_POST['id']);
    $pwd = validate($_POST['pwd']);
    $ip = validate($_POST['ip']);
    $Lname = validate($_POST['lname']);
    $Fname = validate($_POST['fname']);
    $Mname = validate($_POST['mname']);
    $Suffix = validate($_POST['suffix']);
    $number = validate($_POST['number']);
    $guardian = validate($_POST['guardian']);
    $region = validate($_POST['region']);
    $province = validate($_POST['province']);
    $municipality = validate($_POST['municipality']);
    $barangay = validate($_POST['barangay']);
    $sex = validate($_POST['sex']);
    $bday = validate($_POST['bday']);
    $deferral = validate($_POST['deferral']);
    $reason = validate($_POST['reason']);
    $vaccine_date = validate($_POST['vaccine_date']);
    $batch = validate($_POST['batch']);
    $lot = validate($_POST['lot']);
    $bakuna = validate($_POST['bakuna']);
    $vaccinator_name = validate($_POST['vaccinator']);
    $first = validate($_POST['first']);
    $second = validate($_POST['second']);
    $first_booster = validate($_POST['first_booster']);
    $second_booster = validate($_POST['second_booster']);
    $adverse = validate($_POST['adverse']);
    $event = validate($_POST['event']);
    $row = validate($_POST['row']);
    $age =  calculateAge($bday);
    $age_in_months = calculateAgeMonths($bday);
    $age_years = calculateYears($bday);

    // Use prepared statement to prevent SQL injection
    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
    INNER JOIN Address_information ta ON pi.Record_ID = ta.Record_ID
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
} else {
    header("Location: ../Vaccination/vaccination-all.php");
    exit();
}
?>
