<?php
session_start();

// Check if the user is logged in
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

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $skills = htmlspecialchars($_POST['skills']);
    $experience = htmlspecialchars($_POST['experience']);
    $education = htmlspecialchars($_POST['education']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($skills) || empty($experience) || empty($education)) {
        $error = "All fields are required.";
    } else {
        // Insert into the database
        $stmt = $conn->prepare("INSERT INTO resumes (user_id, name, email, phone, address, skills, experience, education) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $user_id, $name, $email, $phone, $address, $skills, $experience, $education);

        if ($stmt->execute()) {
            $success = "Resume created successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Create Resume</title>
</head>
<body class="dashboard-page">
    <header class="dashboard-header">
        <h1>Create Your Resume</h1>
    </header>
    <main class="dashboard-main">
        <div class="container">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            <form action="create_resume.php" method="post" class="form-container">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" placeholder="John Doe" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="example@gmail.com" required>

                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" placeholder="123-456-7890" required>

                <label for="address">Address</label>
                <input type="text" name="address" id="address" placeholder="123 Main St, City, Country" required>

                <label for="skills">Skills</label>
                <textarea name="skills" id="skills" placeholder="List your skills here..." required></textarea>

                <label for="experience">Experience</label>
                <textarea name="experience" id="experience" placeholder="Describe your work experience..." required></textarea>

                <label for="education">Education</label>
                <textarea name="education" id="education" placeholder="Describe your education..." required></textarea>

                <button type="submit">Save Resume</button>
            </form>
        </div>
    </main>
</body>
</html>