<?php
session_start();
include('db.php');

// Проверка, что пользователь администратор
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 0) {
    header("Location: index.php");
    exit();
}

// Получение данных о записях
$sql = "SELECT class, COUNT(user_id) AS total_users FROM bookings GROUP BY class";
$result = $conn->query($sql);
?>

<head>
    <link rel="stylesheet" type="text/css" href="styles/admin/styles.css">
</head>
<title>Administrator</title>

<h1>Panel Administratora</h1>
<nav>
    <ul>
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="wiadomosci.php">Wiadomości</a></li>
        <li><a href="logout.php">Wyloguj się</a></li>
    </ul>
</nav>

<h2>Podsumowanie zapisów na zajęcia</h2>
<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Zajęcia</th><th>Liczba zapisów</th><th>Akcje</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['class'] . "</td>";
        echo "<td>" . $row['total_users'] . "</td>";
        echo "<td><a href='#' class='show-attendance' data-class='" . $row['class'] . "'>Zaznacz obecność</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Brak zapisów na zajęcia.</p>";
}
?>

<div id="attendanceModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Zaznacz obecność</h2>
        <form id="attendanceForm">
            <button type="submit" class="save-button">Zapisz</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // JavaScript код для работы с модальным окном и отправки данных
    $(document).ready(function() {
        // Открытие модального окна при клике на ссылку
        $('.show-attendance').click(function() {
            var className = $(this).data('class');
            // Запрос на сервер для получения списка пользователей
            $.ajax({
                url: 'get_attendance_list.php',
                data: { class: className },
                success: function(data) {
                    $('#attendanceForm').html(data);
                    $('#attendanceModal').show();
                }
            });
        });

        // Закрытие модального окна
        $('.close').click(function() {
            $('#attendanceModal').hide();
        });
        // Обработчик для кнопки "Сохранить"
        $('#attendanceForm').on('submit', function(event) {
            event.preventDefault(); // Предотвращаем стандартную отправку формы

            // Получаем данные из формы (например, выбранные чекбоксы)
            var formData = $(this).serialize();

            // Отправляем данные на сервер
            $.ajax({
                url: 'save_attendance.php', // Замените на ваш скрипт для обработки данных
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response); // Выводим ответ сервера в консоль
                    // Закрываем модальное окно и выполняем другие действия
                    $('#attendanceModal').hide();
                },
                error: function() {
                    console.error('Ошибка при отправке данных');
                }
            });
        });
    });
</script>

<footer>
    <p>&copy; 2025 Dance Studio. Wszelkie prawa zastrzeżone.</p>
</footer>
