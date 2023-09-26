<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class UserManagementController extends Controller
{
    public function index()
    {
        Gate::authorize('index-user');
        $users = User::with('department:id,name')->where('role_id', 2)->select('id', 'student_id', 'name', 'image', 'department_id', 'created_at', 'is_active')->latest('id')->get();
        return view('Backend.pages.user_management.index', compact('users'));
    }


    public function view($id)
    {
        Gate::authorize('view-user-profile');
        $user = User::with('semester:id,semester_name', 'department:id,full_name')->where('id', $id)->first();
        return view('Backend.pages.user_management.view', compact('user'));
    }


    public function destroy($id)
    {
        Gate::authorize('delete-user');
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('User deleted successfully');
        return back();
    }
}
