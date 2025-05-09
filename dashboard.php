<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dashboard</title>
</head>
<body class="dashboard-page">
    <header class="dashboard-header">
        <h1>Welcome to Your Dashboard</h1>
        <nav>
            <ul class="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="dashboard-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h3>Create Resume</h3>
                        <p>Start building your resume from scratch.</p>
                        <a href="create_resume.php" class="btn btn-primary">Create</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h3>Edit Resume</h3>
                        <p>Edit an existing resume you've created.</p>
                        <a href="edit_resume.php" class="btn btn-warning">Edit</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h3>Download Resume</h3>
                        <p>Download your completed resumes in PDF format.</p>
                        <a href="download_resume.php" class="btn btn-success">Download</a>
                    </div>
                </div>
            </div> <!-- Close row -->
        </div> <!-- Close container -->
    </main>

    <footer class="dashboard-footer">
        <p>&copy; 2025 Resume Maker. All rights reserved.</p>
    </footer>
</body>
</html>