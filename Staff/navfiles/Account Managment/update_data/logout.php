<?php  

include "config.php";
function insertLog($conn, $userId, $username, $action, $success)
{
    date_default_timezone_set("Asia/Manila");

    $timestamp = date("Y-m-d h:i:s a"); // Use 'a' for AM/PM 
        $status = $success ? 'Success' : 'Failure';

    $sql = "INSERT INTO logs (user_id, username, action, date) VALUES ('$userId', '$username', '$action', '$timestamp')";
    mysqli_query($conn, $sql);
}

// Get user information from the session
$userId = isset($_SESSION['User_ID']) ? $_SESSION['User_ID'] : null;
$username = isset($_SESSION['UserName']) ? $_SESSION['UserName'] : null;

// Insert log data for logout
insertLog($conn, $userId, $username, 'User logout', true);

session_unset();
session_destroy();

header("Location: ../../../../index.php");
exit;