<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include('db.php');
// Получение предстоящих занятий
$user_id = $_SESSION['user_id'];
$sql = "SELECT class, day, time FROM bookings WHERE user_id = '$user_id' ORDER BY time";
$result = $conn->query($sql);

?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/dashboard/styles.css">
</head>
<title>Welcome</title>
<header>
    <h1>Dance Studio</h1>
</header>
<!-- Навигационное меню -->
<nav>
    <ul>
        <li><a href="schedule.php">Harmonogram zajeć</a></li>
        <li><a href="price_dashboard.php">Moje karnety</a></li>
        <li><a href="wiadomosci.php">Wiadomości</a></li>
        <li><a href="logout.php">Wyloguj się</a></li>

    </ul>
</nav>
<h1>Witam, <?php echo $_SESSION['user_name']; ?>!</h1>
<form>
<h2>Nadchodzące zajęcia</h2>
<br>
<?php
$sql = "SELECT id, class, day, time FROM bookings WHERE user_id = '$user_id' ORDER BY day, time";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Dzień</th><th>Zajęcie</th><th>Czas</th><th>Akcje</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['day']) . "</td>";
        echo "<td>" . htmlspecialchars($row['class']) . "</td>";
        echo "<td>" . htmlspecialchars($row['time']) . "</td>";
        echo "<td>";
        echo "<form method='post' action='cansel_booking.php' style='display:inline;'>";
        echo "<input type='hidden' name='booking_id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Anuluj' class='cancel-button'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Brak zajęć.</p>";
}

?>
</form>

<footer>
    <p>&copy; 2025 Dance Studio. Wszelkie prawa zastrzeżone.</p>
</footer>
