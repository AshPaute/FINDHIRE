<?php
session_start();
require_once('../pdo.php');
require_once('../header.php');

if ($_SESSION['role'] != 'hr') {
    header("Location: ../index.php");
    exit;
}

$job_id = $_GET['job_id'];
$stmt = $pdo->prepare("SELECT * FROM applicants WHERE job_post_id = ?");
$stmt->execute([$job_id]);
$applicants = $stmt->fetchAll();

foreach ($applicants as $applicant) {
    echo $applicant['user_id'] . " - " . $applicant['status'];
}
?>
