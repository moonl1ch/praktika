function openBookingForm(roomId) {
    let form = `<form action="booking.php" method="POST">
                    <input type="hidden" name="room_id" value="${roomId}">
                    <label>Ваше имя: <input type="text" name="name" required></label>
                    <label>Имя питомца: <input type="text" name="pet_name" required></label>
                    <label>Телефон: <input type="text" name="phone" required pattern="\\+7\\(\\d{3}\\)\\d{3}-\\d{2}-\\d{2}"></label>
                    <label>E-mail: <input type="email" name="email" required></label>
                    <label>Дата заезда: <input type="text" name="arrival" required pattern="\\d{2}:\\d{2}:\\d{4}"></label>
                    <label>Дата выезда: <input type="text" name="departure" required pattern="\\d{2}:\\d{2}:\\д{4}"></label>
                    <button type="submit">Отправить заявку</button>
                </form>`;
    let bookingWindow = window.open("", "Booking", "width=400,height=600");
    bookingWindow.document.write(form);
}
