Laravel Socialite Google Auth
✅ A simple Laravel package to integrate Google OAuth login using Laravel Socialite.

🚀 Features
Google login via Laravel Socialite

Auto-loads routes and controller

Publishes Google config to config/services.php

Works with Laravel 8/9/10+

📦 Installation
1. Install via Composer
If your package is local (in packages/Vendor/GoogleAuth):

bash
Copy
Edit
composer require vendor/laravel-socialite-google-auth:dev-main
Or if hosted in GitHub:

json
Copy
# composer.json
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/vendor/laravel-socialite-google-auth"
  }
]
Then:

bash
Copy
composer require vendor/google-auth:dev-main
⚙️ Configuration
1. Add to .env:
env
Copy
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=https://your-domain.com/auth/google/callback
2. Publish config (optional):
bash
Copy
Edit
php artisan vendor:publish --tag=google-auth-config
🧠 Usage
1. Routes Automatically Added
php
Copy
Edit
GET /auth/google              // Redirects to Google
GET /auth/google/callback     // Handles the callback
2. After successful login
A User is created/updated with:

name

email

google_id

avatar

Authenticated via Auth::login()

Redirected to /dashboard or previous page

🛠️ User Table Migration
Add google_id to your users table:

bash
Copy
Edit
php artisan make:migration add_google_id_to_users_table
In the migration file:

php
Copy
Edit
$table->string('google_id')->nullable();
Then:

bash
Copy
Edit
php artisan migrate
🧪 Testing
Visit:

bash
Copy
Edit
http://localhost:8000/auth/google
🙏 Credits
Built with ❤️ using Laravel Socialite

📜 License
MIT © [Your Name or Company]

✅ Optional: GitHub Repo Description Box
Set this in your GitHub repository's description (top bar):

arduino
Copy
Edit
🔐 Google Login Integration for Laravel using Socialite. Installs quickly, auto-registers routes, and
