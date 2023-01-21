

@extends('layouts.blog')
@section('cssfiles')
<link href="{{ asset('css/users/style.css') }}" rel="stylesheet">
@endsection

@section('them')
navbar-light
@endsection

@section('header')
    <header class="masthead" style="background-image:url('assets/img/home-bg.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                        <h1>Clean Blog</h1><span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8">
                @foreach ($posts as $post)
                    <div class="card mb-3">
                        <h5 class="card-header text-left">
                            <a href="{{route('publisher.profile', $post->user->id)}}">
                                 @if (str_contains($post->user->profile->image ?? ' ' , 'http://gravatar.com/avatar/'))
                                <img src="{{$post->user->profile->image}}" class="rounded mx-auto Custom-avatar ">
                                @else
                                <img src="{{ asset('storage/'. $post->user->profile->image ?? ' ')}}" class="rounded mx-auto Custom-avatar">
                                @endif
                                {{$post->user->name}}
                            </a>
                        </h5>
                        <div class="card-body text-center">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{$post->description}}</p>
                        <p class="card-text"><small class="text-muted">Last updated {{$post->updated_at->diffForHumans()}}</small></p>
                        </div>
                        <img class="card-img-top " src="{{ $post->image_for_web }}" style="height: 250px">
                        <a href="{{route('show.post' , $post )}}" class="btn btn-primary mt-2">View Content</a>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col offset-lg-4">
                        <nav>
                            <ul class="pagination">
                                {{$posts->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="clearfix">
            </div>
        </div>
    </div>
@endsection
