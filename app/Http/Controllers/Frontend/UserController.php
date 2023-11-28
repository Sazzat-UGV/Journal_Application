<?php

namespace App\Http\Controllers\Frontend;

use Image;
use App\Models\User;
use App\Models\Follower;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function profile()
    {
        $follower = Follower::where('followed_to', Auth::user()->student_id)->where('follow', 1)->count();
        return view('Frontend.pages.user.profile', compact('follower'));
    }

    public function editProfilePage()
    {
        $departments = Department::where('is_active', 1)->select('id', 'full_name')->latest('id')->get();
        $semesters = Semester::where('is_active', 1)->select('id', 'semester_name')->get();
        return view('Frontend.pages.user.edit_profile', compact('departments', 'semesters'));
    }


    public function editProfile(UserUpdateRequest $request, $id)
    {

        $user = User::findOrFail($id);
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "department_id" => $request->department_id,
            "semester_id" => $request->semester_id,
        ]);
        Toastr::success('Your profile has been updated');
        return redirect()->route('user.profile');
    }


    public function editProfileimage(Request $request, $id)
    {
        $validate = $request->validate([
            'user_image' => 'required|image|max:10240',
        ]);
        $user = User::findOrFail($id);
        $user->update([]);
        $this->image_upload($request, $user->id);
        Toastr::success('Your profile image has been updated');
        return back();
    }


    public function image_upload($request, $user_id)
    {
        $user = User::findorFail($user_id);

        if ($request->hasFile('user_image')) {
            if ($user->image != 'default_user.jpg') {
                // Delete old photo
                $photo_location = 'public/uploads/user/';
                $old_photo_location = public_path($photo_location . $user->image);

                // Check if the old photo file exists before attempting to delete
                if (file_exists($old_photo_location)) {
                    unlink($old_photo_location);
                }
            }
            $photo_loation = 'public/uploads/user/';
            $uploaded_photo = $request->file('user_image');
            $new_photo_name = $user->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(512, 512)->save(base_path($new_photo_location), 40);
            $check = $user->update([
                'image' => $new_photo_name,
            ]);
        }
    }


    public function changePasswordPage()
    {
        return view('Frontend.pages.user.change_password');
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
            return redirect()->route('home.loginPage');
        } else {
            Toastr::error('Current password does not match with old password');
            return back();
        }
    }
}
