@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <h3 class="text-dark mb-4">All Users</h3>
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Post ID</th>
                            <th>Post Title</th>
                            <th>First 100 character of Comment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $item)
                        <tr>
                            <td class="">{{$item->post->id}}<span class="ml-2 badge badge-primary"></span></td>
                            <td class="">{{$item->post->title}}<span class="ml-2 badge badge-primary"></span></td>
                            <td>{!! substr($item->comment, 0, 100)!!}</td>
                            <td class="">
                                <form class="" action="{{route('comment.destroy' , $item )}}" method="POSt">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delet</button>
                                </form>
                                <a href=""></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        {{$comments->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection