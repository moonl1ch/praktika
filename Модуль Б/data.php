<?php
function getRooms() {
    return [
        ['id' => 1, 'name' => 'Эконом', 'price' => 500],
        ['id' => 2, 'name' => 'Стандарт', 'price' => 1000],
        ['id' => 3, 'name' => 'Люкс', 'price' => 1500],
        ['id' => 4, 'name' => 'Супер-люкс', 'price' => 2000],
        ['id' => 5, 'name' => 'Премиум', 'price' => 2500],
        ['id' => 6, 'name' => 'VIP', 'price' => 3000],
    ];
}

function getRandomReviews($count) {
    $reviews = [
        "Отличное место!",
        "Моему коту очень понравилось!",
        "Прекрасное обслуживание.",
        "Вернемся снова!",
        "Супер!",
        "Рекомендую всем!"
    ];
    shuffle($reviews);
    $reviews = array_slice($reviews, 0, $count);
    $output = "<ul>";
    foreach ($reviews as $review) {
        $output .= "<li>$review</li>";
    }
    $output .= "</ul>";
    return $output;
}

function getContacts() {
    return "<p>Адрес: Москва, ул. Пушкинская, д. 10</p>
            <p>Режим работы: 24/7</p>
            <p>Телефон: +7(495)123-45-67</p>
            <p>E-mail: info@koteyka.ru</p>";
}

function getBookings() {
    return isset($_SESSION['bookings']) ? $_SESSION['bookings'] : [];
}

function saveBooking($data) {
    if (!isset($_SESSION)) session_start();
    if (!isset($_SESSION['bookings'])) $_SESSION['bookings'] = [];
    $_SESSION['bookings'][] = $data;
}
?>
