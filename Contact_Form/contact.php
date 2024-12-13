<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.html');  // Redirect to login page if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate form inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    $errors = [];

    if (empty($name)) $errors[] = "Name is required.";
    if (!$email) $errors[] = "Valid email is required.";
    if (!preg_match('/^[0-9]{10,15}$/', $phone)) $errors[] = "Phone must be 10-15 digits.";
    if (empty($message)) $errors[] = "Message is required.";

    if (!empty($errors)) {
        echo "<h3>Errors:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
        // Process the form (send email or save to database)
        echo "<h3>Message sent successfully!</h3>";
        // Add email sending functionality or other processing here
    }
}
?>
