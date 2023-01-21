@extends('layouts.dashboard')
@php
if (isset($posts[0])) {
    $trashed = $posts[0]->trashed() ? true : false;
}else {
    $trashed = false;
}
@endphp

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="clearfix">
                <a href="{{route('posts.create')}}" class="btn btn-success mb-3 float-right" style="text-decoration: none">Add Post</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </tbody>
                    @foreach ($posts as $item)
                            <tr>
                                <td class="col col-sm-2">
                                <img class="rounded-circle me-2" width="30" height="30" src="{{ $item->image_for_web }}">
                                </td>
                                <td class="col col-sm-6 {{($trashed)?'text-danger':''}} "> <a href="{{route('show.post' , $item->id)}}">{{$item->title}}</a> </td>

                                <td class="col col-sm-3 text-center">

                                    <form class="d-inline " action="{{route('posts.destroy' , $item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger sm">{{($trashed)?'Delete':'Trash'}}</button>
                                    </form>
                                    <a href="{{route('posts.edit', $item )}}" class="btn btn-primary sm">Edit</a>
                                    @if ($trashed)
                                    <a href="{{route('trashed.restore', $item )}}" class="btn btn-success sm">Restore</a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    <tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        @if (isset($posts[0]))
                            {{$posts->links()}}
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
