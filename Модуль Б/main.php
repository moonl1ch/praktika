<?php
include 'db.php';
$featured_rooms = get_featured_rooms();
$random_reviews = get_random_reviews();
$contact_info = get_contact_info();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Котейка</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Гостиница "Котейка"</h1>
    </header>
    <main>
        <section class="featured-rooms">
            <h2>Рекомендуемые номера</h2>
            <ul>
                <?php foreach($featured_rooms as $room): ?>
                    <li><?php echo $room['name']; ?> - <?php echo $room['price']; ?> руб.</li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section class="reviews">
            <h2>Отзывы</h2>
            <ul>
                <?php foreach($random_reviews as $review): ?>
                    <li><?php echo $review['content']; ?> - <?php echo $review['author']; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section class="contacts">
            <h2>Контакты</h2>
            <p><?php echo $contact_info['address']; ?></p>
            <p><?php echo $contact_info['work_hours']; ?></p>
            <p><?php echo $contact_info['phone']; ?></p>
            <p><?php echo $contact_info['email']; ?></p>
        </section>
    </main>
</body>
</html>
