@extends('admin.sidebar.sidebar')
@section('title','Setting')
@section('pageName','Setting')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            @if($setting != null)
                Edit Setting
            @else
                Add Setting
            @endif
        </h2>
    </div>
    <form method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="intro-y box p-5">
        <div class="grid grid-cols-2 gap-6 mt-4">
     
                <!-- BEGIN: Form Layout -->
            
                <div>
                        <div>
                        <label>Title</label>
                        <input type="text" class="input w-full border mt-2" name="title"
                               value="{{$setting->title ?? null}}" placeholder="Input title">
                        @error('title')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Short Name</label>
                        <input type="text" class="input w-full border mt-2" name="short_name"
                               value="{{$setting->short_name ?? null}}" placeholder="Input short name">
                        @error('short_name')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Contact</label>
                        <input type="number" class="input w-full border mt-2" name="contact"
                               value="{{$setting->contact ?? null}}" placeholder="Input contact">
                        @error('contact')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Address</label>
                        <input type="text" class="input w-full border mt-2" name="address"
                               value="{{$setting->address ?? null}}" placeholder="Input address">
                        @error('address')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                     <div class="mt-2">
                        <label>Email</label>
                        <input type="email" class="input w-full border mt-2" name="email"
                               value="{{$setting->email ?? null}}" placeholder="Input email">
                        @error('email')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>Description</label>
                        <div class="mt-2">
                        <textarea class="form-control" id="summary-ckeditor"
                                  name="description">{!! $setting->description ?? null !!}</textarea>
                        </div>
                    </div>
                     
                </div>
               <div>
                     
                    <div class="mt-2">
                        <label>Facebook Link</label>
                        <input type="text" class="input w-full border mt-2" name="facebook_link"
                               value="{{$setting->facebook_link ?? null}}" placeholder="Input facebook link">
                    </div>
                    <div class="mt-2">
                        <label>Instagram Link</label>
                        <input type="text" class="input w-full border mt-2" name="instagram_link"
                               value="{{$setting->instagram_link ?? null}}" placeholder="Input instagram link">
                    </div>
                        <div class="mt-2">
                        <label>Twitter Link</label>
                        <input type="text" class="input w-full border mt-2" name="twitter_link"
                               value="{{$setting->twitter_link ?? null}}" placeholder="Input twitte link">
                    </div>
                    <div class="mt-2">
                        <label>Skype Link</label>
                        <input type="text" class="input w-full border mt-2" name="skype_link"
                               value="{{$setting->skype_link ?? null}}" placeholder="Input skype link">
                    </div>
                
                    <div class="mt-2">
                        <label class="control-label col-md-3 p-0">Upload Logo :</label>
                        <br>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new img-thumbnail"
                                 style="max-width: 200px; max-height: 150px;">
                                @if($setting)
                                    <img
                                        src="{{asset(url('/').Storage::url($setting->logo))}}"
                                        alt="...">
                                @else
                                    <img
                                        src="{{asset('assets/image_placeholder.webp')}}"
                                        alt="...">
                                @endif
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"
                                 style="max-width: 200px; max-height: 150px;"></div>
                            <div>
                                <br>
                                <span class="btn btn-outline-secondary btn-file w-100 mb-3"><span
                                        class="fileinput-new">Select Image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="logo"></span>
                                <a href="#" class="btn btn-outline-secondary fileinput-exists w-100"
                                   data-dismiss="fileinput">Remove</a>
                            </div>

                        </div>
                    </div>

                    <div class="text-left mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                    </div>
               </div>
                </div>
                <!-- END: Form Layout -->
    
        </div>
    </form>
@endsection
@section('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('summary-ckeditor');
    </script>
@endsection
