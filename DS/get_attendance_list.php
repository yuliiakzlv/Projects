<?php
session_start();
include('db.php');

$className = $_GET['class'];

$stmt = $conn->prepare("SELECT u.name, b.id FROM bookings b JOIN users u ON b.user_id = u.id WHERE b.class = ?");

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("s", $className);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        echo '<li><input type="checkbox" name="attendance[]" value="' . $row['id'] . '"> ' . $row['name'] . '</li>';
    }
    echo '</ul>';
} else {
    echo "Нет записей для этого класса.";
}

// ... rest of your code

// Обработка отправки формы (пример)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendance = $_POST['attendance'];
    // Сохранение данных о посещаемости в базе данных
    foreach ($attendance as $userId) {
        // Подготовленный запрос для обновления данных о посещаемости
        $updateStmt = $conn->prepare("UPDATE users SET attended = 1 WHERE id = ?");
        $updateStmt->bind_param("i", $userId);
        $updateStmt->execute();
    }
}
?>