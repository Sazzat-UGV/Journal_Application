<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function changePasswordPage()
    {
        return view('Backend.pages.admin.change_password');
    }


    public function changePassword(Request $request)
    {
        $validation = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|min:8|same:confirm_password'
        ]);

        $current_user_password = Hash::check($request->old_password, auth()->user()->password);

        if ($current_user_password) {
            User::findorFail(Auth::user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            Auth::logout();
            Toastr::success('Password updated successfully');
            return redirect()->route('admin.loginPage');
        } else {
            Toastr::error('Current password does not match with old password');
            return back();
        }
    }
}
