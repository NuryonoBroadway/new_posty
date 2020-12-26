<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()   {
        $this->middleware(['auth']);
    }

    public function index() {
        return view("posts.index", [
            'posts' => Post::latest()->with(['user','likes'])->paginate(2),
            'users' => User::get()
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            "body" => "required"
        ]);

        $request->user()->posts()->create($request->only('body'));
        return back();
    }

    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }

    public function edit(Request $request, Post $post) {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $post->update(['body' => $request->body ]);
        return redirect()->route('posts');
    }

    public function destroy(Post $post) {
        if(!$post->ownedBy(auth()->user())){
            dd('no');
        }

        $post->delete();

        return back();
    }
}
