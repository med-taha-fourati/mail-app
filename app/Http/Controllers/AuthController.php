<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // make the checks necessary
        if (auth()->check()) {
            return to_route('mail.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $userInfo = User::where('email', '=', $request->email)->first();
        auth()->attempt($request->only('email', 'password'));
        if (!$userInfo) {
            return back()->with('fail', 'We do not recognize your email address');
        } else {
            $request->session()->regenerate();
            if (password_verify($request->password, $userInfo->password)) {
                $request->session()->put('LoggedUser', $userInfo->id);
                return to_route('mail.dashboard');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }

    public function logout(Request $request) {
        if ($request->session()->has('LoggedUser')) {
            $request->session()->pull('LoggedUser');
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return to_route('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->remember_token = Str::random(10);
        $save = $user->save();

        if ($save) {
            return to_route('auth.login')->with('success', 'New user has been successfully created! You may now login.');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
