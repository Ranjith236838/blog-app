<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    //
    public function index(User $user) {
        $profile = Profile::find($user->id);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postsCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30), function() use ($user) {
            return $user->posts->count();
        });

        $is_following = ($user->following->contains($user->id)) ? true : false;
        // dd($is_following);

        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count();

        return view('profiles.index', compact('user', 'profile', 'follows','postsCount', 'followersCount', 'followingCount', 'is_following'));
    }

    public function edit(User $user) {

        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {
        $this->authorize('update', $user->profile);
        
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required', 
            'url'=> 'url',
            'image' => 'image'
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            // dd(public_path('/storage/'. $imagePath));
            $image = Image::make(public_path('/storage/' . $imagePath))->fit(500,500);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));

        return redirect('/profile/' . $user->id);
    }
}
