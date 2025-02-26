<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    
        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = Auth::id();
        $comment->content = $request->content;
        $comment->save();
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    
    public function pin($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->pinned = !$comment->pinned; // Đảo trạng thái ghim
        $comment->save();
        return redirect()->back()->with('success', 'Comment pinned/unpinned successfully.');
    }
}