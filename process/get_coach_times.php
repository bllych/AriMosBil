<?php
require_once '../config.php';
requireAdmin();

$coach_id = (int)($_GET['coach_id'] ?? 0);

if ($coach_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM coach_times WHERE coach_id = ? ORDER BY time_slot");
    $stmt->execute([$coach_id]);
    $times = $stmt->fetchAll();

    echo '<form method="POST" action="update_coach_times.php">';
    echo '<input type="hidden" name="coach_id" value="' . $coach_id . '">';
    echo '<div style="max-height: 300px; overflow-y: auto;">';

    foreach ($times as $time) {
        $checked = $time['is_available'] ? 'checked' : '';
        echo '<div class="form-group" style="display: flex; align-items: center; margin-bottom: 10px;">';
        echo '<input type="checkbox" id="time_' . $time['id'] . '" name="times[' . $time['id'] . ']" value="1" ' . $checked . ' style="margin-right: 10px;">';
        echo '<label for="time_' . $time['id'] . '">' . htmlspecialchars($time['time_slot']) . '</label>';
        echo '</div>';
    }

    echo '</div>';
    echo '<div style="margin-top: 20px;">';
    echo '<label for="new_time_slot">Add new time slot:</label>';
    echo '<input type="text" id="new_time_slot" name="new_time_slot" placeholder="e.g. 17:00-18:00" style="margin-left: 10px;">';
    echo '<button type="submit" class="btn btn-primary" style="margin-left: 10px;">Update Times</button>';
    echo '</div>';
    echo '</form>';
} else {
    echo '<p>Invalid coach ID.</p>';
}
?>
