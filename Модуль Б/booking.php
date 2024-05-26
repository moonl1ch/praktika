<?php
include 'functions.php';
$data = $_POST;
$validationResult = validateBooking($data);

if ($validationResult === true) {
    saveBooking($data);
    echo "<script>alert('Бронирование успешно!'); window.close();</script>";
} else {
    echo "<script>alert('Ошибка: $validationResult'); window.history.back();</script>";
}
?>
