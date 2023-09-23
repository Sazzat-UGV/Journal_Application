<?php

namespace App\Http\Controllers\backend;

use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-department');
        $departments = Department::select('id', 'name', 'slug', 'full_name', 'is_active', 'updated_at')->latest('id')->get();
        return view('Backend.pages.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-department');
        return view('Backend.pages.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentStoreRequest $request)
    {
        Gate::authorize('create-department');
        Department::create([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'slug' => Str::slug($request->name),
        ]);
        Toastr::success('Department added successfully');
        return redirect()->route('department.index');
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
        Gate::authorize('edit-department');
        $department = Department::whereId($id)->first();
        return view('backend.pages.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-department');
        $department = Department::whereId($id)->first();
        $department->update([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'slug' => Str::slug($request->name),
        ]);

        Toastr::success('Department update successfully');
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-department');
        $department = Department::whereId($id)->first();
        $department->delete();

        Toastr::success('Department delete successfully');
        return back();
    }


    public function changeStatus(string $id)
    {
        $department = Department::find($id);
        if ($department->is_active == 1) {
            $department->is_active = 0;
        } else {
            $department->is_active = 1;
        }
        $department->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
