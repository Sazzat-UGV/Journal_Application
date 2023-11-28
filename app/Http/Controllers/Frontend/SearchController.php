<?php

namespace App\Http\Controllers\Frontend;

use view;
use App\Models\User;
use App\Models\Paper;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function homeSearch(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ]);

        $searchTerm = $request->search;

        $searchResult = Paper::with('user:id,name,student_id')->where('is_active', 1)
            ->where(function ($query) use ($searchTerm) {
                $query->where('paper_title', 'like', '%' . $searchTerm . '%');
            })
            ->select('id', 'paper_title', 'author', 'abstract', 'user_id', 'file', 'created_at', 'doi', 'image','publication_type')
            ->get();

        $years = $searchResult->pluck('created_at')->map(function ($date) {
            return $date->format('Y');
        })->unique();
        $count = $searchResult->count();
        return view('Frontend.pages.search.search', compact('count', 'years', 'searchTerm', 'searchResult'));
    }


    public function details($paper_id)
    {
        $result = Paper::with('user:id,name,student_id')->where('is_active', 1)
            ->where('id', $paper_id)
            ->select('id', 'paper_title', 'author', 'abstract', 'user_id', 'file', 'created_at', 'doi', 'image','publication_type')
            ->first();
        return view('Frontend.pages.search.search_details', compact('result'));
    }


    public function homeSearchGet(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ]);

        $searchTerm = $request->search;
        $selectedYears = $request->input('years', []);

        $query = Paper::with('user:id,name,student_id')
            ->where('is_active', 1)
            ->where(function ($query) use ($searchTerm) {
                $query->where('paper_title', 'like', '%' . $searchTerm . '%');
            });

        if (!empty($selectedYears)) {
            $query->whereRaw('YEAR(created_at) IN (' . implode(',', $selectedYears) . ')');
        }

        $searchResult = $query->select('id', 'publication_type','paper_title', 'author', 'abstract', 'user_id', 'doi', 'image', 'file', 'created_at')
            ->get();

        $years = $searchResult->pluck('created_at')->map(function ($date) {
            return $date->format('Y');
        })->unique();
        $count = $searchResult->count();
        // return $searchResult;
        return view('Frontend.pages.search.search', compact('count', 'years', 'searchTerm', 'searchResult'));
    }


    public function publisherProfile($student_id)
    {
        $user = User::findOrFail($student_id);
        $follower = Follower::where('followed_to', $user->student_id)->where('follow', 1)->count();
        $followed = null; // Initialize $followed as null.

        if (Auth::check()) {
            $followed = Follower::where('followed_by', Auth::user()->student_id)
                ->where('followed_to', $user->student_id)
                ->where('follow', 1)
                ->first();
        }

        $followedData = $followed ? $followed : null;

        return view('Frontend.pages.search.publisher_profile', compact(
            'user',
            'follower',
            'followedData'
        ));
    }

    public function follow($student_id)
    {
        $followed = Follower::where('followed_by', Auth::user()->student_id)
            ->where('followed_to', $student_id)
            ->first();

        if ($followed) {
            if ($followed->follow == 0) {
                $followed->update([
                    'follow' => 1,
                ]);
                Toastr::success("You are following..");
            } else {
                $followed->update([
                    'follow' => 0,
                ]);
                Toastr::success("You are no longer following..");
            }
        } else {
            Follower::create([
                'followed_to' => $student_id,
                'followed_by' => Auth::user()->student_id,
                'follow' => 1,
            ]);
            Toastr::success("You are following..");
        }

        return back();
    }


    public function unfollow($student_id)
    {
        $followed = Follower::where('followed_by', Auth::user()->student_id)->where('followed_to', $student_id)->first();
        $followed->update([
            'follow' => 0,
        ]);
        Toastr::success("You are unfollowing..");
        return back();
    }
}
