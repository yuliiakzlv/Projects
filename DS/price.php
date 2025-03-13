<?php session_start(); ?>
<header>
    <h1>Dance Studio</h1>
</header>
<nav>
    <ul>
        <li><a href="index.php">Główna</a></li>
        <li><a href="dashboard.php">Powrót</a></li>
    </ul>
</nav>
<br>
<h2>Price</h2>
<head>
    <link rel="stylesheet" type="text/css" href="styles/price/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<br>
<table>
    <thead>
    <tr>
        <th>Zajęcia</th>
        <th>jednorazowe wejście</th>
        <th>Karnet na 4 wejścia</th>
        <th>Karnet na 8 wejść</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Dance</td>
        <td>40 PLN <button class="buy-btn" data-type="Dance" data-price="40" data-plan="jednorazowe wejście">Kupuje</button></td>
        <td>180 PLN <button class="buy-btn" data-type="Dance" data-price="180" data-plan="Karnet na 4 wejścia">Kupuje</button></td>
        <td>210 PLN <button class="buy-btn" data-type="Dance" data-price="210" data-plan="Karnet na 8 wejść">Kupuje</button></td>
    </tr>
    <tr>
        <td>Pole dance</td>
        <td>50 PLN <button class="buy-btn" data-type="Pole dance" data-price="50" data-plan="jednorazowe wejście">Kupuje</button></td>
        <td>200 PLN <button class="buy-btn" data-type="Pole dance" data-price="200" data-plan="Karnet na 4 wejścia">Kupuje</button></td>
        <td>230 PLN <button class="buy-btn" data-type="Pole dance" data-price="230" data-plan="Karnet na 8 wejść">Kupuje</button></td>
    </tr>
    <tr>
        <td>Areal skills</td>
        <td>50 PLN <button class="buy-btn" data-type="Aerial skills" data-price="50" data-plan="jednorazowe wejście">Kupuje</button></td>
        <td>210 PLN <button class="buy-btn" data-type="Aerial skills" data-price="210" data-plan="Karnet na 4 wejścia">Kupuje</button></td>
        <td>240 PLN <button class="buy-btn" data-type="Aerial skills" data-price="240" data-plan="Karnet na 8 wejść">Kupuje</button></td>
    </tr>
    </tbody>
</table>


<!-- Модальное окно -->
<div id="payment-modal" style="display: none;">
    <form id="payment-form" method="POST" action="process_payment.php">
        <h2>Zakup</h2>
        <label>Imie:</label><br>
        <input type="text" name="name" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Wybierz metod płatności:</label><br>
        <select name="payment_method" id="payment-method" required>
            <option value="visa">Visa</option>
            <option value="mastercard">MasterCard</option>
            <option value="blik">Blik</option>
        </select><br>

        <div id="payment-details" style="display: none;">
            <label>Podaj dane:</label><br>
            <input type="text" name="payment_details" required>
        </div>
        <input type="hidden" name="type">
        <input type="hidden" name="price">
        <input type="hidden" name="plan">
        <button class='pay-button' type="submit">Zapłać</button>
    </form>
</div>


<footer>
    <p>&copy; 2025 Dance Studio. Wszelkie prawa są zastrzeżone.</p>
</footer>

<script>
    $(document).ready(function () {
        $(".buy-btn").click(function () {
            const type = $(this).data("type");
            const price = $(this).data("price");
            const plan = $(this).data("plan");

            $("input[name='type']").val(type);
            $("input[name='price']").val(price);
            $("input[name='plan']").val(plan);

            $("#payment-modal").show();
        });

        $("#payment-method").change(function () {
            const method = $(this).val();
            if (method === "visa" || method === "mastercard" || method === "blik") {
                $("#payment-details").show();
            } else {
                $("#payment-details").hide();
            }
        });

        $("#close-modal").click(function () {
            $("#payment-modal").hide();
        });
    });
</script>

