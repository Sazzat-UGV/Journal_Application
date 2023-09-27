<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-category');
        $categories=Category::select('id','category_name','category_slug','is_active','created_at')->latest('id')->get();
        return view('Backend.pages.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-category');
        return view('Backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-category');
        $validate=$request->validate([
            'category_name'=>'required|string|max:255',
        ]);
        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);
        Toastr::success('Category created successfully');
        return redirect()->route('category.index');
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
        Gate::authorize('edit-category');
        $category= Category::findOrFail($id);
        return view('Backend.pages.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-category');
        $category= Category::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);
        Toastr::success('Category updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-category');
        $category= Category::findOrFail($id);
        $category->delete();
        Toastr::success('Category deleted successfully');
        return redirect()->route('category.index');
    }


    public function changeStatus(string $id)
    {
        $category = Category::find($id);
        if ($category->is_active == 1) {
            $category->is_active = 0;
        } else {
            $category->is_active = 1;
        }
        $category->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
