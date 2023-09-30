<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Paper;
use App\Models\Category;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function dashboard(){
        Gate::authorize('access-dashboard');

        $department=Department::count();
        $semester=Semester::count();
        $admin=User::whereNot('role_id',2)->count();
        $user=User::where('role_id',1)->count();
        $publication=Paper::count();
        $category=Category::count();

        return view('Backend.pages.dashboard',compact(
            'department',
            'semester',
            'admin',
            'user',
            'publication',
            'category',
        ));
    }
}
