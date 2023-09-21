<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name')}} - @yield('title')</title>
    <!--Bootstrap CSS CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            
            <a class="navbar-brand" href="#">Hello {{Auth::user() ? Auth::user()->name : 'Guest'}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                @guest
                    <a class="nav-link" href="{{route('user.create')}}">Registration</a>
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                @else
                    <a class="nav-link" href="{{route('user.list')}}">User List</a>
                
                    <a class="nav-link" href="{{route('blog.index')}}">Blog</a>
                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                @endguest
                      
            </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <h1 class="display-3 mt-2">
                    {{ config('app.name')}}
                </h1>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(!$errors->isEmpty())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @yield('content')
            </div>
        </div>
    </div>
</body>
    <!--Bootstrap JS CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>