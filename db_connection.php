<?php
// db_connection.php

// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food_science_hub');

// Attempt to connect to MySQL database
try {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Set charset to ensure proper encoding of special characters
    if (!$conn->set_charset("utf8mb4")) {
        throw new Exception("Error setting charset: " . $conn->error);
    }

} catch(Exception $e) {
    // Log the error and display a user-friendly message
    error_log("Database connection error: " . $e->getMessage());
    die("Oops! Something went wrong. Please try again later.");
}

// Function to safely escape user inputs
function escape_input($conn, $input) {
    if (is_array($input)) {
        return array_map(function($item) use ($conn) {
            return escape_input($conn, $item);
        }, $input);
    }
    return $conn->real_escape_string($input);
}

// Function to close database connection
function close_connection($conn) {
    $conn->close();
}
?>