@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="clearfix">
                <a href="{{route('tags.create')}}" class="btn btn-success mb-3 float-right" style="text-decoration: none">Add Tag</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Tag Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                        <td class="col col-sm-2">{{$tag->name}}<span class="ml-2 badge    badge-primary">{{$tag->posts->count()}}</span>
                        </td>
                        <td class="col col-sm-2 text-center">
                            <form class="d-inline" action="{{route('tags.destroy' , $tag )}}" method="POSt">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delet</button>
                            </form>
                            <a href="{{route('tags.edit', $tag )}}" class="btn btn-primary">Edit</a>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        @if (isset($tags[0]))
                            {{$tags->links()}}
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
