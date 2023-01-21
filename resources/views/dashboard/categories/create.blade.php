@extends('layouts.dashboard')


@section('cssfiles')

<link href="{{ asset('css/categories/create.css') }}" rel="stylesheet">

@endsection


@section('content')
@if (session()->has('addCategory'))
<div class="alert alert-danger">
    {{session()->get('addCategory')}}
</div>
@endif
<div class="d-flex justify-content-center">

<div class="card card-defalut" style="width: 70%">
    <div class="card-header">
        @isset($category)
            Update category
        @else
            Add new category
        @endisset
    </div>
    <div class="card-body">
        <div class="row px-3">
            <form  style="width: 80%" action="{{isset($category)? route('categories.update', $category ) : route('categories.store') }}  " method="POST">
                @csrf

                @isset($category)
                    @method('PUT')
                @endisset

                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="@error('name') is-invalid @enderror form-control" id="categoryName" name="name" placeholder="Enter Category Name" value="{{isset($category)? $category->name : ''}}">
                    <small id="categoryError" class="form-text text-muted">
                        @error('name')
                            {{$message}}
                        @enderror
                    </small>
                </div>
                <button type="submit" class="btn btn-success mt-2">
                    {{isset($category)? "Update category" : "Add new category"}}
                </button>
            </form>
        </div>
    </div>
</div>

</div>

@endsection

