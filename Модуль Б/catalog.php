<?php
include 'data.php';
$rooms = getRooms();
usort($rooms, function($a, $b) { return $a['price'] - $b['price']; });

foreach ($rooms as $room) {
    echo "<div class='room'>";
    echo "<h3>{$room['name']}</h3>";
    echo "<p>Цена: {$room['price']} руб.</p>";
    echo "<button onclick='openBookingForm({$room['id']})'>Забронировать</button>";
    echo "</div>";
}
?>
