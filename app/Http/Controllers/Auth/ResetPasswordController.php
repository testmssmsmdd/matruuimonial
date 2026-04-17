<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function showResetForm(Request $request, $token = null)
    {
        $email = $this->resolveEmailFromToken($token);

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => trans(Password::INVALID_TOKEN)]);
        }

        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $email = $this->resolveEmailFromToken($request->token);

        if (!$email) {
            return back()->withErrors(['email' => trans(Password::INVALID_TOKEN)]);
        }

        $status = Password::reset(
            [
                'email' => $email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'token' => $request->token,
            ],
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return $this->sendResetResponse($request, $status);
        }

        return $this->sendResetFailedResponse($request, $status);
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new PasswordReset($user));
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return redirect()->route('login')->with('status', 'Password updated successfully.');
    }

    private function resolveEmailFromToken(?string $plainToken): ?string
    {
        if (!$plainToken) {
            return null;
        }

        $passwordResetRows = DB::table('password_reset_tokens')->select('email', 'token')->get();

        foreach ($passwordResetRows as $row) {
            if (Hash::check($plainToken, $row->token)) {
                $userExists = User::where('email', $row->email)->exists();
                return $userExists ? $row->email : null;
            }
        }

        return null;
    }
}
