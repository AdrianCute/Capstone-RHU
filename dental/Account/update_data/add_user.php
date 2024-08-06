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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $mname = validate($_POST['mname']);
    $username = validate($_POST['uname']);
    $bday = validate($_POST['bday']);
    $address = validate($_POST['address']);
    $age =  calculateAge($bday);
    $age_in_months = calculateAgeMonths($bday);
    $age_years = calculateYears($bday);   
    $number = validate($_POST['number']);
    $raw_password = $_POST['password'];
    $password = password_hash($raw_password, PASSWORD_DEFAULT);
    $re_pass = validate($_POST['confirm']);

    $user_data = 'uname=' . $username . '&name=' . $name;

    $user_data = 'uname=' . $username . '&name=' . $name;

    if (empty($username) || empty($password) || empty($re_pass) || empty($name)) {
        header("Location: ../index.php?error=All fields are required&$user_data");
        exit();
    } elseif (!password_verify($re_pass, $password)) {
        header("Location: ../index.php?error=The confirmation password does not match&$user_data");
        exit();
    }else   if (strlen($raw_password) < 8) {
        header("Location: ../index.php?error=Password must be at least 8 characters");
        exit();
    } else if (!preg_match('/[A-Z]/', $raw_password) || !preg_match('/[0-9]/', $raw_password)) {
        header("Location: ../index.php?error=Password must contain at least one capital letter and one number");
        exit();
    }
    else {

         if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = '../uploaded_img/' . $image;

            // Move the uploaded image to the desired folder
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                // Check if the username already exists
                $sql = "SELECT * FROM `users` WHERE UserName='$username'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    header("Location: ../index.php?error=The username is taken, try another&$user_data");
                    exit();
                } else {

                    $query = "SELECT pi.*, age.*, ta.* FROM personal_information pi
                    INNER JOIN age_table age ON pi.Record_ID = age.Record_ID
                    INNER JOIN Address_information ta ON pi.Record_ID = ta.Record_ID
                    WHERE LName='$lname' AND FName='$name' AND MName='$mname' 
                    AND Age ='$age_years' AND Age__months= '$age_in_months' AND Age_in_years_months = '$age' AND Barangay ='$address'";
                   
                    $result1 = mysqli_query($conn, $query);
                   
                    $result1 = mysqli_query($conn, $query);
                    
                    if ($row = mysqli_fetch_assoc($result1)) {
                    
                    $existing_ID = $row['Record_ID'];
                    $sql2 = "INSERT INTO `users`(`UserName`, `Password`, `userType`, `Status`, `Profile`) 
                        VALUES ('$username', '$password', 'Dental', 'Pending', '$image')";
                    $result2 = mysqli_query($conn, $sql2);

                    if ($result2) {
                        $newUserID = mysqli_insert_id($conn);

                        // Insert user information into the user_information table
                        $sql3 = "INSERT INTO `user_information`(`User_ID`, `Record_ID`, `Person_ID`) VALUES 
                            ('$newUserID', '$existing_ID', '$image')";
                        $result3 = mysqli_query($conn, $sql3);

                        if ($result3) {
                            // Redirect to a success page or perform other actions
                            header("Location: ../users.php?success= Account has been Registered, Please wait to be approve");
                            exit();
                        } else {
                            header("Location: ../users.php?error=Error inserting user information&$user_data");
                            exit();
                        }
                    } else {
                        header("Location: ../users.phpp?error=Error creating user&$user_data");
                        exit();
                    }
                    } else {
                        $sql2 = "INSERT INTO `users`(`UserName`, `Password`, `userType`, `Status`, `Profile`) 
                        VALUES ('$username', '$password', 'Dental', 'Pending', '$image')";
                        $result2 = mysqli_query($conn, $sql2);
                        if($result2){
                            $newUserID = mysqli_insert_id($conn);
    
    
                            $sql ="INSERT INTO `personal_information`( `LName`, `FName`, `MName`, `birthdate`,`contact_num`)
                            VALUES('$lname','$name','$mname','$bday','$number')";  
                            
                            $result3 = mysqli_query($conn, $sql);
                            
                            if ($result3) {
                                $newID = mysqli_insert_id($conn);   
                                  
                           $sql3 = "INSERT INTO `user_information`(`User_ID`, `Record_ID`) VALUES 
                           ('$newUserID', '$newID')";
                           $result3 = mysqli_query($conn, $sql3);       
                           $sql6 ="INSERT INTO `age_table`(`Record_ID`, `Age`, `Age__months`, `Age_in_years_months`) VALUES 
                           ('$newID', '$age_years', '$age_in_months', '$age')";
                           $result6 = mysqli_query($conn, $sql6);
             
                           $sql7 ="INSERT INTO `address_information`(`Record_ID`, `Barangay`, `Municipality`, `Province`, `Region`)
                            VALUES 
                           ('$newID', '$address', 'San Jose', 'Camarines Sur', 'Region V')";
             
                           $result7 = mysqli_query($conn, $sql7);  
                           if ($result3 && $result6 && $result7) {
                            header("Location: ../users.php?success= Account registration success and account status is pending");
                            exit();
    
                        }else{
                            header("Location: ../users.php?error=Error inserting user information&$user_data");
                            exit();
                        }                
                        }else {
                            header("Location: ../users.php?error=Error creating user&$user_data");
                        }
    
    
                         }
    
                    }
                }
            } else {
                header("Location: ../users.php?error=Error uploading image&$user_data");
                exit();
            }
        } else {
            header("Location: ../users.php?error=Image is required&$user_data");
            exit();
        }
    }
} else {
    header("Location: ../users.php");
    exit();
}

// Function to sanitize user input
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
