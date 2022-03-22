@extends('admin.sidebar.sidebar')
@section('title','Blog')
@section('pageName','Add Blog')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            Create Blog
        </h2>
    </div>
    <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
        @csrf
                   <div class="intro-y box p-5">
        <div class="grid grid-cols-2 gap-6 mt-4">
     
                <!-- BEGIN: Form Layout -->
     
               <div style="border-right:1px solid #b0b0b033;padding-right:30px">
                        <div>
                        <label>Title</label>
                        <input type="text" class="input w-full border mt-2" name="title"
                               placeholder="Input title" value="{{old('title')}}">
                        @error('title')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Added By</label>
                        <input type="text" class="input w-full border mt-2" name="added_by"
                               placeholder="Enter name" value="{{old('added_by')}}">
                        @error('added_by')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                 
                    <div class="mt-3">
                        <label>Description</label>
                        <div class="mt-2">
                        <textarea class="form-control" id="summary-ckeditor"
                                  name="description"></textarea>
                            @error('description')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
               </div>
              <div>
                     <div class="mt-2">
                        <label>Active Status</label>
                        <div class="mt-2">
                            <input type="checkbox" name="status" class="input input--switch border">
                        </div>
                    </div>
                        <div class="mt-2">
                        <label class="control-label col-md-3 p-0">Upload Image :</label>
                        <br>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new img-thumbnail"
                                 style="max-width: 200px; max-height: 150px;">
                                <img
                                    src="{{asset('assets/image_placeholder.webp')}}"
                                    alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"
                                 style="max-width: 200px; max-height: 150px;"></div>
                            <div>
                                <br>
                                <span class="btn btn-outline-secondary btn-file w-100 mb-3"><span
                                        class="fileinput-new">Select Image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image"></span>
                                <a href="#" class="btn btn-outline-secondary fileinput-exists w-100"
                                   data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                        @error('image')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
             
                    <div class=" mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                    </div>
              </div>
             
                <!-- END: Form Layout -->
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('summary-ckeditor');
    </script>
@endsection
