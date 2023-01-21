@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a class="text-decoration-none" href="{{route('posts.create')}}">{{__('my posts')}}</a>
                            <span class="badge bg-primary rounded-pill">{{$count}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">
                    @foreach($posts as $post)
                        <div class="card mb-2" style="width: 100%;">
                            <img src="{{$post->image_for_web}}" class="card-img-top" alt="..." width="100" height="200">
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p class="card-text">Author : {{$post->user->name}}</p>
                                <a href="{{route('posts.show' , $post->id)}}" class="btn btn-primary">Show More</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer d-flex align-content-center text-center justify-content-center">
                    {{$posts->links()}}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
