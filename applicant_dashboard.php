<?php
session_start();
require_once('../pdo.php');
require_once('../header.php');

if ($_SESSION['role'] != 'applicant') {
    header("Location: ../index.php");
    exit;
}

$job_id = $_GET['job_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resume = $_FILES['resume']['name'];
    move_uploaded_file($_FILES['resume']['tmp_name'], "$resume");

    $stmt = $pdo->prepare("INSERT INTO applicants (user_id, job_post_id, resume, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $job_id, $resume, 'pending']);

    echo "Application submitted.";
}

?>

<form action="applicant_dashboard.php" method="POST" enctype="form-data">
    <input type="file" name="resume" required>
    <textarea name="cover_letter" placeholder="Cover Letter"></textarea>
    <button type="submit">Apply</button>
</form>
