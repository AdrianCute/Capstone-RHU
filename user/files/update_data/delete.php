<?php
include "config.php";
$id = $_GET["ID"];
$sql = "DELETE FROM `patient_account` WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: ../registration.php?sucess=account rejected");
} else {
  echo "Failed: " . mysqli_error($conn);
}
