<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}
require_once __DIR__ . '/vendor/autoload.php'; // Adjust path if needed

$host = 'localhost';
$db = 'resume maker';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$resume_id = isset($_GET['resume_id']) ? intval($_GET['resume_id']) : 0;

$stmt = $conn->prepare("SELECT * FROM resumes WHERE resume_id = ? AND user_id = ?");
$stmt->bind_param("ii", $resume_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $resume = $result->fetch_assoc();

    // Create new PDF document
    $pdf = new TCPDF();
    $pdf->SetCreator('Resume Maker');
    $pdf->SetAuthor($resume['name']);
    $pdf->SetTitle('Resume - ' . $resume['name']);
    $pdf->SetMargins(20, 20, 20, true);
    $pdf->AddPage();

    // ATS-friendly: Use simple headings and text, no tables or images
    $html = '<h2>' . htmlspecialchars($resume['name']) . '</h2>';
    $html .= '<p><strong>Email:</strong> ' . htmlspecialchars($resume['email']) . '<br>';
    $html .= '<strong>Phone:</strong> ' . htmlspecialchars($resume['phone']) . '<br>';
    $html .= '<strong>Address:</strong> ' . htmlspecialchars($resume['address']) . '</p>';

    $html .= '<h3>Skills</h3><p>' . nl2br(htmlspecialchars($resume['skills'])) . '</p>';
    $html .= '<h3>Experience</h3><p>' . nl2br(htmlspecialchars($resume['experience'])) . '</p>';
    $html .= '<h3>Education</h3><p>' . nl2br(htmlspecialchars($resume['education'])) . '</p>';

    $pdf->writeHTML($html, true, false, true, false, '');

    // Output PDF
    $pdf->Output('resume_' . $resume_id . '.pdf', 'D');
    exit();
} else {
    echo "Resume not found or you do not have permission to download this resume.";
}

$stmt->close();
$conn->close();
?>