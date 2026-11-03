<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request, OtpService $otp): RedirectResponse
    {
        $existing = User::query()->where('email', $request->input('email'))->first();

        if ($existing?->email_verified_at) {
            return back()
                ->withErrors(['email' => 'This email is already registered. Please log in.'])
                ->withInput();
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:120', Rule::unique('users', 'email')->ignore($existing?->id)],
            'phone' => ['required', 'digits:10', Rule::unique('users', 'phone')->ignore($existing?->id)],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = $existing ?? new User;
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
        ])->save();

        $otp->send($user, Otp::REGISTER);
        $request->session()->put('otp.email', $user->email);
        $request->session()->put('otp.purpose', Otp::REGISTER);

        return redirect()
            ->route('verify')
            ->with('status', 'We sent a 6-digit code to your email.');
    }

    public function showVerify(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('otp.email')) {
            return redirect()->route('register');
        }

        if ($request->session()->get('otp.purpose') === Otp::RESET) {
            return redirect()->route('password.reset');
        }

        return view('auth.verify');
    }

    public function verify(Request $request, OtpService $otp): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $this->pendingUser($request);

        if (! $user || ! $otp->check($user, Otp::REGISTER, $data['code'])) {
            return back()->withErrors(['code' => 'That code is incorrect or expired.']);
        }

        $user->forceFill(['email_verified_at' => now()])->save();
        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->forget(['otp.email', 'otp.purpose']);

        return redirect()->route('profile.setup');
    }

    public function resend(Request $request, OtpService $otp): RedirectResponse
    {
        $user = $this->pendingUser($request);
        $purpose = (string) $request->session()->get('otp.purpose', Otp::REGISTER);

        if (! $user || ! in_array($purpose, [Otp::REGISTER, Otp::RESET], true)) {
            return redirect()->route('register');
        }

        $otp->send($user, $purpose);

        return back()->with('status', 'A new code has been sent.');
    }

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request, OtpService $otp): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()->where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return back()
                ->withErrors(['email' => 'These details do not match our records.'])
                ->onlyInput('email');
        }

        if (! $user->email_verified_at) {
            $otp->send($user, Otp::REGISTER);
            $request->session()->put('otp.email', $user->email);
            $request->session()->put('otp.purpose', Otp::REGISTER);

            return redirect()
                ->route('verify')
                ->with('status', 'Verify your email before you log in.');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function showForgot(): View
    {
        return view('auth.forgot');
    }

    public function sendReset(Request $request, OtpService $otp): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::query()->where('email', $data['email'])->first();

        if ($user) {
            $otp->send($user, Otp::RESET);
        }

        $request->session()->put('otp.email', $data['email']);
        $request->session()->put('otp.purpose', Otp::RESET);

        return redirect()
            ->route('password.reset')
            ->with('status', 'If that email is registered, we sent a code.');
    }

    public function showReset(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('otp.email')) {
            return redirect()->route('password.forgot');
        }

        if ($request->session()->get('otp.purpose') === Otp::REGISTER) {
            return redirect()->route('verify');
        }

        return view('auth.reset');
    }

    public function reset(Request $request, OtpService $otp): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required', 'digits:6'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = $this->pendingUser($request);

        if (! $user || ! $otp->check($user, Otp::RESET, $data['code'])) {
            return back()->withErrors(['code' => 'That code is incorrect or expired.']);
        }

        $user->update(['password' => $data['password']]);
        $request->session()->forget(['otp.email', 'otp.purpose']);

        return redirect()
            ->route('login')
            ->with('status', 'Password updated. You can log in.');
    }

    private function pendingUser(Request $request): ?User
    {
        $email = $request->session()->get('otp.email');

        if (! is_string($email)) {
            return null;
        }

        return User::query()->where('email', $email)->first();
    }
}
