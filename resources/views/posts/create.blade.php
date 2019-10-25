@extends('layouts.app')

@section('content')

<form action="{{route('posts.store')}}" method="post">
    @csrf

    <div class="form-group">
        <label for="">Título</label>
        <input type="text" name="title" class="form-control" value="">
    </div>

    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" name="description" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Conteúdo</label>
        <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Categorias</label>
        <div class="row">
            @foreach($categories as $c)
                <div class="col-2 checkbox">
                    <label>
                    <input type="checkbox" name="categories[]" value="{{$c->id}}"> 
                        {{$c->name}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        <label for="">Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>

    <button class="btn btn-lg btn-success">Criar Postagem</button>

</form>
@endsection

