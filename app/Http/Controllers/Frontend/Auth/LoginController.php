<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\UserRegistrationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registrationPage()
    {
        $departments = Department::where('is_active', 1)->select('id', 'full_name')->latest('id')->get();
        $semesters = Semester::where('is_active', 1)->select('id', 'semester_name')->get();
        return view('Frontend.pages.auth.registration', compact('departments', 'semesters'));
    }


    public function registration(UserRegistrationRequest $request)
    {
        User::create([
            'department_id' => $request->department_id,
            'semester_id' => $request->semester_id,
            'role_id' => 2,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'student_id' => $request->student_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);
        Toastr::success('Registration Complete');
        return redirect()->route('home.loginPage');
    }


    public function loginPage()
    {
        return view('Frontend.pages.auth.login');
    }


    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember')) && Auth::user()->is_active == 1) {
            $request->session()->regenerate();
            return redirect()->route('user.profile');
        }

        Toastr::error('You are not a valid user');
        return back();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.loginPage');
    }
}
