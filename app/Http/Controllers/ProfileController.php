<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SocialLink;

class ProfileController extends Controller
{



    // Hiển thị form chỉnh sửa hồ sơ cá nhân
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }






    // Cập nhật thông tin profile
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only([
            'name', 
            'bio', 
            'birthdate', 
            'gender'
        ]));
    
        // Xử lý upload avatar
        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:4096', // Max 4MB
            ]);
    
            $avatarFile = $request->file('avatar');
            $avatarName = time() . '_' . $avatarFile->getClientOriginalName();
            $path = $avatarFile->storeAs('public/avatars', $avatarName);
    
            // Đường dẫn avatar trong database
            $user->profile_picture = str_replace('public/', '', $path);
            $user->save();
        }
    


        // Social links
        SocialLink::where('user_id', $user->id)->delete();
        foreach ($request->input('social_links', []) as $link) {
            if (!empty($link['link_text']) && !empty($link['link_url'])) {
                SocialLink::create([
                    'user_id' => $user->id,
                    'link_text' => $link['link_text'],
                    'link_url' => $link['link_url'],
                ]);
            }
        }
    
        return redirect()->route('home')->with('success', 'Profile updated successfully!');
    }



    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%{$query}%")->get();
        return view('users.search_results', compact('users'));
    }


    
    public function show($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        $posts = Post::where('user_id', $user->id)->get();

        return view('profile', compact('user','posts'));
    }
    
}
