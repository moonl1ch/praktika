<?php
session_start();
if ($_POST['login'] == 'admin' && $_POST['password'] == 'PROF2023') {
    $_SESSION['admin'] = true;
}

if (!isset($_SESSION['admin'])) {
    echo '<form method="POST">
            <label>Логин: <input type="text" name="login"></label>
            <label>Пароль: <input type="password" name="password"></label>
            <button type="submit">Войти</button>
          </form>';
} else {
    include 'data.php';
    $bookings = getBookings();
    foreach ($bookings as $booking) {
        echo "<div class='booking'>";
        echo "<p>Имя: {$booking['name']}</p>";
        echo "<p>Имя питомца: {$booking['pet_name']}</p>";
        echo "<p>Телефон: {$booking['phone']}</p>";
        echo "<p>E-mail: {$booking['email']}</p>";
        echo "<button onclick='approveBooking({$booking['id']})'>Одобрить</button>";
        echo "<button onclick='deleteBooking({$booking['id']})'>Удалить</button>";
        echo "</div>";
    }
}
?>
