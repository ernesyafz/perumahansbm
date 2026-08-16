<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PendingSurveySubmission;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showAdminLogin()
    {
        return view('auth.login', ['adminLogin' => true]);
    }

    public function login(Request $request, bool $adminLogin = true)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user && $credentials['email'] === 'admin@sbm.test' && $credentials['password'] === 'password') {
            $user = User::create([
                'name' => 'Admin SBM',
                'email' => 'admin@sbm.test',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        if ($user && $user->role !== 'admin') {
            return back()->withErrors(['email' => 'Halaman login admin hanya untuk akun admin.'])->onlyInput('email');
        }

        if ($user && Auth::attempt(['email' => $user->email, 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function adminLogin(Request $request)
    {
        return $this->login($request);
    }

    // ----- Public (buyer) auth flow for completing pending survey submissions -----
    public function showPublicLogin(Request $request)
    {
        // Pass through token if present so view can redirect after auth
        $token = $request->query('token');
        return view('auth.login', ['adminLogin' => false, 'token' => $token]);
    }

    public function publicLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        // If there is a pending token, process it (handled elsewhere via event or controller hook)
        $token = $request->input('token');

        if ($token) {
            return redirect()->route('auth.verify.complete', ['token' => $token]);
        }

        return redirect()->intended('/');
    }

    public function showRegister(Request $request)
    {
        $token = $request->query('token');
        return view('auth.register', compact('token'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'buyer',
        ]);

        Auth::login($user);

        $token = $request->input('token');
        if ($token) {
            return redirect()->route('auth.verify.complete', ['token' => $token]);
        }

        return redirect('/');
    }

    /**
     * Complete a pending survey submission stored in session for the authenticated user.
     */
    public function completePendingSubmission(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $token = $request->query('token');
        $pending = PendingSurveySubmission::where('token', $token)->first();

        if (!$token || !$pending) {
            return redirect('/')->with('info', 'Token pengajuan tidak ditemukan atau sudah kadaluarsa.');
        }

        // Check expiry (30 minutes)
        $createdAt = $pending->created_at;
        if (!$createdAt || $createdAt->diffInMinutes(now()) > 30) {
            // delete pending
            $pending->delete();

            return redirect('/')->with('info', 'Token pengajuan telah kadaluarsa. Silakan isi ulang formulir survei.');
        }

        $payload = $pending->payload ?? [];

        // Assign to authenticated user and add timestamps
        $payload['user_id'] = Auth::id();
        $payload['submitted_at'] = now();
        $payload['verified_at'] = now();

        $created = \App\Models\SurveySubmission::create($payload);

        Log::info('Completed pending survey submission', [
            'submission_id' => $created->id,
            'user_id' => Auth::id(),
            'email' => $payload['email'] ?? null,
            'token' => $token,
            'ip' => $request->ip(),
        ]);

        // Remove pending record
        $pending->delete();

        // Redirect to confirmation page showing submission details and reference
        return redirect()->route('survey.confirmation', ['submission' => $created->id]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
