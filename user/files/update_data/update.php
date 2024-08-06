<?php

include "config.php";
    $id = $_GET["ID"];
        $sql = "UPDATE `patient_account` SET Status='Approve' WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../registration.php?success=Data updated successfully");
            exit();
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
        exit
?>
