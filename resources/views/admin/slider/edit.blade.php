@extends('admin.sidebar.sidebar')
@section('title','Update slider')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            Update Slider Image
        </h2>
    </div>
    <form method="POST" action="{{ route('slider.update',$slider->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="intro-y box p-5">
        <div class="grid grid-cols-2 gap-6 mt-4">
        
                <!-- BEGIN: Form Layout -->
            
                <div style="border-right:1px solid #b0b0b033;padding-right:30px">
                        <div>
                        <label>Title</label>
                        <input type="text" class="input w-full border mt-2" name="title" value="{{$slider->title}}" placeholder="Input title">
                        @error('title')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Sub Title</label>
                        <input type="text" class="input w-full border mt-2" name="sub_title" value="{{$slider->sub_title}}" placeholder="Input sub title">
                        @error('sub_title')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Rank</label>
                        <input type="number" class="input w-full border mt-2" name="rank" value="{{$slider->rank}}" placeholder="Input rank">
                        @error('rank')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Active Status</label>
                        <div class="mt-2">
                            @if($slider->status == 1)
                                <input type="checkbox" name="status" checked data-toggle="toggle" class="input input--switch border">
                            @else
                                <input type="checkbox" name="status" data-toggle="toggle" class="input input--switch border">
                            @endif
                        </div>
                    </div>
                </div>
                    <div class="mt-2">
                        <label class="control-label col-md-3 p-0">Change Image :</label>
                        <br>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new img-thumbnail"
                                 style="max-width: 200px; max-height: 150px;">
                                <img
                                    src="{{asset(url('/').Storage::url($slider->image))}}"
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
                <hr>
       <div class="text-center mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Update</button>
                    </div>
        </div>
    </form>
@endsection
