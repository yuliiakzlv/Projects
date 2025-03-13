<?php
session_start();
include('db.php');

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $booking_id = $_POST['booking_id'];

    // Удаляем только записи, принадлежащие текущему пользователю
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $booking_id, $user_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Zajęcie zostało anulowane.');
            window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Ошибка при отмене записи.');
            window.history.back();
        </script>";
    }

    $stmt->close();
}
?>
