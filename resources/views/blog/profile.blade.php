

@extends('layouts.blog')

@section('cssfiles')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
<link rel="stylesheet" href="{{asset('profile/fonts/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('css/users/style.css')}}">
@endsection

@section('header')
<header class="text-center text-white bg-primary masthead">
    <div class="container">
        @if (str_contains($user->profile->image ?? ' ' , 'http://gravatar.com/avatar/'))
        <img src="{{$user->profile->image}}" class="img-fluid d-block mx-auto mb-5 Profile-avatar2 ">
        @else
        <img src="{{ asset('storage/'. $user->profile->image ?? ' ')}}" class="img-fluid d-block mx-auto mb-5 Profile-avatar2">
        @endif
        <h1>{{$user->name}}</h1>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">{{$user->profile->about}}</h2>

        <div class="container mt-3" style="color: black">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="{{$user->profile->twitter}}">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{$user->profile->facebook}}">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="portfolio" class="portfolio">
    <div class="container">
        <h2 class="text-uppercase text-center text-secondary">Psots</h2>
        <hr class="star-dark mb-5">
    </div>
    @foreach ($posts as $post)
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-6">
                    <div class="card mt-3">
                        <div class="card-header">
                            @if (str_contains($user->profile->image ?? ' ' , 'http://gravatar.com/avatar/'))
                            <img src="{{$post->user->profile->image}}" class="rounded mx-auto Custom-avatar">
                            @else
                            <img src="{{ asset('storage/'. $post->user->profile->image ?? ' ')}}" class="rounded mx-auto Custom-avatar">
                            @endif
                            {{$user->name}}
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->description}}</p>
                            <p class="card-text"><small class="text-muted">Last updated {{$post->updated_at->diffForHumans()}}</small></p>
                        </div>
                            <img class="card-img-top " src="{{ $post->image_for_web}}" style="height: 250px">
                            <a href="{{route('show.post' , $post )}}" class="btn btn-primary ">View Content</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="container mt-5 m-auto">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6">
                {{$posts->links()}}
            </div>
        </div>
    </div>
</section>

@endsection
