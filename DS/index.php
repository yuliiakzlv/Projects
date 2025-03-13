<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка на администратора
    if ($email === 'admin@admin.admin' && $password === '123') {
        $_SESSION['user_id'] = 0; // Условный ID администратора
        $_SESSION['user_name'] = 'Администратор';
        header("Location: admin_dashboard.php");
        exit();
    }

    // Поиск пользователя в базе данных
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Проверка пароля
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: dashboard.php");
        } else {
            echo "Nieprawiedłowe hasło!";
        }
    } else {
        echo "Brak użytkownika!";
    }
}

?>
<!-- Навигационное меню -->
<head>
    <link rel="stylesheet" type="text/css" href="styles/index/styles.css">
</head>
<title> DANCE STUDIO </title>
<header>
    <h1>Dance Studio</h1>
</header>
<nav>
    <ul>
        <li><a href="timetable.php">Harmonogram</a></li>
        <li><a href="price.php">Price</a></li>
        <li><a href="contacts.php">Kontakt</a></li>
    </ul>
</nav>

<!-- Cookie Consent Popup -->
<div id="cookie-consent" class="cookie-consent">
    <p>Nasza strona używa plików cookie, aby zapewnić Ci najlepsze doświadczenia. Kontynuując korzystanie z tej strony, wyrażasz zgodę na używanie plików cookie. <a href="#">Dowiedz się więcej</a>.</p>
    <button id="accept-cookie" class="accept-btn">Akceptuję</button>
</div>

<!-- Форма для входа -->
<form method="POST" action="index.php">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Hasło:</label><br>
    <input type="password" id="password" name="password" required><br>

    <button type="submit">Zaloguj się</button>
    <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
</form>

<!-- Cookie Consent Script -->
<script>
    // Check if the user has already accepted cookies
    if (!getCookie("cookie_consent")) {
        document.getElementById("cookie-consent").style.display = "block";
    }

    // When the user accepts cookies
    document.getElementById("accept-cookie").onclick = function() {
        setCookie("cookie_consent", "accepted", 365);
        document.getElementById("cookie-consent").style.display = "none";
    };

    // Function to get a cookie by name
    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Function to set a cookie
    function setCookie(name, value, days) {
        let d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }
</script>

<!-- Футер -->
<footer>
    <p>&copy; 2025 Dance Studio. Wszystkie prawa zastrzeżone.</p>
</footer>

