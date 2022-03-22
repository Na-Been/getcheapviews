@extends('admin.sidebar.sidebar')
@section('title','slider')
@section('pageName','slider')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
           Create Slider Image
        </h2>
    </div>
    <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="intro-y box p-5 ">
    <div class="grid grid-cols-2 gap-8  mt-4">

            <!-- BEGIN: Form Layout -->
            <div style="border-right:1px solid #b0b0b033;padding-right:30px">
                <div>
                    <label>Title</label>
                    <input type="text" class="input w-full border mt-2" name="title" placeholder="Input title">
                    @error('title')
                    <div class="text-theme-6">{{$message}}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label>Sub Title</label>
                    <input type="text" class="input w-full border mt-2" name="sub_title" placeholder="Input sub title">
                    @error('sub_title')
                    <div class="text-theme-6">{{$message}}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label>Rank</label>
                    <input type="number" class="input w-full border mt-2" name="rank" placeholder="Input rank">
                    @error('rank')
                    <div class="text-theme-6">{{$message}}</div>
                    @enderror
                </div>
              
                <div class="mt-2">
                    <label>Active Status</label>
                    <div class="mt-2">
                        <input type="checkbox" name="status" class="input input--switch border">
                    </div>
                </div>
            </div>
            <!-- END: Form Layout -->
     
        
            <!-- BEGIN: Form Layout -->
            <div>
       
                <div class="mt-2">
                        <label class="control-label col-md-3 p-0">Upload Image :</label>
                        <br>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new img-thumbnail"
                                 style="max-width: 200px; max-height: 150px;">
                                <img
                                    src="{{asset('assets/image_placeholder.webp')}}"
                                    alt="..."
                                ></div>
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


             
            </div>
            <!-- END: Form Layout -->
</div>
<hr>
     <div class="text-center mt-5">
                    <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                </div>
    </div>
    </form>
@endsection
