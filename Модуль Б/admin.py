from django.contrib import admin
from .models import Room, Booking, Review, ContactInfo

@admin.register(Room)
class RoomAdmin(admin.ModelAdmin):
    list_display = ('name', 'price', 'is_featured')

@admin.register(Booking)
class BookingAdmin(admin.ModelAdmin):
    list_display = ('guest_name', 'room', 'check_in_date', 'check_out_date', 'is_approved')
    list_filter = ('is_approved', 'room')

admin.site.register(Review)
admin.site.register(ContactInfo)