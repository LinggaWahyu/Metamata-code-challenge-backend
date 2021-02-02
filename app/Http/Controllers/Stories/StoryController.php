<?php

namespace App\Http\Controllers\Stories;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::latest()->get();

        return view('home', [
            'stories' => $stories
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:50',
            'description' => 'required|string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            toastr()->error('Please Check Your Form Valu Again !', 'Error');
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = Auth::user();
        $data['user_id'] = $user->id;

        Story::create($data);
        
        toastr()->success('Story Successfully Posted', 'Success');
        return redirect()->route('home');
    }

    public function my_stories()
    {
        $user = Auth::user();
        $stories = Story::where('user_id', $user->id)->latest()->get();

        return view('home', [
            'stories' => $stories
        ]);
    }

    public function like($id)
    {
        $story = Story::find($id);

        $story->fill([
            'total_like' => $story->total_like + 1
        ]);
        $story->save();
        
        toastr()->success('Liked !');
        return redirect()->back();
    }
}
