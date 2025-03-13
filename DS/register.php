<?php
include('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хешируем пароль
    $name = $_POST['name'];

    // Вставка данных в базу
    $sql = "INSERT INTO users (email, password, name) VALUES ('$email', '$password', '$name')";

    if ($conn->query($sql) === TRUE) {
        echo "Регистрация прошла успешно!";
        header("Location: index.php"); // Перенаправление на страницу входа
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/register/styles.css">
</head>

<title>Rejestracja</title>
<header>
    <h1>Dance Studio</h1>
</header>
<form method="POST" action="register.php">
    <label for="name">Imię:</label><br>
    <input type="text" id="name" name="name" required><br>

    <label for="email">E-mail:</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Hasło:</label><br>
    <input type="password" id="password" name="password" required><br>

    <button type="submit">Zarejestruj się</button>
</form>
<footer>
    <p>&copy; 2025 Dance Studio. Wszystkie prawa zastrzeżone.</p>
</footer>
