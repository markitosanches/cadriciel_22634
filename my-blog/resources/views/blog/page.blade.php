@extends('layouts.app')
@section('title', 'Pagination')
@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogPosts as $blogPost)
                    <tr>
                        <td>{{ $blogPost->id}}</td>
                        <td>{{ $blogPost->title}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogPosts }}
    </div>
</div>
@endsection