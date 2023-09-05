@extends('layouts.app')
@section('title', 'Liste des articles')
@section('content')
<hr>
    <div class="row">
        <div class="col-12 pt-2">
            <a href="{{ route('blog.index')}}" class="btn btn-outline-primary btn-sm">Retourner</a>
            <h4 class="display-4 mt-5">
                {{ $blogPost->title }}
            </h4>
            <hr>
            <p>
                {!! $blogPost->body !!}
            </p>
            <p>
                <strong>Author: </strong> {{ $blogPost->user_id }}
            </p>
        </div>
    </div>
    <hr>
    <div class="row mb-5">
        <div class="col-6">
            <a href="{{route('blog.edit', $blogPost->id)}}" class="btn btn-primary">Mettre a jour</a>
        </div>
        <div class="col-6">
        <a href="" class="btn btn-danger">Effacer</a>
        </div>
    </div>
@endsection