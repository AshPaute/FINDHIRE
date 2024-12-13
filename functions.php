<?php
function logActivity($pdo, $user_id, $action, $description) {
    $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action, description, timestamp) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$user_id, $action, $description]);
}
?>
