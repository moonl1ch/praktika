from django.db import models

class Room(models.Model):
    name = models.CharField(max_length=255)
    description = models.TextField()
    price = models.DecimalField(max_digits=10, decimal_places=2)
    is_featured = models.BooleanField(default=False)

class Booking(models.Model):
    room = models.ForeignKey(Room, on_delete=models.CASCADE)
    guest_name = models.CharField(max_length=255)
    pet_name = models.CharField(max_length=255)
    phone = models.CharField(max_length=15)
    email = models.EmailField()
    check_in_date = models.DateField()
    check_out_date = models.DateField()
    is_approved = models.BooleanField(default=False)

class Review(models.Model):
    author = models.CharField(max_length=255)
    content = models.TextField()

class ContactInfo(models.Model):
    address = models.CharField(max_length=255)
    work_hours = models.CharField(max_length=255)
    phone = models.CharField(max_length=15)
    email = models.EmailField()
    social_links = models.JSONField()