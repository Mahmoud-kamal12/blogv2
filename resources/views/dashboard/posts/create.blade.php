@extends('layouts.dashboard')


@section('cssfiles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection


@section('content')
<div class="d-flex justify-content-center">
    <div class="card card-defalut" style="width: 71%">
        <div class="card-header">{{isset($post)?'Edit Post' : 'Add new post'}}</div>
        <div class="card-body">
            <div class="row px-3">

                <form  style="width: 80%" action="{{(isset($post)? route('posts.update' , $post) : route('posts.store'))}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @if (isset($post))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif


                    <div class="form-group">
                        <label class="mb-2 mt-2" for="title">Post Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter post Title" value = "{{isset($post)?$post->title:''}}">
                    </div>

                    <div class="form-group">
                        <label class="mb-2 mt-2" for="title">Post Description</label>
                        <textarea class="form-control" rows="3" name="description" placeholder="Enter post Description">{{isset($post)?$post->description:''}}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="mb-2 mt-2" for="title">Post Content</label>
                        <input id="x" type="hidden" name="content" value = "{{isset($post)?$post->content:''}}">
                        <trix-editor input="x"></trix-editor>
                    </div>
                    <div class="form-group mt-2">
                        <div class="text-center">
                            <img id="post-iimg" src="@isset($post){{$post->image_for_web}}@endisset" class="img-fluid">
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-2 mt-2" for="selectCategory">Select Category</label>
                        <select class="form-control" id="selectCategory" name="category_id">
                            @foreach ($categories as $category)
                            <option value="{!!$category->id!!}"
                            {!!(isset($post) && $post->category_id == $category->id)? 'selected' : ''!!}>
                                {{$category->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @if (!$tags->count() <= 0)
                        <div class="form-group">
                            <label class="mb-2 mt-2" for="selectTag">Select Tag</label>
                            <select class="selectttt form-control" id="selectTag" name="tags[]" multiple>
                                @foreach ($tags as $tag)
                                <option value="{{$tag->id}}"
                                @if (isset($post) && $post->hasTag($tag->id))
                                    selected
                                @endif >
                                    {{$tag->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="mb-2 mt-2" for="title">Post Image</label><br>
                        <input type="file" class="form-control-file" name="image" id="upload">
                    </div>

                    <button type="submit" class="btn btn-success Add-btn mt-3">{{isset($post)?'Update':'Add'}}</button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection


@section('jsfiles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.selectttt , #selectCategory').select2();
        $("span.select2-selection--single").attr("class","form-control");
        $("span#select2-selectCategory-container").attr("name","form-control");
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
                 $('#post-iimg').attr('src', e.target.result);
              }
             reader.readAsDataURL(input.files[0]);
          }
        });

      });
</script>
<script>

    $("#selectCategory").change(function (e) {
        id = $('#selectCategory').select2('data')[0]['id'];
        $(this).children().each(function( index ) {
            if (id === $(this).val()) {
                $(this).siblings().removeAttr("selected");
                $(this).attr("selected", "selected");
            }
        });
    });

</script>
@endsection
