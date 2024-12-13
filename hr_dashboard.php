<?php
session_start();
require_once('../pdo.php');
require_once('../header.php');

// If HR is not logged in, redirect to the homepage
if ($_SESSION['role'] != 'hr') {
    header('Location: ../index.php');
    exit;
}

// Get all applications for a specific job post
$job_id = $_GET['job_id'];
$stmt = $pdo->prepare("SELECT * FROM applicants WHERE job_post_id = ?");
$stmt->execute([$job_id]);
$applications = $stmt->fetchAll();

foreach ($applications as $application) {
    echo "<p>Applicant: {$application['user_id']} - Status: {$application['status']}</p>";
    
    if ($application['status'] == 'pending') {
        echo "<a href='accept_application.php?applicant_id={$application['id']}'>Accept</a>";
        echo "<a href='reject_application.php?applicant_id={$application['id']}'>Reject</a>";
    }
}

?>
