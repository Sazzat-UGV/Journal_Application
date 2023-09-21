<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdministrationProfileUpdateRequest;
use App\Http\Requests\UserImageUploadRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

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


    public function profilePage()
    {
        return view('Backend.pages.admin.profile');
    }


    public function changeProfilePage()
    {
        return view('Backend.pages.admin.change_profile');
    }

    public function changeProfile(AdministrationProfileUpdateRequest $request, $id)
    {
        $user = User::findorFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        Toastr::success('Your profile has been updated');
        return redirect()->route('admin.profilePage');
    }


    public function saveImage(UserImageUploadRequest $request, $id)
    {
        $user = User::whereId($id)->first();
        $user->update([]);
        $this->image_upload($request, $user->id);
        Toastr::success('Your profile image has been updated');
        return back();
    }


    public function image_upload($request, $user_id)
    {
        $user = User::findorFail($user_id);

        if ($request->hasFile('user_image')) {
            $photo_loation = 'public/uploads/user/';
            $uploaded_photo = $request->file('user_image');
            $new_photo_name = $user->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(200, 200)->save(base_path($new_photo_location), 40);
            $check = $user->update([
                'image' => $new_photo_name,
            ]);
        }
    }
}
