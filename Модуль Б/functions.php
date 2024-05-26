<?php
function validateBooking($data) {
    if (empty($data['name']) || !preg_match('/^[\p{L}\s\.\-]+$/u', $data['name'])) {
        return 'Некорректное имя';
    }
    if (empty($data['pet_name']) || !preg_match('/^[\p{L}\s\-]+$/u', $data['pet_name'])) {
        return 'Некорректное имя питомца';
    }
    if (empty($data['phone']) || !preg_match('/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/', $data['phone'])) {
        return 'Некорректный телефон';
    }
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return 'Некорректный email';
    }
    if (empty($data['arrival']) || !preg_match('/^\d{2}:\d{2}:\d{4}$/', $data['arrival'])) {
        return 'Некорректная дата заезда';
    }
    if (empty($data['departure']) || !preg_match('/^\d{2}:\d{2}:\d{4}$/', $data['departure'])) {
        return 'Некорректная дата выезда';
    }
    if (strtotime($data['arrival']) < time()) {
        return 'Дата заезда не может быть в прошлом';
    }
    if (strtotime($data['departure']) <= strtotime($data['arrival'])) {
        return 'Дата выезда должна быть позже даты заезда';
    }
    return true;
}
?>
