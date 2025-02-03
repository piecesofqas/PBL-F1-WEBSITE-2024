<?php
// Database connection parameters
$host = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$database = "dream_routine"; // Replace with your database name

// Establish connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$feedback = isset($_POST['feedback']) ? trim($_POST['feedback']) : '';

// Validate input
if (empty($name) || empty($email) || empty($feedback)) {
    die("All fields are required. Please fill out the form completely.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO feedback (name, email, feedback) VALUES (?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sss", $name, $email, $feedback);

// Execute the query
if ($stmt->execute()) {
    echo "Thank you, your feedback has been submitted!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();

var_dump($name, $email, $feedback);
?>
