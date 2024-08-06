<?php

include "config.php";

if (isset($_POST['approvedata'])) {
    $id = $_POST['delete_id'];

    // Update the user's status to 'Deleted' in the database
    $sql = "UPDATE `users` SET Status='Deleted' WHERE User_ID = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch the user type
        $sq1 = "SELECT UserType FROM users WHERE User_ID = '$id'";
        $result1 = mysqli_query($conn, $sq1);

        if ($row = mysqli_fetch_assoc($result1)) {
            $userType = $row['UserType'];

            // Redirect based on user type
            if ($userType === 'User') {
                header("Location: ../users.php?success=Account Deleted Successfully");
            } elseif ($userType === 'Dental') {
                header("Location: ../Dental-Accounts.php?success=Account Deleted Successfully");
            } elseif ($userType === 'Staff') {
                header("Location: ../Staff.php?success=Account Deleted Successfully");
            } elseif ($userType === 'Barangay') {
                header("Location: ../Barangay-accounts.php?success=Account Deleted Successfully");
            }
        } else {
            // Handle the case where fetching user type fails
            header("Location: ../users.php?error=Failed to fetch user type");
        }
    } else {
        // Handle the case where the update query fails
        header("Location: ../users.php?error=Failed to delete account");
    }
}
?>
