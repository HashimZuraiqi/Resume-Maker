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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $resume_id = $_POST['resume_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];

    $stmt = $conn->prepare("UPDATE resumes SET name = ?, email = ?, phone = ?, address = ?, skills = ?, experience = ?, education = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $name, $email, $phone, $address, $skills, $experience, $education, $resume_id);

    if ($stmt->execute()) {
        echo "Resume updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>