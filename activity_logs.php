<?php
session_start();
require_once('pdo.php');

$stmt = $pdo->query("SELECT * FROM activity_logs ORDER BY timestamp DESC");

while ($log = $stmt->fetch()) {
    echo "<p>{$log['timestamp']} - {$log['action']}: {$log['description']}</p>";
}
?>
