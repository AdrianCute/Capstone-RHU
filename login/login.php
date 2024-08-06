<?php
session_start();
include "config.php";
function insertLog($conn, $userId, $username, $action, $success)
{
    date_default_timezone_set("Asia/Manila");
    $timestamp = date("Y-m-d h:i:s a"); // Use 'a' for AM/PM
        $status = $success ? 'Success' : 'Failure';
  // Cast $userId to an integer using intval
    $userId = intval($userId);
    
    $sql = "INSERT INTO logs (User_ID, UserName, action, date) VALUES ('$userId', '$username', '$action', '$timestamp')";
    mysqli_query($conn, $sql);
}

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['uname']);
    $raw_password = validate($_POST['password']); // Make sure to validate the password as well

    if (empty($username)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($raw_password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
        INNER JOIN user_information ui ON u.User_ID = ui.User_ID
        INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
        INNER JOIN address_information ai ON ui.Record_ID = ai.Record_ID

      WHERE u.UserName ='$username' AND u.UserType= 'User' AND Status = 'Approve'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) === 1) {
          $row = mysqli_fetch_assoc($result);
          if (password_verify($raw_password, $row['Password'])) {
           // Start a session if not already started
              $_SESSION['User_ID'] = $row['User_ID'];
              $_SESSION['FName'] = $row['FName'];
              $_SESSION['MName'] = $row['MName'];
              $_SESSION['LName'] = $row['LName'];
              $_SESSION['bday'] = $row['birthdate'];
                $_SESSION['Usertype'] = $row['UserType'];

              $_SESSION['UserName'] = $row['UserName'];
              $_SESSION['Address'] = $row['Barangay'];
              $_SESSION['Contact_num'] = $row['contact_num'];
              $_SESSION['Password'] = $row['Password'];
              $_SESSION['Profile'] = $row['Profile'];
                            insertLog($conn, $row['User_ID'], $username, 'User login', true);

              header("Location: ../user/index.php");
              exit();
            } else {
                                insertLog($conn, null, $username, 'Failed login attempt', false);

                header("Location: ../index.php?error=Incorrect User name or password");
                exit();
            }
        }  $sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
         INNER JOIN user_information ui ON u.User_ID = ui.User_ID
         INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
         INNER JOIN address_information ai ON ui.Record_ID = ai.Record_ID

       WHERE u.UserName ='$username' AND u.UserType= 'Admin'";
       $result = mysqli_query($conn, $sql);

       if (mysqli_num_rows($result) === 1) {
           $row = mysqli_fetch_assoc($result);
           if (password_verify($raw_password, $row['Password'])) {
                // Start a session if not already started
               $_SESSION['User_ID'] = $row['User_ID'];
               $_SESSION['FName'] = $row['FName'];
               $_SESSION['MName'] = $row['MName'];
               $_SESSION['LName'] = $row['LName'];
                $_SESSION['Usertype'] = $row['UserType'];
               $_SESSION['UserName'] = $row['UserName'];
               $_SESSION['Address'] = $row['Barangay'];
               $_SESSION['Contact_num'] = $row['contact_num'];
               $_SESSION['Password'] = $row['Password'];
               $_SESSION['Profile'] = $row['Profile'];
                             insertLog($conn, $row['User_ID'], $username, 'User login', true);

               header("Location: ../admin/index.php");
               exit();
           } else {
                               insertLog($conn, null, $username, 'Failed login attempt', false);

               header("Location: ../index.php?error=Incorrect User name or password");
               exit();
           }
       }  $sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
       INNER JOIN user_information ui ON u.User_ID = ui.User_ID
       INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
       INNER JOIN address_information ai ON ui.Record_ID = ai.Record_ID

     WHERE u.UserName ='$username' AND u.UserType= 'Barangay' AND Status = 'Approve'";
     $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) === 1) {
         $row = mysqli_fetch_assoc($result);
         if (password_verify($raw_password, $row['Password'])) {
 // Start a session if not already started
             $_SESSION['User_ID'] = $row['User_ID'];
             $_SESSION['FName'] = $row['FName'];
             $_SESSION['MName'] = $row['MName'];
             $_SESSION['LName'] = $row['LName'];
                $_SESSION['Usertype'] = $row['UserType'];

             $_SESSION['UserName'] = $row['UserName'];
             $_SESSION['Address'] = $row['Barangay'];
             $_SESSION['Contact_num'] = $row['contact_num'];
             $_SESSION['Password'] = $row['Password'];
             $_SESSION['Profile'] = $row['Profile'];
                           insertLog($conn, $row['User_ID'], $username, 'User login', true);

              header("Location: ../Barangay/index.php");
              exit();
          } else {
                              insertLog($conn, null, $username, 'Failed login attempt', false);

              header("Location: ../index.php?error=Incorrect User name or password");
              exit();
          }
      }  $sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
      INNER JOIN user_information ui ON u.User_ID = ui.User_ID
      INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
      INNER JOIN address_information ai ON ui.Record_ID = ai.Record_ID

    WHERE u.UserName ='$username' AND u.UserType= 'Dental' AND Status = 'Approve'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($raw_password, $row['Password'])) {
             // Start a session if not already started
            $_SESSION['User_ID'] = $row['User_ID'];
            $_SESSION['FName'] = $row['FName'];
            $_SESSION['MName'] = $row['MName'];
            $_SESSION['LName'] = $row['LName'];
                            $_SESSION['Usertype'] = $row['UserType'];

            $_SESSION['UserName'] = $row['UserName'];
            $_SESSION['Address'] = $row['Barangay'];
            $_SESSION['Contact_num'] = $row['contact_num'];
            $_SESSION['Password'] = $row['Password'];
            $_SESSION['Profile'] = $row['Profile'];
                          insertLog($conn, $row['User_ID'], $username, 'User login', true);

             header("Location: ../dental/index.php");
             exit();
         } else {
                             insertLog($conn, null, $username, 'Failed login attempt', false);

             header("Location: ../index.php?error=Incorrect User name or password");
             exit();
         }
     } $sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
       INNER JOIN user_information ui ON u.User_ID = ui.User_ID
       INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
       INNER JOIN address_information ai ON ui.Record_ID = ai.Record_ID

     WHERE u.UserName ='$username' AND u.UserType= 'Staff' AND Status = 'Approve'";
     $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) === 1) {
         $row = mysqli_fetch_assoc($result);
         if (password_verify($raw_password, $row['Password'])) {
              // Start a session if not already started
             $_SESSION['User_ID'] = $row['User_ID'];
             $_SESSION['FName'] = $row['FName'];
             $_SESSION['MName'] = $row['MName'];
             $_SESSION['LName'] = $row['LName'];
             $_SESSION['UserName'] = $row['UserName'];
             $_SESSION['Address'] = $row['Barangay'];
             $_SESSION['Contact_num'] = $row['contact_num'];
             $_SESSION['Password'] = $row['Password'];
                             $_SESSION['Usertype'] = $row['UserType'];

             $_SESSION['Profile'] = $row['Profile'];
                           insertLog($conn, $row['User_ID'], $username, 'User login', true);

              header("Location: ../Staff/index.php");
              exit();
          } else {
                              insertLog($conn, null, $username, 'Failed login attempt', false);

              header("Location: ../index.php?error=Incorrect User name or password");
              exit();
          }
      }   $sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
      INNER JOIN user_information ui ON u.User_ID = ui.User_ID
      INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
      INNER JOIN address_information ai ON ui.Record_ID = ai.Record_ID

    WHERE u.UserName ='$username' AND u.UserType= 'User' AND u.Status='Pending'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($raw_password, $row['Password'])) {
             // Start a session if not already started
            $_SESSION['User_ID'] = $row['User_ID'];
            $_SESSION['FName'] = $row['FName'];
            $_SESSION['MName'] = $row['MName'];
            $_SESSION['LName'] = $row['LName'];
            $_SESSION['bday'] = $row['birthdate'];

            $_SESSION['UserName'] = $row['UserName'];
            $_SESSION['Address'] = $row['Barangay'];
            $_SESSION['Contact_num'] = $row['contact_num'];
            $_SESSION['Password'] = $row['Password'];
            $_SESSION['Profile'] = $row['Profile'];
            header("Location: ../index.php?error=Your Account is not Approve yet, Pls Wait for the confirmation!");
            exit();
          } else {
                              insertLog($conn, null, $username, 'Failed login attempt', false);

              header("Location: ../index.php?error=Incorrect User name or password");
              exit();
          }
      } $sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
      INNER JOIN user_information ui ON u.User_ID = ui.User_ID
      INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
      INNER JOIN address_information ai ON ui.Record_ID = ai.Record_ID

    WHERE u.UserName ='$username' AND u.UserType= 'Barangay' AND Status = 'Pending'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($raw_password, $row['Password'])) {
             // Start a session if not already started
            $_SESSION['User_ID'] = $row['User_ID'];
            $_SESSION['FName'] = $row['FName'];
            $_SESSION['MName'] = $row['MName'];
            $_SESSION['LName'] = $row['LName'];

            $_SESSION['UserName'] = $row['UserName'];
            $_SESSION['Address'] = $row['Barangay'];
            $_SESSION['Contact_num'] = $row['contact_num'];
            $_SESSION['Password'] = $row['Password'];
            $_SESSION['Profile'] = $row['Profile'];
            header("Location: ../index.php?error=Your Account is not Approve yet, Pls Wait for the confirmation!");
             exit();
         } else {
                             insertLog($conn, null, $username, 'Failed login attempt', false);

             header("Location: ../index.php?error=Incorrect User name or password");
             exit();
         }
     }$sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
     INNER JOIN user_information ui ON u.User_ID = ui.User_ID
     INNER JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
     INNER JOIN address_information ai ON ui.Record_ID = ai.Record_ID

   WHERE u.UserName ='$username' AND u.UserType= 'Dental' AND Status = 'Pending'";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) === 1) {
       $row = mysqli_fetch_assoc($result);
       if (password_verify($raw_password, $row['Password'])) {
          // Start a session if not already started
           $_SESSION['User_ID'] = $row['User_ID'];
           $_SESSION['FName'] = $row['FName'];
           $_SESSION['MName'] = $row['MName'];
           $_SESSION['LName'] = $row['LName'];
           $_SESSION['UserName'] = $row['UserName'];
           $_SESSION['Address'] = $row['Barangay'];
           $_SESSION['Contact_num'] = $row['contact_num'];
           $_SESSION['Password'] = $row['Password'];
           $_SESSION['Profile'] = $row['Profile'];
           header("Location: ../index.php?error=Your Account is not Approve yet, Pls Wait for the confirmation!");
           exit();
        } else {
                            insertLog($conn, null, $username, 'Failed login attempt', false);

            header("Location: ../index.php?error=Incorrect User name or password");
            exit();
        }
    }
                    insertLog($conn, null, $username, 'Failed login attempt', false);

        header("Location: ../index.php?error=Incorrect User name or password");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
