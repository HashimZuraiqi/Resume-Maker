<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
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
$resume = null;
$user_id = $_SESSION['user_id'];

// Handle form submission for updating resume
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['resume_id'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $skills = trim($_POST['skills']);
    $experience = trim($_POST['experience']);
    $education = trim($_POST['education']);
    $resume_id = intval($_POST['resume_id']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($skills) || empty($experience) || empty($education)) {
        $error = "All fields are required.";
    } else {
        // Update resume data in the database
        $stmt = $conn->prepare("UPDATE resumes SET name=?, email=?, phone=?, address=?, skills=?, experience=?, education=? WHERE resume_id=? AND user_id=?");
        $stmt->bind_param("sssssssii", $name, $email, $phone, $address, $skills, $experience, $education, $resume_id, $user_id);

        if ($stmt->execute()) {
            $success = "Resume updated successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// If resume_id is set, fetch that resume for editing
if (isset($_GET['resume_id'])) {
    $resume_id = intval($_GET['resume_id']);
    $stmt = $conn->prepare("SELECT * FROM resumes WHERE resume_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $resume_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $resume = $result->fetch_assoc();
    } else {
        $error = "No resume found or you do not have permission to edit this resume.";
    }
    $stmt->close();
}

// If no resume_id, fetch all resumes for this user
$resume_list = [];
if (!isset($_GET['resume_id'])) {
    $stmt = $conn->prepare("SELECT resume_id, name, email FROM resumes WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $resume_list[] = $row;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Edit Resume</title>
    <style>
        .form-container {
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container input, .form-container textarea, .form-container button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .form-container button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .resume-list-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .resume-list-table th, .resume-list-table td {
            padding: 10px;
            text-align: left;
        }
        .resume-list-table th {
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="form-container">
                    <h3>Edit Resume</h3>

                    <!-- Display success or error messages -->
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                    <?php endif; ?>

                    <?php if (!isset($_GET['resume_id'])): ?>
                        <h5>Your Resumes</h5>
                        <?php if (count($resume_list) > 0): ?>
                            <table class="resume-list-table table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Edit</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resume_list as $r): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($r['name']); ?></td>
                                            <td><?php echo htmlspecialchars($r['email']); ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="edit_resume.php?resume_id=<?php echo urlencode($r['resume_id']); ?>">Edit</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="download_resume.php?resume_id=<?php echo urlencode($r['resume_id']); ?>">Download</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>You have not created any resumes yet. <a href="create_resume.php">Create a new resume</a>.</p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($resume): ?>
                        <!-- Display resume edit form -->
                        <form method="POST" action="edit_resume.php?resume_id=<?php echo urlencode($resume['resume_id']); ?>">
                            <input type="hidden" name="resume_id" value="<?php echo htmlspecialchars($resume['resume_id']); ?>">

                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($resume['name']); ?>" required>

                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($resume['email']); ?>" required>

                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo htmlspecialchars($resume['phone']); ?>" required>

                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($resume['address']); ?>" required>

                            <label for="skills">Skills</label>
                            <textarea name="skills" id="skills" required><?php echo htmlspecialchars($resume['skills']); ?></textarea>

                            <label for="experience">Experience</label>
                            <textarea name="experience" id="experience" required><?php echo htmlspecialchars($resume['experience']); ?></textarea>

                            <label for="education">Education</label>
                            <textarea name="education" id="education" required><?php echo htmlspecialchars($resume['education']); ?></textarea>

                            <button type="submit">Update Resume</button>
                        </form>
                        <a href="edit_resume.php" class="btn btn-secondary mt-2">Back to Resume List</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
