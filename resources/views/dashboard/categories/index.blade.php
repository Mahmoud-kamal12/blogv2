@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header py-3">
            <div class="clearfix">
                <a href="{{route('categories.create')}}" class="btn btn-success mb-3 float-right" style="text-decoration: none">Add Category</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Categoriy</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $item)
                        <tr>
                            <td class="col col-sm-2">{{$item->name}}<span class="ml-2 badge badge-primary">{{$item->posts->count()}}</span>
                            </td>
                            <td class="col col-sm-2 text-center">
                                    <form class="d-inline" action="{{route('categories.destroy' , $item )}}" method="POSt">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delet</button>
                                    </form>

                                    <a href="{{route('categories.edit', $item )}}" class="btn btn-primary mr-3">Edit</a>
                            </td>
                          </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        @if (isset($posts[0]))
                            {{$categories->links()}}
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
