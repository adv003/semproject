<?php
session_start();

// Include database configuration
include("config.php");

// Check if the POST request contains log data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve log data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data["level"]) && isset($data["message"])) {
        // Prepare SQL statement to insert log data into the table
        $sql = "INSERT INTO cookieinfo (level, message) VALUES (?, ?)";
        
        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $data["level"], $data["message"]);
        
        // Execute the SQL statement
        if ($stmt->execute() === TRUE) {
            echo "Log inserted successfully";
        } else {
            echo "Error inserting log: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Invalid log data";
    }
} else {
    echo "Only POST requests are allowed";
}

// Close connection
$conn->close();
?>
