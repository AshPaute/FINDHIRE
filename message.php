<?php
session_start();
require_once('../pdo.php');
require_once('../header.php');

// If HR is not logged in, redirect to the homepage
if ($_SESSION['role'] != 'hr') {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $applicant_id = $_POST['applicant_id'];

    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $applicant_id, $message]);

    echo "Message sent.";
}
?>

<form action="message.php" method="POST">
    <textarea name="message" placeholder="Reply to applicant" required></textarea>
    <input type="hidden" name="applicant_id" value="<?php echo $_GET['applicant_id']; ?>">
    <button type="submit">Send Reply</button>
</form>
