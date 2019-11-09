<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = Post::paginate(15);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $categories = \App\Category::all(['id','name']);

        return view('posts.edit', compact('post', 'categories'));
    }

    public function create()
    {
        $categories = \App\Category::all(['id','name']);

        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try{
            $data['is_active'] = true;

            $user = auth()->user();
    
            $post = $user->posts()->create($data);
            
            $post->categories()->sync($data['categories']);
    
            flash('Post criado com sucesso!')->success();
            return redirect()->route('posts.index');
        }catch(\Exception $e){
            $message = 'Erro ao remover cateogoria!';

            if(env('APP_DEBUG')){
                $message = $e->getMessage();
            }
            flash($message)->warning();
            return redirect()->back();
        }
   
    }

    public function update(Post $post, Request $request)
    {
        //Atualizando dados com mass assignment
        $data = $request->all();

        try{
            $post->update($data);

            $post->categories()->sync($data['categories']);

            flash('Postagem atualizada com sucesso!')->success();
            return redirect()->route('posts.show', ['post' => $post->id]);
            //return view('posts.show', ['post' => $post->id]);
        }catch(\Exception $e){

            $message = 'Erro ao remover post!';

            if(env('APP_DEBUG')){
                $message = $e->getMessage();
            }
            flash($message)->warning();
            return redirect()->back();

        }   
    }

    public function destroy(Post $post)
    {

        try{
            $post->delete();
            flash('Postagem removida com sucesso')->warning();
            return redirect()->route('posts.index');
        }catch(\Exception $e){
            if(env('APP_DEBUG')){
                $message = $e->getMessage();
            }

            flash($message)->warning();
            return redirect()->back();
        }

    }

}
