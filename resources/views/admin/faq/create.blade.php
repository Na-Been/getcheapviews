@extends('admin.sidebar.sidebar')
@section('title','Create FAQ')
@section('pageName','Create FAQ')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            Add Frequently Asked Questions
        </h2>
    </div>
    <form method="POST" action="{{ route('question.store') }}">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-4">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label>Question</label>
                        <input type="text" class="input w-full border mt-2" name="question"
                               placeholder="Input title">
                        @error('question')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>Answer</label>
                        <div class="mt-2">
                        <textarea class="form-control" id="summary-ckeditor"
                                  name="answer"></textarea>
                            @error('answer')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right mt-5">
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


