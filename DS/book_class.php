<?php
session_start();
include('db.php');

// Проверка, что пользователь авторизован
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Перенаправляем на страницу входа, если нет активной сессии
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $time = $_POST['time'];
    $class = $_POST['class'];
    $day = $_POST['day'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, class, time, day) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $class, $time, $day);

    if ($stmt->execute()) {
        echo "<script>
            alert('Jeśteś zapisany na : $class в $day, $time.');
            window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Ошибка записи: {$stmt->error}');
            window.history.back();
        </script>";
    }
    $stmt->close();

}
?>
<footer>
    <p>&copy; 2025 Dance Studio. Wszystkie prawa są zastrzeżone.</p>
</footer>
