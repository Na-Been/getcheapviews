@extends('admin.sidebar.sidebar')
@section('title','Send Bulk Email')
@section('pageName','Send Bulk Email')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            Send Bulk Email
        </h2>
    </div>
    <form method="POST" action="{{ route('send.bulk.email') }}">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-4">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label>Title</label>
                        <div class="mt-2">
                            <select class="select2" name="to[]" multiple>
                                <option disabled>Please Select Users Email</option>
                                @foreach($users as $user)
                                    <option value="{{$user->email}}">{{$user->email}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('to')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Template</label>
                        <div class="mt-2">
                            <select class="select2" name="template_id">
                                <option selected disabled>Please Select One Category Name</option>
                                @foreach($templates as $template)
                                    <option value="{{$template->id}}">{{$template->subject}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label>Subject</label>
                        <input type="text" class="input w-full border mt-2 subject" name="subject"
                               placeholder="Enter subject" value="{{old('subject')}}">
                        @error('subject')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>Message</label>
                        <div class="mt-2">
                        <textarea class="form-control" id="summary_ckeditor1"
                                  name="message"></textarea>
                            @error('message')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Send Mail</button>
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
        CKEDITOR.replace('summary_ckeditor1');

        $(document).ready(function () {
            $('.select2').select2({
                'width': '100%'
            });

            $('.sendMail').click(function () {
                let email = $(this).data('value');
                $('.to').val(email);
            });

            $('.select2').change(function () {
                CKEDITOR.instances.summary_ckeditor1.setData();
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    dataType: 'json',
                    url: '/admin/find/template/' + id,
                }).done(function (data) {
                    $('.subject').attr('value', data.subject);
                    let editor = CKEDITOR.instances.summary_ckeditor1;
                    let newElement = CKEDITOR.dom.element.createFromHtml(data.message, editor.document)
                    editor.insertElement(newElement);
                });
            });
        });

    </script>
@endsection
