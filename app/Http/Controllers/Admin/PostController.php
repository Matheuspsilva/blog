<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(15);
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_active'] = true;

        $user = User::find(1);

        dd($user->posts()->create($data));

    }

    public function update($id, Request $request)
    {
        //Atualizando dados com mass assignment
        $data = $request->all();

        $post = Post::findOrFail($id);

        dd($post->update($data));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        dd($post->delete());
    }

}
