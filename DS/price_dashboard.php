<nav>
    <ul>
        <li><a href="schedule.php">Rozkład zajęć</a></li>
        <li><a href="price_dashboard.php">Moje karnety</a></li>
        <li><a href="wiadomosci.php">Wiadomości</a></li>
        <li><a href="dashboard.php">Powrot</a></li>


    </ul>
</nav>
<head>
    <link rel="stylesheet" type="text/css" href="styles/abonement/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<h1>Moje karnety</h1>
<div class="centered-block">
    <h2> Aby kupić karnet musisz przejdź do <a href="price.php"> strony: </a></h2>
</div>
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include('db.php');
// Получение предстоящих занятий
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM purchases WHERE user_id = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Typ</th><th>Plan</th><th>Cena</th><th>Metod płatności</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['plan'] . "</td>";
        echo "<td>" . $row['price'] . " PLN</td>";
        echo "<td>" . $row['payment_method'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Brak karnetów.</p>";
}
?>
<br>
<h2>Ceny</h2>
<br>
<div class="table-container">
    <!-- Tabela dla Tańca -->
    <table>
        <caption>Dance</caption>
        <thead>
        <tr>
            <th>Karnet</th>
            <th>Cena</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Pojedyncze zajęcia</td>
            <td>40 PLN</td>
        </tr>
        <tr>
            <td>Karnet na 4 zajęcia</td>
            <td>180 PLN</td>
        </tr>
        <tr>
            <td>Karnet na 8 zajęć</td>
            <td>210 PLN</td>
        </tr>
        </tbody>
    </table>

    <!-- Tabela dla Pole Dance -->
    <table>
        <caption>Pole Dance</caption>
        <thead>
        <tr>
            <th>Rodzaj karnetu</th>
            <th>Cena</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Pojedyncze zajęcia</td>
            <td>50 PLN</td>
        </tr>
        <tr>
            <td>Karnet na 4 zajęcia</td>
            <td>200 PLN</td>
        </tr>
        <tr>
            <td>Karnet na 8 zajęć</td>
            <td>230 PLN</td>
        </tr>
        </tbody>
    </table>

    <!-- Tabela dla Akrobatyki Powietrznej -->
    <table>
        <caption>Akrobatyka Powietrzna</caption>
        <thead>
        <tr>
            <th>Rodzaj karnetu</th>
            <th>Cena</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Pojedyncze zajęcia</td>
            <td>50 PLN</td>
        </tr>
        <tr>
            <td>Karnet na 4 zajęcia</td>
            <td>210 PLN</td>
        </tr>
        <tr>
            <td>Karnet na 8 zajęć</td>
            <td>240 PLN</td>
        </tr>
        </tbody>
    </table>
</div>

<footer>
    <p>&copy; 2025 Dance Studio. Wszystkie prawa zastrzeżone.</p>
</footer>
