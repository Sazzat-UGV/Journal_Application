<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-publication');
        $papers = Paper::with('category:id,category_name', 'user:id,student_id,name')->select('id', 'paper_title', 'publication_type','category_id', 'email', 'author', 'created_at', 'abstract', 'file', 'user_id','doi','image')->latest('id')->get();
        return view('Backend.pages.publicaition.index',compact('papers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showPDF($user_id, $filename)
    {
        Gate::authorize('view-publication');
        $student_id = User::where('id', $user_id)->pluck('student_id')->first();
        $filePath = public_path('uploads/student_document/' . $student_id . '/' . $filename);

        if (file_exists($filePath)) {
            $fileType = mime_content_type($filePath);

            if ($fileType == 'application/pdf') {
                return response()->file($filePath, ['Content-Type' => 'application/pdf']);
            } elseif ($fileType == 'application/zip') {
                // If the file is a ZIP, force download
                return response()->download($filePath, $filename, ['Content-Type' => 'application/zip']);
            } else {
                // Unsupported file type
                abort(404);
            }
        } else {
            abort(404); // File not found
        }
    }
}
