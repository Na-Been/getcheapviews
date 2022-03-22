@extends('admin.sidebar.sidebar')
@section('title','Users List')
@section('pageName','User List')
@section('sidebar')
    @parent
@stop
@section('content')

    <h2 class="intro-y text-lg font-medium mt-10">
        Available Registered Users !!!
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="#">
                <button class="button text-white bg-theme-1 shadow-md mr-2">Action Info</button>
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
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2" id="example" style="width:100%">
                <thead>
                <tr>
                    <th class="whitespace-no-wrap">S.N.</th>
                    <th class="text-center whitespace-no-wrap">NAME</th>
                    <th class="text-center whitespace-no-wrap">EMAIL</th>
                    <th class="text-center whitespace-no-wrap col-span-5">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="intro-x">
                        <td class="font-medium whitespace-no-wrap">
                            {{$loop->iteration}}
                        </td>
                        <td class="font-medium whitespace-no-wrap">
                            {{ucfirst($user->name)}}
                        </td>
                        <td class="font-medium whitespace-no-wrap">
                            {{ucfirst($user->email)}}
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{route('view.user.orders.status',$user->id)}}">
                                    <i data-feather="check-square"
                                       class="w-4 h-4 mr-1"></i> Status
                                </a>
                                <a class="flex items-center mr-3" href="{{route('view.user.order',$user->id)}}">
                                    <i data-feather="check-square"
                                       class="w-4 h-4 mr-1"></i> View Order
                                </a>
                                <a class="flex items-center text-theme-6 deleteUser" href="javascript:;"
                                   data-toggle="modal"
                                   data-target="#delete-confirmation-modal"
                                   data-value="{{$user->id}}"> <i data-feather="trash-2"
                                                                  class="w-4 h-4 mr-1"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- BEGIN: Delete Confirmation Modal -->
        <div class="modal" id="delete-confirmation-modal">
            <div class="modal__content">
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot
                        be
                        undone.
                    </div>
                </div>
                <form method="POST" action="{{route('destroy.register.user')}}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="user_id" id="user_id" class="user_id">
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                            Cancel
                        </button>
                        <button type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Delete Confirmation Modal -->
        @endsection
        @section('script')

            <script>
                $(document).ready(function () {
                    $('.deleteUser').click(function () {
                        let id = $(this).data('value');
                        $('.user_id').val(id);
                    });
                });
            </script>


@endsection
