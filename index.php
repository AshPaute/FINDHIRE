<?php
session_start();
require_once('pdo.php');
require_once('header.php');

// Display job posts for applicants
if ($_SESSION['role'] == 'applicant') {
    $stmt = $pdo->query("SELECT * FROM job_posts");
    while ($job = $stmt->fetch()) {
        echo "<p><a href='applicant/applicant_dashboard.php?job_id={$job['id']}'>{$job['title']}</a></p>";
    }
}

// If HR is logged in, show their job management area
if ($_SESSION['role'] == 'hr') {
    echo "<a href='hr/post_job.php'>Create New Job Post</a>";
}
?>
