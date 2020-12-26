<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function store(Request $request, Post $post){
        $post->comments()->create([
            'user_id' => $request->user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);

        return back();
    }

    public function destroy(Comment $comment, Request $request) {
        $comment->delete();
        return back();
    }
}
