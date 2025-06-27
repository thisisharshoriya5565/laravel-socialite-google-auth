# 🔐 Laravel Socialite Google Auth

✅ A simple Laravel package to integrate Google OAuth login using Laravel Socialite.

---

## 🚀 Features

- 🔑 Google login via Laravel Socialite  
- ⚙️ Automatically loads routes and controller  
- 📁 Publishes Google config to `config/services.php`  
- ✅ Works with Laravel 8, 9, 10+

---

## 📦 Installation

### Option 1: Install from GitHub (recommended)

1. In your Laravel app's `composer.json`, add:
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/thisisharshoriya5565/laravel-socialite-google-auth"
    }
  ]
}
```


3. Require the package:
Run CLI ::
```bash
composer require thisisharshoriya5565/laravel-socialite-google-auth:dev-main
```

Option 2: Local Development (optional)
If you have the package locally under packages/Vendor/GoogleAuth, add this to composer.json:

```json
"repositories": [
          {
              "type": "path",
              "url": "packages/Vendor/GoogleAuth"
          }
      ]
```

Then :
```bash
composer require vendor/laravel-socialite-google-auth:dev-main
```

⚙️ Configuration
1. Add to .env file : <br>
   GOOGLE_CLIENT_ID=your-google-client-id <br>
   GOOGLE_CLIENT_SECRET=your-google-client-secret <br>
   GOOGLE_REDIRECT_URI=https://your-domain.com/google/callback <br>

2. (Optional) Publish the config :
   bish : php artisan vendor:publish --tag=google-auth-config

This will add the Google section to config/services.php. If it already exists, just manually merge the 'google' => [...] block.

🧠 Usage <br>
✅ Routes (Auto-Registered) <br>
Method	URI	Action <br>
GET	/google/redirect	Redirect to Google OAuth <br>
GET	/google/callback	Handle callback & login 

🔐 What happens after login?
Google user info is fetched using Socialite

User is created or updated with:
  1. name
  2. email
  3. google_id
  4. avatar

  Logged in using Auth::login()  
  Redirected to /dashboard or intended URL

  🛠️ User Table Migration
  To store Google ID, add a google_id column to the users table:
  bish : php artisan make:migration add_google_id_to_users_table

  Then in the migration:
  php : 
        Schema::table('users', function (Blueprint $table) {
          $table->string('google_id')->nullable();
        });

  Run the migration:  
  bish : php artisan migrate

🧪 Testing

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="b2code-app-origin" content="http://admin.b2code.in" />
    <meta name="google-redirect-url" content="{{ route('google.redirect') }}" />

    <title>Google Login</title>
</head>

<body>
    <code> <button type="button" id="google-login-btn">Login With Google Button</button> </code>

    <script src="http://admin.b2code.in/cdn/js/oauth-popup-login.obf.js" async defer></script>
    <script async defer>
        // google login/signup
        document.addEventListener("DOMContentLoaded", () => {
            const googleBtn = document.getElementById("google-login-btn");
            const redirectMeta = document.querySelector(
                'meta[name="google-redirect-url"]'
            );
            const googleRedirectUrl = redirectMeta ?
                redirectMeta.getAttribute("content") :
                "";

            if (!googleBtn || !googleRedirectUrl) {
                console.error("Missing Google login button or redirect URL.");
                return;
            }

            googleBtn.addEventListener("click", async () => {
                googleBtn.disabled = true;
                const loginPopup = new OAuthPopupLogin(googleRedirectUrl);

                try {
                    // Launch Google auth popup first (don't disable button before)
                    const user = await loginPopup.login();
                    console.log("✅ Google user:", user);

                    // Disable after successful popup to avoid double submission
                    googleBtn.disabled = true;

                    // const result = await window.auth.googleLogin(user);

                    // if (result.success) {
                    //     toastr.success(result.message || "Signed in successfully");
                    //     window.location.href = result.redirect_url || "/";
                    // } else {
                    //     toastr.error(result.error || "Signup failed");
                    // }
                } catch (error) {
                    console.error("❌ Login error:", error?.message || error);
                    toastr.error(error?.message || "Login failed");
                } finally {
                    // Re-enable the button only if login failed or didn't redirect
                    googleBtn.disabled = false;
                }
            });
        });
    </script>
</body>

</html>

After everything is configured:
bish : php artisan serve

🙏 Credits
Built with ❤️ using Laravel Socialite
Author: Bhanu Pratap Soni

📜 License
MIT © 2025 Bhanu Pratap Soni

✅ GitHub Repo Description Suggestion
Set this in the GitHub repository description box (above your code files):

cpp
🔐 Google Login Integration for Laravel using Socialite. Installs quickly, auto-registers routes, and supports Laravel 8/9/10+.

