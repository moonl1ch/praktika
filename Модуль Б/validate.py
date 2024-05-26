import re
from datetime import datetime

def validate_booking(data):
    name_pattern = re.compile(r'^[\p{L}\s\.\-]+$')
    pet_name_pattern = re.compile(r'^[\p{L}\s\-]+$')
    phone_pattern = re.compile(r'^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$')
    email_pattern = re.compile(r'^[\w\.-]+@[\w\.-]+\.\w+$')
    date_pattern = re.compile(r'^\d{2}:\d{2}:\d{4}$')

    if not name_pattern.match(data['name']):
        return 'Некорректное имя'
    if not pet_name_pattern.match(data['pet_name']):
        return 'Некорректное имя питомца'
    if not phone_pattern.match(data['phone']):
        return 'Некорректный телефон'
    if not email_pattern.match(data['email']):
        return 'Некорректный email'
    if not date_pattern.match(data['arrival']):
        return 'Некорректная дата заезда'
    if not date_pattern.match(data['departure']):
        return 'Некорректная дата выезда'
    
    arrival_date = datetime.strptime(data['arrival'], '%d:%m:%Y')
    departure_date = datetime.strptime(data['departure'], '%d:%m:%Y')
    
    if arrival_date < datetime.now():
        return 'Дата заезда не может быть в прошлом'
    if departure_date <= arrival_date:
        return 'Дата выезда должна быть позже даты заезда'

    return True
