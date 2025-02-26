<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{



     // Hiển thị form tạo bài viết
    public function create()
    {
        return view('posts.create');
    }





    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Upload image nếu có
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }
    
        // Tạo bài viết
        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $path,
        ]);
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }
    






    // Danh sách bài viết
    public function index()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->latest()->get();
    
        return view('posts.index', compact('user', 'posts'));
    }
    
    




    public function home()
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập hoặc đăng ký nếu chưa có tài khoản');
        }
    
        $posts = Post::where('user_id', $user->id)->latest()->get();
    
        return view('home', compact('user', 'posts'));
    }
    

    



    // Xóa bài viết
    public function destroy(Post $post)
    {
        // Kiểm tra quyền xóa bài viết
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Xóa ảnh nếu có
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }






    // Chỉnh sửa post
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $path = $post->image; // Giữ đường dẫn ảnh cũ nếu không có ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            $path = $request->file('image')->store('images', 'public'); // Lưu ảnh mới
        }

        // Cập nhật bài viết
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function show($id)
    {
        $post = Post::with(['comments', 'likes'])->findOrFail($id); // Lấy bài viết kèm comments và likes
        return view('posts.show', compact('post'));
    }
}
