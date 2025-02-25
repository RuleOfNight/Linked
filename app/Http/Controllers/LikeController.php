<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    // Xử lý like bài post
    public function like($id)
    {
        $post = Post::findOrFail($id);

        // Check nếu đã like tránh buff bẩn
        $existingLike = Like::where('user_id', auth()->id())
                            ->where('post_id', $id)
                            ->first();

        if (!$existingLike) {
            $like = new Like();
            $like->user_id = auth()->id();
            $like->post_id = $id;
            $like->save();
        }

        return redirect()->back()->with('success', 'Post liked!');
    }

}