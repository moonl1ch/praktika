<?php
include 'db.php';
$rooms = get_all_rooms();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Каталог номеров</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Каталог номеров</h1>
    </header>
    <main class="catalog">
        <form method="GET">
            <select name="sort">
                <option value="price_asc">По возрастанию цены</option>
                <option value="price_desc">По убыванию цены</option>
            </select>
            <button type="submit">Применить</button>
            <button type="reset">Сбросить фильтр</button>
        </form>
        <ul>
            <?php foreach($rooms as $room): ?>
                <li>
                    <?php echo $room['name']; ?> - <?php echo $room['price']; ?> руб.
                    <a href="book.php?room_id=<?php echo $room['id']; ?>">Забронировать</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>
