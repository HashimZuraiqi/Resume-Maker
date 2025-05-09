<?php
session_start();

// Check if a session exists before attempting to unset or destroy it
if (session_status() === PHP_SESSION_ACTIVE) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
}

// Redirect to the login page
header("Location: login.html");
exit();
?>