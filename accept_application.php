<?php
session_start();
require_once('../pdo.php');

if ($_SESSION['role'] != 'hr') {
    header('Location: ../index.php');
    exit;
}

$application_id = $_GET['applicant_id'];
$stmt = $pdo->prepare("UPDATE applicants SET status = 'accepted' WHERE id = ?");
$stmt->execute([$application_id]);

// Log activity
logActivity($pdo, $_SESSION['user_id'], 'Accepted Application', 'Application ID: ' . $application_id);

// Redirect back to the HR dashboard
header("Location: hr_dashboard.php");
exit;
