<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentsController extends Controller
{
    public function store(Request $request, $slug)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $post = Post::where('slug', $slug)->firstOrFail();

        Comment::create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        return redirect("/blog/{$slug}")
            ->with('message', 'Your comment has been added!');
    }
}
