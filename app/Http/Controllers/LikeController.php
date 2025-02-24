<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePost($postId)
    {
        $user = Auth::user();
        $post = Post::findOrFail($postId);

        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->create(['user_id' => $user->id]);
        }

        return back()->with('success', 'Post liked!');
    }

    public function unlikePost($postId)
    {
        $user = Auth::user();
        $post = Post::findOrFail($postId);

        $post->likes()->where('user_id', $user->id)->delete();

        return back()->with('success', 'Post unliked!');
    }
}
