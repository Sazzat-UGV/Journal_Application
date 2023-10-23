<?php

namespace App\Http\Controllers\Frontend;

use Image;
use App\Models\User;
use App\Models\Paper;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PublicationStoreRequest;
use Illuminate\Support\Facades\Response;

class PublicationController extends Controller
{

    public function index()
    {
        $papers = Paper::with('category:id,category_name')->where('user_id', Auth::user()->id)->select('id', 'category_id', 'paper_title', 'author', 'email', 'abstract', 'is_active','user_id','doi','file', 'image','created_at')->get();
        return view('Frontend.pages.publications.index', compact('papers'));
    }


    public function create()
    {
        $categories = Category::select('id', 'category_name')->get();
        return view('Frontend.pages.publications.create', compact('categories'));
    }


    public function store(PublicationStoreRequest $request)
    {
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            if ($file->getClientOriginalExtension() === 'pdf') {
                $user = Auth::user();
                $user_id = $user->id;
                $student_id = $user->student_id;

                $directory = 'uploads/student_document/' . $student_id;

                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0777, true);
                }

                $existingPDF = Paper::where('user_id', $user_id)->where('file', $fileName)->first();
                if ($existingPDF) {
                    Toastr::error('File already exist. Please rename the file');
                    return back();
                } else {
                    $upload = $file->move(public_path($directory), $fileName);
                    $filePath = public_path($directory . '/' . $fileName);
                    if (file_exists($filePath)) {
                        $paper=Paper::create([
                            'user_id' => Auth::user()->id,
                            'paper_title' => $request->paper_title,
                            'author' => $request->author,
                            'email' => $request->email,
                            'abstract' => $request->abstract,
                            'doi' => $request->doi,
                            'category_id' => $request->paper_area,
                            'file' => $fileName,
                        ]);
                        $this->image_upload($request, $paper->id);
                        Toastr::success('Paper publish successfully.');
                        return redirect()->route('user.PublicationIndex');
                    }
                }
            } else {
                Toastr::error("An error occur. Please try again");
                return back();
            }
        }
    }


    public function showPDF($user_id, $filename)
    {
        $student_id = User::where('id', $user_id)->pluck('student_id')->first();
        $filePath = public_path('uploads/student_document/' . $student_id . '/' . $filename);

        if (file_exists($filePath)) {
            return Response::file($filePath, ['Content-Type' => 'application/pdf']);
        } else {
            abort(404); // File not found
        }
    }


    public function paperActive($id)
    {
        $paper = Paper::findOrFail($id);
        if ($paper->is_active == 1) {
            $active = 0;
        } else {
            $active = 1;
        }
        $paper->update([
            'is_active'=>$active,
        ]);
        Toastr::success("Paper status change successfully");
        return back();
    }

    public function image_upload($request, $paper_id)
    {
        $paper = Paper::findorFail($paper_id);

        if ($request->hasFile('image')) {
            $photo_loation = 'public/uploads/paper/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = $paper->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(1024, 1024)->save(base_path($new_photo_location));
            $check = $paper->update([
                'image' => $new_photo_name,
            ]);
        }
    }
}
