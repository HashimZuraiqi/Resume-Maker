<?php
session_start();
    
$host = 'localhost';
$db = 'resume maker'; // Ensure this matches your database name
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ✅ Get user id, username, and password hash
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // ✅ Verify password
        if (password_verify($password, $hashedPassword)) {
            // ✅ Set correct session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username']; // ✅ This was missing!

            header("Location: dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>
