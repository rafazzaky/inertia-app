<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function index(){
        return Inertia::render('Topics/Index', [
            'topics' => Topic::all()->map(function($topic){
                return [
                    'id' => $topic->id,
                    'name' => $topic->name,
                    'image' => asset('storage/'. $topic->image)
                ];
            })
        ]);
    }

    public function create(){
        return Inertia::render('Topics/Create');
    }

    public function store(){
        $image = Request::file('image')->store('topics', 'public');
        Topic::create([
            'name' => Request::input('name'),
            'image' => $image
        ]);

        return Redirect::route('topics.index');
    }

    public function edit(Topic $topic){
        return Inertia::render('Topics/Edit', [
            'topic' => $topic,
            'image' => asset('storage/'. $topic->image)
        ]);
    }

    public function update(Topic $topic){
        $image = $topic->image;
        if(Request::file('image')){
            Storage::delete('public/'. $topic->image);
            $image = Request::file('image')->store('topics', 'public');
        }
        $topic->update([
            'name' => Request::input('name'),
            'image' => $image
        ]);

        return Redirect::route('topics.index');
    }

    public function destroy(Topic $topic){
        Storage::delete('public/'. $topic->image);
        $topic->delete();
    }
}
