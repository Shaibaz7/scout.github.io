<?php
// Database connection
$connection = new mysqli("localhost", "root", "", "form");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Initialize messages
$errorMessage = "";
$successMessage = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = $connection->real_escape_string(trim($_POST["name"]));
    $email = $connection->real_escape_string(trim($_POST["email"]));
    $subject = $connection->real_escape_string(trim($_POST["subject"]));
    $message = $connection->real_escape_string(trim($_POST["message"]));

    // Validate data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $errorMessage = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    } else {
        // Prepare and execute SQL query
        $stmt = $connection->prepare("INSERT INTO messageform (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $successMessage = "Message sent successfully.";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Close the database connection
$connection->close();

// Display messages (if any)
if ($successMessage) {
    echo "<p>$successMessage</p>";
} elseif ($errorMessage) {
    echo "<p>$errorMessage</p>";
}
?>
