<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    //

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->latest()->paginate(4);
        return view('posts.index', compact('posts'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path('/storage/' . $imagePath))->fit(500,500);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->posts()->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $imagePath ?? ''
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }

    public function delete(Post $post) {
        Post::find($post->id)->delete();
        return redirect('/profile/' . auth()->user()->id);
    }

    public function edit(Post $post) {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post) {
        $post = Post::find($post->id);
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image'
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path('/storage/' . $imagePath))->fit(500,500);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        
        $post->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect('/profile/' . auth()->user()->id);
    }

}
