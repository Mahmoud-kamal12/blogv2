@extends('layouts.dashboard')


@section('content')
@if (session()->has('addTag'))
<div class="alert alert-danger">
    {{session()->get('addTag')}}
</div>
@endif
<div class="d-flex justify-content-center">

<div class="card card-defalut" style="width: 70%">
    <div class="card-header">
        @isset($category)
            Update Tage
        @else
            Add new Tage
        @endisset
    </div>
    <div class="card-body">
        <div class="row px-3">
            <form  style="width: 80%" action="{{isset($tag)? route('tags.update', $tag ) : route('tags.store') }}  " method="POST">
                @csrf
                @isset($tag)
                    @method('PUT')
                @endisset

                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="@error('name') is-invalid @enderror form-control" id="categoryName" name="name" placeholder="Enter Tag Name" value="{{isset($tag)? $tag->name : ''}}">
                    <small id="categoryError" class="form-text text-muted">
                        @error('name')
                            {{$message}}
                        @enderror
                    </small>
                </div>
                <button type="submit" class="btn btn-success mt-3">
                    {{isset($tag)? "Update Tag" : "Add new Tag"}}
                </button>
            </form>
        </div>
    </div>
</div>

</div>

@endsection

