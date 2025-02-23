<?php

namespace App\Http\Controllers;

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













    
}
