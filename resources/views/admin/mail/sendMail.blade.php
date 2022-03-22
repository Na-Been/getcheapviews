@extends('admin.sidebar.sidebar')
@section('title','Send Email')
@section('pageName','Send Email')
@section('sidebar')
    @parent
@stop
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Send Email To User
    </h2>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2" id="example" style="width:100%">
            <thead>
            <tr>
                <th class="whitespace-no-wrap">S.N.</th>
                <th class="text-center whitespace-no-wrap">USER NAME</th>
                <th class="text-center whitespace-no-wrap">EMAIL</th>
                <th class="text-center whitespace-no-wrap">NUMBER OF ORDER</th>
                <th class="text-center whitespace-no-wrap">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="intro-x">
                    <td class="font-medium whitespace-no-wrap text-center">
                        {{$loop->iteration}}
                    </td>
                    <td class="text-center">{{$user->name}}</td>
                    <td class="text-center">{{$user->email}}</td>
                    <td class="text-center">{{count($user->order)}}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{route('view.user.details',$user->id)}}"> <i
                                    data-feather="eye"
                                    class="w-4 h-4 mr-1"></i> View User
                            </a>
                            <a class="flex items-center text-theme-1 sendMail" href="javascript:;" data-toggle="modal"
                               data-value="{{$user->email}}" data-target="#make_email_modal"> <i data-feather="send"
                                                                                                 class="w-4 h-4 mr-1"></i>
                                Send Mail
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: send Mail Confirmation Modal -->
    <div class="modal" id="make_email_modal">
        <div class="modal__content">
            <form action="{{route('send.single.email')}}" method="POST">
                @csrf
                <div class="p-5 text-center">
                    <p style="font-size:25px;">Compose Email</p>
                    <div class="text-xl mt-5">
                        <div>
                            <label>To</label>
                            <input type="text" class="input w-full border mt-2 to"
                                   name="to"
                                   placeholder="To">
                            @error('to')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Template</label>
                            <div class="mt-2">
                                <select class="select2" name="template_id">
                                    <option selected disabled>Please Select One Email Template</option>
                                    @foreach($templates as $template)
                                        <option value="{{$template->id}}">{{$template->subject}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label>Subject</label>
                            <input type="text" class="input w-full border mt-2 subject"
                                   name="subject"
                                   placeholder="Subject">
                            @error('subject')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Message</label>
                            <div class="mt-2">
                                <textarea class="form-control" id="summary_ckeditor1"
                                          name="message"></textarea>

                            </div>
                            @error('message')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="button w-24 border bg-theme-5 text-gray-700 mr-1">
                        Cancel
                    </button>
                    <button type="submit" class="button w-24 bg-theme-1 text-white">Send Mail</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Email Confirmation Modal -->
@endsection
@section('script')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                'width': '100%'
            });

            $('.sendMail').click(function () {
                let email = $(this).data('value');
                $('.to').val(email);
                CKEDITOR.replace('summary_ckeditor1');
            });

            $('.select2').change(function (){
               CKEDITOR.instances.summary_ckeditor1.setData();
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    dataType: 'json',
                    url: '/admin/find/template/' + id,
                }).done(function (data){
                    $('.subject').attr('value',data.subject);
                  let editor =  CKEDITOR.instances.summary_ckeditor1;
                  let newElement =  CKEDITOR.dom.element.createFromHtml( data.message, editor.document )
                    editor.insertElement( newElement );
                });
            });
        });
    </script>
@endsection

