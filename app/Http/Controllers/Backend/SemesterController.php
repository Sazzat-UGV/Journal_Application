<?php

namespace App\Http\Controllers\Backend;

use App\Models\Semester;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-semester');
        $semesters = Semester::select('id', 'semester_name', 'slug', 'is_active', 'created_at')->get();
        return view('Backend.pages.semester.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-semester');
        return view('Backend.pages.semester.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-semester');
        $request->validate([
            'semester_name' => 'required|string|unique:semesters'
        ]);
        Semester::create([
            'semester_name' => $request->semester_name,
            'slug' => Str::slug($request->semester_name),
        ]);
        Toastr::success('Semester created successfully');
        return redirect()->route('semester.index');
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
    public function edit(string $slug)
    {
        Gate::authorize('edit-semester');
        $semester = Semester::findOrFail($slug);
        return view('Backend.pages.semester.edit', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        Gate::authorize('edit-semester');
        $request->validate([
            'semester_name' => 'required|string'
        ]);
        $semester = Semester::findOrFail($slug);
        $semester->update([
            'semester_name' => $request->semester_name,
            'slug' => Str::slug($request->semester_name),
        ]);
        Toastr::success('Semester updated successfully');
        return redirect()->route('semester.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        Gate::authorize('delete-semester');
        $semester = Semester::findOrFail($slug);
        Toastr::success('Semester deleted successfully');
        return redirect()->route('semester.index');
    }


    public function changeStatus(string $id)
    {
        $semester = Semester::find($id);
        if ($semester->is_active == 1) {
            $semester->is_active = 0;
        } else {
            $semester->is_active = 1;
        }
        $semester->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
