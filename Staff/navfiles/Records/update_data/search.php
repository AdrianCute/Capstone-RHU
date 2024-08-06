<?php
include "config.php";

// Check the connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $suggestions = [];

    // Check if the query contains numeric characters
if (preg_match('/-/', $query)) {        // If the query contains numeric characters, assume it's a family number
        // If the query contains numeric characters, assume it's a family number
        $sql = "SELECT Familynum FROM immunization_information WHERE Familynum LIKE ?";
    } else {
        // If the query doesn't contain numeric characters, assume it's a name
        $sql = "SELECT LName, FName, MName FROM personal_information 
                WHERE CONCAT(LName, FName, MName) LIKE ?";
    }

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameter
        $param = "%$query%";
        $stmt->bind_param("s", $param);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch results into an array
        while ($row = $result->fetch_assoc()) {
            // If it's a family number query, include the family number in suggestions
            if (isset($row['Familynum'])) {
                $suggestions[] = ['familyNumber' => $row['Familynum']];
            } else {
                // If it's a name query, construct the full name from individual columns
                $fullName = $row['LName'] . '' . $row['FName'] . '' . $row['MName'];
                $suggestions[] = ['fullName' => $fullName];
            }
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();

    echo json_encode($suggestions);
}
?>
