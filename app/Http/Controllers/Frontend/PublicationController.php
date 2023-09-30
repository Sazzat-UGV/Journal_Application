<?php

namespace App\Http\Controllers\Frontend;

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

    public function index(){
        $papers=Paper::with('category:id,category_name')->where('user_id',Auth::user()->id)->select('id','category_id','paper_title','author','email','abstract',"user_id",'file','created_at')->get();
        return view('Frontend.pages.publications.index',compact('papers'));
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
                        Paper::create([
                            'user_id' => Auth::user()->id,
                            'paper_title' => $request->paper_title,
                            'author' => $request->author,
                            'email' => $request->email,
                            'abstract' => $request->abstract,
                            'category_id' => $request->paper_area,
                            'file' => $fileName,
                        ]);
                        Toastr::success('Paper publish successfully.');
                        return redirect()->route('user.profile');
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
}
