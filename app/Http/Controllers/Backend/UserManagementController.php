<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paper;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

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
        $papers = Paper::with('category:id,category_name', 'user:id,student_id')->where('user_id', $id)->select('id', 'paper_title', 'category_id', 'email', 'author', 'created_at', 'abstract', 'file', 'user_id')->latest('id')->get();
        return view('Backend.pages.user_management.view', compact('user', 'papers'));
    }


    public function destroy($id)
    {
        Gate::authorize('delete-user');
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('User deleted successfully');
        return back();
    }

    public function showPDF($user_id, $filename)
    {
        Gate::authorize('view-user-publications');
        $student_id = User::where('id', $user_id)->pluck('student_id')->first();
        $filePath = public_path('uploads/student_document/' . $student_id . '/' . $filename);

        if (file_exists($filePath)) {
            return Response::file($filePath, ['Content-Type' => 'application/pdf']);
        } else {
            abort(404); // File not found
        }
    }
}
