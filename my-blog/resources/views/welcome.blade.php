@extends('layouts.app')
@section('title', 'Welcome')
@section('content')

            <p>
                Bienvenu au Blogue
            </p>
            <a href="{{route('blog.index')}}" class="btn btn-outline-primary">Afficher les articles</a>

@endsection
