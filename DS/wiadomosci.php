<?php
error_reporting(E_ALL & ~E_WARNING);
session_start();
include('db.php');

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Обработка отправки сообщения
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $userId = $_SESSION['user_id'];

    // Все сообщения автоматически глобальные
    $isGlobal = 1;

    $stmt = $conn->prepare("INSERT INTO messages (user_id, message, is_global) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $userId, $message, $isGlobal);
    $stmt->execute();

    // Уведомление всех пользователей
    sendGlobalNotification($message);
}

// Функция для уведомления всех пользователей
function sendGlobalNotification($message) {
    global $conn;
    $stmt = $conn->prepare("SELECT email FROM users");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
        // Здесь можно использовать функцию mail() или другую реализацию для отправки уведомлений
        mail($email, "Новое глобальное сообщение", $message);
    }
}

// Подготовка запроса
$stmt = $conn->prepare("
    SELECT m.id, m.user_id, m.message, m.is_global, u.name AS username 
    FROM messages m 
    JOIN users u ON m.user_id = u.id 
    ORDER BY m.created_at DESC
");

// Проверка подготовки запроса
if (!$stmt) {
    die("Ошибка подготовки SQL-запроса: " . $conn->error);
}

// Выполнение запроса
$stmt->execute();
$messages = $stmt->get_result();
?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/wiadomosci/styles.css">
</head>
<title>Chat</title>
<header>
    <h1>Dance Studio</h1>
</header>
<!-- Навигационное меню -->
<nav>
    <ul>
        <li><a href="schedule.php">Harmonogram</a></li>
        <li><a href="price_dashboard.php">Moje karnety</a></li>
        <li><a href="wiadomosci.php">Wiadomości</a></li>
        <li><a href="dashboard.php">Wróć</a></li>
    </ul>
</nav>
<div class="container">
    <!-- Левая часть: чат -->
    <div class="messages">
        <?php while ($row = $messages->fetch_assoc()): ?>
            <div class="message global">
                <strong><?= htmlspecialchars($row['username']) ?>:</strong>
                <p><?= htmlspecialchars($row['message']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Правая часть: форма отправки сообщения -->
    <div class="form-container">
        <form method="post">
            <textarea name="message" required placeholder="Aaa..."></textarea>
            <button type="submit">Wyślij</button>
        </form>
    </div>
</div>