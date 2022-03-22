@extends('admin.sidebar.sidebar')
@section('title','View Send Email')
@section('pageName','View Send Email')
@section('sidebar')
    @parent
@stop
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Send Mail To <br/>
        Name : {{$email->user->name}} <br/>
        Email : {{$email->user->email}} <br/>
        <div>
        <p style="float: right;">Send at : {{$email->created_at->format('Y-m-d')}}<br/>
            Time : {{$email->created_at->format('H:m:s')}}
        </p>
        </div>
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a class="deleteMail" href="javascript:;" data-toggle="modal" data-value="{{$email->id}}"
               data-target="#delete-confirmation-modal">
                <button class="button text-white bg-theme-6 shadow-md mr-2">Delete Mail</button>
            </a>
            <div class="dropdown">
                <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                </button>
                <div class="dropdown-box w-40">
                    <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                        <a href=""
                           class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print </a>
                        <a href=""
                           class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                        <a href=""
                           class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 lg:col-span-6">
                    <!-- BEGIN: Form Layout -->
                    <div class="intro-y box p-5">
                        <div class="mt-2">
                            <label>Subject</label>
                            <input type="text" class="input w-full border mt-2" name="subject"
                                   placeholder="Enter subject" value="{{$email->subject}}" readonly>
                        </div>
                        <div class="mt-3">
                            <label>Message</label>
                            <div class="mt-2">
                        <textarea class="form-control" id="summary-ckeditor"
                                  name="message" readonly>{!! $email->message !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- END: Form Layout -->
                </div>
        </div>
        <!-- END: Data List -->
    </div>

    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Are you sure?</div>
                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be
                    undone.
                </div>
            </div>
            <form action="{{route('destroy.single.mail')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" class="id">
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel
                    </button>
                    <button type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!-- END: Delete Confirmation Modal -->
@endsection
@section('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('summary-ckeditor');

        $(document).ready(function () {
            $('.deleteMail').click(function (){
               let id = $(this).data('value');
               $('.id').val(id);
            });
        });
    </script>
@endsection
