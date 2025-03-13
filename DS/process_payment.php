<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $payment_method = $_POST['payment_method'];
    $payment_details = $_POST['payment_details'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $plan = $_POST['plan'];

    // Проверка, существует ли пользователь
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Сохранение покупки
        $user = $result->fetch_assoc();
        $user_id = $user['id'];

        $sql = "INSERT INTO purchases (user_id, type, plan, price, payment_method) 
                VALUES ('$user_id', '$type', '$plan', '$price', '$payment_method')";

        if ($conn->query($sql) === TRUE) {
            echo "Sukces! <a href='index.php'>Powrót do strony głównej</a>";
        } else {
            echo "Ошибка при сохранении данных: " . $conn->error;
        }
    } else {
        echo "Brak użytkownika. <a href='register.php'> Proszę, zarejestrować się</a>.";
    }
}
?>
