# 📌 Project Documentation

## Overview

This project implements phone number authentication, location selection, and user registration using Laravel with the Repository Pattern. It ensures a structured and scalable architecture while handling authentication and location storage efficiently.

---

## 🏗 System Flow

1. **User enters phone number** → OTP verification is sent.
2. **User verifies OTP** → Stores phone temporarily in `temporary_users`.
3. **User selects location** → Saves the state & city (linked to `temporary_users`).
4. **User completes registration** → Moves phone & location to `users` table and deletes from `temporary_users`.
5. **User logs in** → Authenticates using email & password.

---

## 📂 Folder Structure

```plaintext
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── LocationController.php
│   │   ├── RegisterController.php
│   │   └── LoginController.php
│   ├── Requests/
│   │   ├── VerifyOTPRequest.php
│   │   ├── SelectLocationRequest.php
│   │   └── RegisterRequest.php
│   ├── Interfaces/
│   │   ├── AuthRepositoryInterface.php
│   │   ├── LocationRepositoryInterface.php
│   │   └── UserRepositoryInterface.php
│   ├── Repositories/
│   │   ├── AuthRepository.php
│   │   ├── LocationRepository.php
│   │   └── UserRepository.php

├── Models/
│   ├── User.php
│   ├── PhoneVerification.php
│   ├── TemporaryUser.php
│   ├── State.php
│   ├── City.php
│   └── UserLocation.php

├── Database/
│   ├── Migrations/
│   │   ├── create_users_table.php
│   │   ├── create_temporary_users_table.php
│   │   ├── create_locations_table.php
│   │   ├── create_user_locations_table.php
│   │   ├── create_phone_verifications_table.php
│   ├── Seeders/
│   │   ├── StatesTableSeeder.php
│   │   ├── CitiesTableSeeder.php
