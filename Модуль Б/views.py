from django.shortcuts import render, get_object_or_404
from django.http import JsonResponse
from .models import Room, Booking, Review, ContactInfo

def home(request):
    featured_rooms = Room.objects.filter(is_featured=True)
    random_reviews = Review.objects.order_by('?')[:5]
    contact_info = ContactInfo.objects.first()
    return render(request, 'home.html', {
        'featured_rooms': featured_rooms,
        'random_reviews': random_reviews,
        'contact_info': contact_info
    })

def room_catalog(request):
    rooms = Room.objects.all().order_by('price')
    return render(request, 'catalog.html', {'rooms': rooms})

def book_room(request, room_id):
    room = get_object_or_404(Room, id=room_id)
    if request.method == 'POST':
        guest_name = request.POST['guest_name']
        pet_name = request.POST['pet_name']
        phone = request.POST['phone']
        email = request.POST['email']
        check_in_date = request.POST['check_in_date']
        check_out_date = request.POST['check_out_date']

    return render(request, 'book_room.html', {'room': room})