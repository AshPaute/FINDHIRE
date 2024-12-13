<?php
session_start();
require_once('../pdo.php');
require_once('../header.php');

if ($_SESSION['role'] != 'applicant') {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $hr_id = $_POST['hr_id'];

    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $hr_id, $message]);

    echo "Message sent.";
}

?>

<form action="follow_up.php" method="POST">
    <textarea name="message" placeholder="Follow-up message" required></textarea>
    <input type="hidden" name="hr_id" value="HR_USER_ID_HERE">
    <button type="submit">Send Follow-Up</button>
</form>
