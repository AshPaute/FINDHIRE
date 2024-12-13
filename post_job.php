<?php
session_start();
require_once('../pdo.php');
require_once('../header.php');

// Check if the user is HR
if ($_SESSION['role'] != 'hr') {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Insert job post into the database
    $stmt = $pdo->prepare("INSERT INTO job_posts (title, description, posted_by) VALUES (?, ?, ?)");
    $stmt->execute([$title, $description, $_SESSION['user_id']]);

    // Log the activity
    logActivity($pdo, $_SESSION['user_id'], 'Created Job Post', 'Job post titled: ' . $title);

    echo "Job post created successfully!";
}

?>

<form action="post_job.php" method="POST">
    <input type="text" name="title" placeholder="Job Title" required>
    <textarea name="description" placeholder="Job Description" required></textarea>
    <button type="submit">Post Job</button>
</form>
