@extends('layouts.app')

@section('content')

<form action="{{route('posts.update', ['post' => $post->id])}}" method="post">
    @csrf
    @method("PUT")

    <div class="form-group">
        <label for="">Título</label>
        <input name="title" type="text" class="form-control" value="{{$post->title}}">
    </div>

    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" name="description" class="form-control" value="{{$post->description}}">
    </div>

    <div class="form-group">
        <label for=""></label>
    <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$post->content}}</textarea>
    </div>

    <div class="form-group">
        <label for="">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{$post->slug}}">
    </div>

    <button class="btn btn-lg btn-success">Atualizar Postagem</button>

</form>
<hr>
<form action="{{route('posts.destroy',['post' => $post->id])}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-lg btn-danger">Remover Post</button>
</form>
@endsection
