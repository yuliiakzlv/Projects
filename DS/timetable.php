<?php
session_start();

// Zajęcia dla każdego dnia tygodnia (ustalone rozkłady)
$classes = [
    'Poniedziałek' => ['Pole dance 0', 'Hip hop', 'Jazz funk', 'Pole dance A'],
    'Wtorek' => ['Modern', 'Aerial skills', 'Pole dance A', 'Modern A'],
    'Środa' => ['Pole dance kidz', 'Hip hop', 'Modern', 'Pole dance A'],
    'Czwartek' => ['Jazz funk', 'Aerial skills', 'Pole dance A', 'Jazz funk'],
    'Piątek' => ['Pole dance 0', 'Aerial skills', 'Pole dance 0', 'Modern']
];

// Czas zajęć
$times = [
    '16:00 - 17:00',
    '17:00 - 18:00',
    '18:00 - 19:00',
    '19:00 - 20:00',
    '20:00 - 21:00'
];

// Wypełnienie harmonogramu zgodnie z danymi
$scheduled_classes = [
    'Poniedziałek' => [
        ['time' => $times[0], 'class' => 'Pole dance 0'],
        ['time' => $times[1], 'class' => 'Hip hop'],
        ['time' => $times[2], 'class' => 'Jazz funk'],
        ['time' => $times[3], 'class' => 'Pole dance A']
    ],
    'Wtorek' => [
        ['time' => $times[0], 'class' => 'Modern'],
        ['time' => $times[1], 'class' => 'Aerial skills'],
        ['time' => $times[2], 'class' => 'Pole dance A'],
        ['time' => $times[4], 'class' => 'Modern A']
    ],
    'Środa' => [
        ['time' => $times[0], 'class' => 'Pole dance kidz'],
        ['time' => $times[1], 'class' => 'Hip hop'],
        ['time' => $times[2], 'class' => 'Modern'],
        ['time' => $times[3], 'class' => 'Pole dance A']
    ],
    'Czwartek' => [
        ['time' => $times[0], 'class' => 'Jazz funk'],
        ['time' => $times[1], 'class' => 'Aerial skills'],
        ['time' => $times[2], 'class' => 'Pole dance A'],
        ['time' => $times[4], 'class' => 'Jazz funk']
    ],
    'Piątek' => [
        ['time' => $times[0], 'class' => 'Pole dance 0'],
        ['time' => $times[1], 'class' => 'Aerial skills'],
        ['time' => $times[3], 'class' => 'Pole dance 0'],
        ['time' => $times[4], 'class' => 'Modern']
    ]
];

// Zapisanie rozkładu zajęć w sesji
$_SESSION['scheduled_classes'] = $scheduled_classes;

?>
<header>
    <h1>Dance Studio</h1>
</header>

<nav>
    <ul>
        <li><a href="index.php">Na główną</a></li>

    </ul>
</nav>
<br>
<h2>Rozkład zajęć</h2>
<head>
    <link rel="stylesheet" type="text/css" href="styles/timetable/styles.css">
</head>
<table style="background-color: rgba(51, 51, 51, 0.5); color: white;">
    <?php
    foreach ($times as $timeIndex => $time) {
        echo "<tr>";
        echo "<td>$time</td>";

        foreach (['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek'] as $day) {
            $class = ''; // Initialize $class with an empty string

            foreach ($scheduled_classes[$day] as $scheduled_class) {
                if ($scheduled_class['time'] == $time) {
                    $class = $scheduled_class['class'];
                    break;
                }
            }

            if ($class) {
                echo "<td style='padding: 10px 5px; position: relative;'><strong>$class</strong>";
                echo "<form method='post' action='book_class.php'>";
                echo "<input type='hidden' name='day' value='$day'>"; // Sending the day
                echo "<input type='hidden' name='time' value='$time'>"; // Sending the time
                echo "<input type='hidden' name='class' value='$class'>"; // Sending the class
                echo "<input type='submit' value='Zapisz się' class='book-button'>";
                echo "</form>";
                echo "</td>";
            } else {
                echo "<td style='padding: 10px 5px;'>Zajęcia brak</td>";
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<div class="centered-block">
    <h2> Aby zapisać się na zajęcia, wykonaj następujące kroki: </h2>
    <ul>
        <li>Zaloguj się do swojego <a href="index.php">konta</a></li>
        <li>Lub <a href="register.php">zarejestruj się</a></li>
    </ul>
</div>

<footer>
    <p>&copy; 2025 Dance Studio. Wszystkie prawa zastrzeżone.</p>
</footer>
