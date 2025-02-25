<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function comment(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->post_id = $id;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment added!');
    }
}