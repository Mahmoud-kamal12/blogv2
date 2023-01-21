@extends('layouts.dashboard')

@section('cssfiles')
<link href="{{ asset('css/users/style.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <h3 class="text-dark mb-4">All Comments</h3>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Post Title</th>
                            <th>First 100 character of Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td class="col col-sm-2">
                            @if (str_contains($item->profile->image ?? ' ' , 'http://gravatar.com/avatar/'))
                            <img src="{{$item->profile->image}}" class="rounded mx-auto d-block Custom-avatar">
                            @else
                            <img src="{{ asset('storage/'. $item->profile->image ?? ' ')}}" class="rounded mx-auto d-block Custom-avatar">
                            @endif
                            </td>
                            <td class="col col-sm-6 ">{{$item->name}}</td>

                            <td class="col col-sm-3">
                                @if (!$item->IsAdmin())
                                <form class="d-inline text-center " action="{{route('users.make-admin' , $item->id)}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-success sm">Make Admin</button>
                                </form>
                                @else
                                {{$item->role}}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        {{$users->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
