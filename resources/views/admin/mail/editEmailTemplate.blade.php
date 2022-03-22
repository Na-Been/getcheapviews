@extends('admin.sidebar.sidebar')
@section('title','Email Template')
@section('pageName','Email Template')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            Add Email Template
        </h2>
    </div>
    <form method="POST" action="{{route('update.email.template',$template->id)}}">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-12 gap-6 mt-4">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div class="mt-2">
                        <label>Subject</label>
                        <input type="text" class="input w-full border mt-2" name="subject"
                               placeholder="Enter subject" value="{{$template->subject}}">
                        @error('subject')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>Message</label>
                        <div class="mt-2">
                        <textarea class="form-control" id="summary-ckeditor"
                                  name="message">{!! $template->message !!}</textarea>
                            @error('message')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Update Template</button>
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
