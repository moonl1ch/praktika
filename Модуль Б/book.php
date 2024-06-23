<?php
include 'db.php';
$room_id = $_GET['room_id'];
$room = get_room_by_id($room_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guest_name = $_POST['guest_name'];
    $pet_name = $_POST['pet_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];

    if (validate_booking($guest_name, $pet_name, $phone, $email, $check_in_date, $check_out_date)) {
        save_booking($room_id, $guest_name, $pet_name, $phone, $email, $check_in_date, $check_out_date);
        echo "Заявка успешно отправлена!";
    } else {
        echo "Ошибка валидации данных.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Бронирование номера</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Бронирование номера: <?php echo $room['name']; ?></h1>
    </header>
    <main class="booking-form">
        <form method="POST">
            <label>Ваше имя:</label>
            <input type="text" name="guest_name" required><br>
            <label>Имя Питомца:</label>
            <input type="text" name="pet_name" required><br>
            <label>Телефон:</label>
            <input type="text" name="phone" required pattern="\+7\(\d{3}\)\d{3}-\d{2}-\d{2}"><br>
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <label>Дата заезда:</label>
            <input type="date" name="check_in_date" required><br>
            <label>Дата выезда:</label>
            <input type="date" name="check_out_date" required><br>
            <button type="submit">Отправить заявку</button>
        </form>
    </main>
</body>
</html>
