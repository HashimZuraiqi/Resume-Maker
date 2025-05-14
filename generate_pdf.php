<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$host = 'localhost';
$db = 'resume maker';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch resumes for the logged-in user
$resumes = $conn->query("SELECT id, name FROM resumes WHERE user_id = $user_id");

if ($resumes && $resumes->num_rows > 0) {
    while ($resume = $resumes->fetch_assoc()) {
        // Ensure 'id' and 'name' keys exist in the result
        if (isset($resume['id']) && isset($resume['name'])) {
            echo "<a href='generate_pdf.php?resume_id=" . $resume['id'] . "'>Download " . htmlspecialchars($resume['name']) . "</a><br>";
        } else {
            echo "Invalid resume data.<br>";
        }
    }
} else {
    echo "No resumes found.";
}

$conn->close();
?>