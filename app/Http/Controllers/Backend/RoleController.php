<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-role');
        $roles = Role::with(['permissions:id,permission_name,permission_slug'])->whereNotIn('id', [1, 2])->select('id', 'role_name', 'is_deleteable', 'updated_at')->latest('id')->get();
        return view('Backend.pages.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-role');
        $modules = Module::with(['permissions:id,permission_name,permission_slug,module_id'])->select('id', 'module_name')->get();
        return view('Backend.pages.role.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleCreateRequest $request)
    {
        Gate::authorize('create-role');
        Role::updateOrCreate([
            'role_name' => $request->role_name,
            'role_slug' => Str::slug($request->role_name),
            'role_note' => $request->role_note,
        ])->permissions()->sync($request->input('permissions', []));

        Toastr::success('Role created successfully');
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-role');
        $role = Role::with('permissions')->find($id);
        $modules = Module::with(['permissions:id,permission_name,permission_slug,module_id'])->select('id', 'module_name')->get();
        return view('Backend.pages.role.edit', compact('role', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-role');
        $role = Role::find($id);
        $role->update([
            'role_name' => $request->role_name,
            'role_slug' => Str::slug($request->role_name),
            'role_note' => $request->role_note,
        ]);
        $role->permissions()->sync($request->input('permissions', []));
        Toastr::success('Role updated successfully');
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('edit-role');
        $role = Role::find($id);
        if ($role->user()->count() > 0) {
            Toastr::error("Role cann't be deleted because it contains user");
            return redirect()->route('role.index');
        }
        if ($role->is_deleteable) {
            $role->delete();
            Toastr::success('Role deleted successfully');
            return redirect()->route('role.index');
        }
    }
}
