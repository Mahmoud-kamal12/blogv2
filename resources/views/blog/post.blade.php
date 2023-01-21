@extends('layouts.blog')
@section('them')
navbar-light
@endsection
@section('cssfiles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/users/style.css') }}" rel="stylesheet">
@endsection


@section('header')
    <header class="masthead" style="background-image:url('{{$post->image_for_web}}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative" style="overflow: hidden;">
                    <div class="post-heading">
                        <h1>{{$post->title}}</h1>
                        <h3>{{$post->description}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('article')
    <article>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto " style="overflow: auto;">
                    <p>{!! $post->content !!}</p>
                </div>
            </div>
        </div>
    </article>

    <div class="container mt-5">
        <h1 style="text-align: center; margin: 0px auto" >All Comments</h1>
        @foreach ($comments as $item)
                <div class="row justify-content-md-center">
                    <div class="col col-lg-6">
                        <div class="card mt-3">
                            <div class="card-header text-left">
                                <a href="{{route('publisher.profile', $item->user->id)}}">
                                @if (str_contains($item->user->profile->image ?? ' ' , 'http://gravatar.com/avatar/'))
                                    <img src="{{$post->user->profile->image}}" class="rounded mx-auto Custom-avatar ">
                                    @else
                                    <img src="{{ asset('storage/'. $post->user->profile->image ?? ' ')}}" class="rounded mx-auto Custom-avatar">
                                @endif
                                {{$item->user->name}}
                                </a>
                                @auth
                                @if($item->user->id == auth()->user()->id)
                                    <form class="" style="display: inline;float: right;" action="{{route('comment.destroy' , $item->id )}}" method="POSt">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><img src="https://img.icons8.com/ios-glyphs/30/null/delete.png"/> </button>
                                    </form>
                                @endif
                                @endauth
                            </div>

                            <div class="card-body text-center">
                                <p class="card-text">{!!$item->comment!!}</p>
                                <p class="card-text"><small class="text-muted">Last updated {{$item->updated_at->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>

    {{$comments->links()}}

    @auth
    <div class="row justify-content-md-center">
        <div class="col col-lg-6 "style="display: contents">
            <div class="card mt-3">
                <label for="title" style="margin: 5px auto">Add Comment</label>
                <div class="card mt-3">
                    <div class="card-header">
                        @if (str_contains(auth()->user()->profile->image ?? ' ' , 'http://gravatar.com/avatar/'))
                        <img src="{{$post->user->profile->image ?? ''}}" class="rounded mx-auto Custom-avatar">
                        @else
                        <img src="{{ asset('storage/'. auth()->user()->profile->image ?? ' ')}}" class="rounded mx-auto Custom-avatar">
                        @endif
                        {{auth()->user()->name}}
                    </div>
                    <div class="card-body" style="display: contents">
                        <form action="{{route('comment.store')}}" method="post" style="display: contents">
                            <input type="hidden" name="post_id" value="{{$post->id ?? ''}}">
                            @csrf

                            <div class="card-body">
                                <input id="x" type="hidden" name="comment" value = "">
                                <trix-editor input="x"></trix-editor>
                            </div>
                            <button style="submit" class="btn btn-primary m-2">Add Comment</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.selectttt').select2();
        });
    $(function(){
        $('#upload').change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        });
</script>
@endsection

