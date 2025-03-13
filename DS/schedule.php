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

    <nav>
        <ul>
            <li><a href="schedule.php">Rozkład zajęć</a></li>
            <li><a href="price_dashboard.php">Moje karnety</a></li>
            <li><a href="wiadomosci.php">Wiadomości</a></li>
            <li><a href="dashboard.php">Powrót</a></li>
        </ul>
    </nav>
</header>

<h1>Rozkład zajęć</h1>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<table style="background-color: rgba(51, 51, 51, 0.5); color: white;">
    <tr>
        <th>Czas</th>
        <th>Poniedziałek</th>
        <th>Wtorek</th>
        <th>Środa</th>
        <th>Czwartek</th>
        <th>Piątek</th>
    </tr>
    <?php
    foreach ($times as $timeIndex => $time) {
        echo "<tr>";
        echo "<td>$time</td>";

        foreach (['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek'] as $day) {
            $class = '';
            foreach ($scheduled_classes[$day] as $scheduled_class) {
                if ($scheduled_class['time'] == $time) {
                    $class = $scheduled_class['class'];
                    break;
                }
            }

            if ($class) {
                echo "<td style='padding: 10px 5px; position: relative;'><strong>$class</strong>";
                echo "<form method='post' action='book_class.php' style='margin-top: 10px;'>";
                echo "<input type='hidden' name='day' value='$day'>"; // Przesyłanie dnia
                echo "<input type='hidden' name='time' value='$time'>"; // Przesyłanie czasu
                echo "<input type='hidden' name='class' value='$class'>"; // Przesyłanie zajęcia
                echo "<input type='submit' value='Zapisz się' class='book-button'>";
                echo "</form>";
                echo "</td>";
            } else {
                echo "<td style='padding: 10px 5px;'> </td>";
            }
        }
        echo "</tr>";
    }
    ?>
</table>

<footer>
    <p>&copy; 2025 Dance Studio. Wszystkie prawa zastrzeżone.</p>
</footer>
