# 🚀 Laravel Assignment – User Registration & Verification Flow  

## 📖 App Overview  
This application implements a **custom onboarding flow** for Woliba-wellness user registration.  
The flow includes:  

1. **Email Verification (OTP-based)**  
   - User registers with first/last name, company name, and email.  
   - A **6-digit OTP** is sent to the user’s email.  
   - OTP expires after **10 minutes**.  
   - Users can **resend OTP** after **3 minutes**.  

2. **Profile Completion**  
   - Save additional details (DOB, contact number, password).  
   - Select **Wellness Interests**.  
   - Select exactly **3 Wellbeing Pillars** (with order).  
   - Registration completes once pillars are saved.  

3. **Email**  
   - All emails are sent via Mailhog.  

---

## 🖼️ API Flow Screenshots   

### 1. Verify Email Request (`/api/verify-email-request`)  
![Verify Email Request Response](screenshots/verify-and-get-user-detail-by-email.png)  

### 2. Verify OTP (`/api/verify-otp`)  
![Verify OTP Response](screenshots/verify-otp.png)  

### 3. Resend OTP (`/api/resend-otp`)  
![Resend OTP Response](screenshots/resend-otp.png)  

### 4. Save Wellness Interests (`/api/save-wellness-interests`)  
![Save Wellness Interests Response](screenshots/save-wellness-interests.png)  

### 5. Save Profile and Wellbeing Pillars (`/api/save-wellbeing-pillars`)  
![Save Wellbeing Pillars Response](screenshots/save-wellbeing-pillars.png)  

---

## ⚙️ Setup Instructions  

### 1. Clone Repo & Install Dependencies  
```bash
git clone <your-repo-url>
cd laravel-assignment
composer install
```

### 2. Setup Environment  
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with:  
- Database credentials  
- Mailhog configuration (for emails)  

### 3. Run Migrations  
```bash
php artisan migrate
```

### 4. Run Server  
```bash
php artisan serve
```
App runs at:  
`http://127.0.0.1:8001`

---

## Libraries / Tools Used  

- **Laravel 12** – PHP framework  
- **MySQL** – Database  
- **Laravel Validator** – Request validation  
- **Editor** – Visual Studio Code Editor  
- **Eloquent ORM** – Database ORM  
- **Laravel Mail** – OTP email sending  
- **Postman** – API testing  
- **Log channels** – Email logging  

---

## ✅ API Endpoints  

| Endpoint                        | Method | Description |
|---------------------------------|--------|-------------|
| `/api/invite`                   | POST   | Invite user & send Email |
| `/api/magic-link/user`          | GET   | Verify user & get user details |
| `/api/verify-email-request`     | POST   | Register user & send OTP |
| `/api/verify-otp`               | POST   | Verify OTP |
| `/api/resend-otp`               | POST   | Resend OTP after 3 min |
| `/api/save-profile`             | POST   | Save user profile data |
| `/api/save-wellness-interests`  | POST   | Save multiple wellness interests |
| `/api/save-wellbeing-pillars`   | POST   | Save 3 pillars with order & mark registration complete |
