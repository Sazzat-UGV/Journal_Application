<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;

class SystemAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-admin');
        $admins = User::with('role:id,role_name')->whereNotIn('role_id', [1, 2])->select('id', 'name', 'image', 'role_id', 'email', 'is_active', 'updated_at')->latest('id')->get();
        return view('Backend.pages.system_admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-admin');
        $roles = Role::select('id', 'role_name')->whereNotIn('id', [1, 2])->get();
        return view('Backend.pages.system_admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCreateRequest $request)
    {
        Gate::authorize('create-admin');
        User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Toastr::success('Admin created successfully');
        return redirect()->route('systemadmin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('view-admin');
        $user = User::with('role:id,role_name')->whereId($id)->first();
        return view('Backend.pages.system_admin.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-admin');
        $admin = User::findorFail($id);
        $roles = Role::select('id', 'role_name')->whereNotIn('id', [1, 2])->get();
        return view('Backend.pages.system_admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-admin');
        $admin = User::findorFail($id);
        $admin->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Toastr::success('Admin update successfully');
        return redirect()->route('systemadmin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-admin');
        $user = User::find($id);
        $user->delete();
        Toastr::success('Admin delete successfully');
        return redirect()->route('systemadmin.index');
    }


    public function changeStatus(string $id)
    {
        $user = User::find($id);
        if ($user->is_active == 1) {
            $user->is_active = 0;
        } else {
            $user->is_active = 1;
        }
        $user->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
