<?php

namespace Vendor\GoogleAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

// class GoogleController
// {
//     public function redirect()
//     {
//         return Socialite::driver('google')->redirect();
//     }

//     public function callback()
//     {
//         $googleUser = Socialite::driver('google')->stateless()->user();

//         $user = User::firstOrCreate([
//             'email' => $googleUser->getEmail(),
//         ], [
//             'name' => $googleUser->getName(),
//             'google_id' => $googleUser->getId(),
//             'avatar' => $googleUser->getAvatar(),
//         ]);

//         Auth::login($user);

//         return redirect()->intended('dashboard');
//     }
// }

class GoogleController extends Controller
{
    public function redirect(Request $request)
    {
        try {
            return Socialite::driver('google')->stateless()->redirect();
        } catch (\Throwable $th) {
            logger(["google-redirect-error" => $th]);
            return response()->json(['error' => 'Google redirect failed'], 500);
        }
    }

    // public function callback(Request $request)
    // {
    //     try {
    //         $googleUser = Socialite::driver('google')->stateless()->user();

    //         $response = [
    //             'success' => true,
    //             'user' => [
    //                 'id' => $googleUser->getId(),
    //                 'name' => $googleUser->getName(),
    //                 'email' => $googleUser->getEmail(),
    //                 'avatar' => $googleUser->getAvatar(),
    //                 'token' => $googleUser->token,
    //             ],
    //         ];

    //         return response()->view('auth.callback', compact('response'));
    //     } catch (\Throwable $th) {
    //         logger(["google-callback-error" => $th]);

    //         $response = [
    //             'success' => true,
    //             'error' => 'Google login failed: ' . $th->getMessage(),
    //         ];

    //         return response()->view('auth.callback', compact('response'));
    //     }
    // }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $response = [
                'success' => true,
                'user' => [
                    'id' => $googleUser->getId(),
                    'name' => $googleUser->getName() ?? $googleUser->getNickname(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'token' => $googleUser->token,
                ],
            ];
        } catch (\Throwable $th) {
            logger(["google-callback-error" => $th]);

            $response = [
                'success' => false,
                'error' => 'Google login failed: ' . $th->getMessage(),
            ];
        }

        // Return raw HTML with JS postMessage (NO Blade)
        $html = <<<HTML
            <!DOCTYPE html>
            <html>
            <head>
                <title>Google Callback</title>
            </head>
            <body>
            <script>
                window.opener.postMessage(
                    {$this->toJson($response)},
                    window.opener.location.origin
                );
                window.close();
            </script>
            </body>
            </html>
            HTML;

        return response($html, 200)->header('Content-Type', 'text/html');
    }

    private function toJson($data)
    {
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
    }
}


