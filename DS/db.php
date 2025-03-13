<?php
$servername = "localhost";
$username = "root"; // стандартное имя пользователя для XAMPP
$password = ""; // стандартный пароль для XAMPP
$dbname = "dance_studio";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>

