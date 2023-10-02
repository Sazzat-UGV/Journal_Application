<?php

namespace App\Http\Controllers\Frontend;

use view;
use App\Models\User;
use App\Models\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function homeSearch(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ]);

        $searchTerm = $request->search;

        $searchResult = Paper::with('user:id,name,student_id')
            ->where(function ($query) use ($searchTerm) {
                $query->where('paper_title', 'like', '%' . $searchTerm . '%');
            })
            ->select('id', 'paper_title', 'author','abstract', 'user_id', 'file', 'created_at')
            ->get();

        $years = $searchResult->pluck('created_at')->map(function ($date) {
            return $date->format('Y');
        })->unique();
        $count = $searchResult->count();
        return view('Frontend.pages.search.search', compact('count', 'years', 'searchTerm','searchResult'));
    }


    public function homeSearchGet(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ]);

        $searchTerm = $request->search;
        $selectedYears = $request->input('years', []);

        $query = Paper::with('user:id,name,student_id')
            ->where(function ($query) use ($searchTerm) {
                $query->where('paper_title', 'like', '%' . $searchTerm . '%');
            });

        if (!empty($selectedYears)) {
            $query->whereRaw('YEAR(created_at) IN (' . implode(',', $selectedYears) . ')');
        }

        $searchResult = $query->select('id','paper_title', 'author','abstract', 'user_id', 'file', 'created_at')
            ->get();

        $years = $searchResult->pluck('created_at')->map(function ($date) {
            return $date->format('Y');
        })->unique();
        $count = $searchResult->count();
        // return $searchResult;
        return view('Frontend.pages.search.search', compact('count', 'years', 'searchTerm', 'searchResult'));
    }


    public function publisherProfile($student_id) {
        $user=User::findOrFail($student_id);
        return view('Frontend.pages.search.publisher_profile',compact('user'));
    }
}
