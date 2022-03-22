@extends('admin.sidebar.sidebar')
@section('title','All Order List')
@section('pageName','All Order List')
@section('sidebar')
    @parent
@stop
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
       All Orders
    </h2>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2" id="example" style="width:100%">
            <thead>
            <tr>
                <th class="whitespace-no-wrap">S.N.</th>
                <th class="text-center whitespace-no-wrap">ORDER NAME</th>
                <th class="text-center whitespace-no-wrap">SERVICES</th>
                <th class="text-center whitespace-no-wrap">LINK</th>
                <th class="text-center whitespace-no-wrap">QUANTITY</th>
                <th class="text-center whitespace-no-wrap">CHARGE</th>
                <th class="text-center whitespace-no-wrap">STATUS</th>
                <th class="text-center whitespace-no-wrap">USER ID</th>
                <th class="text-center whitespace-no-wrap">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr class="intro-x">
                    <td class="font-medium whitespace-no-wrap">
                        {{$loop->iteration}}
                    </td>
                    <td class="font-medium whitespace-no-wrap">
                        {{ucfirst($item->category)}}
                    </td>
                    <td class="font-medium whitespace-no-wrap">
                        {{ucfirst($item->services)}}
                    </td>
                    <td class="font-medium whitespace-no-wrap">
                        {{$item->link}}
                    </td>
                    <td class="font-medium whitespace-no-wrap">
                        {{$item->quantity}}
                    </td>
                    <td class="font-medium whitespace-no-wrap">
                        {{$item->charge}}
                    </td>
                    <td class="font-medium whitespace-no-wrap">
                        {{$item->status}}
                    </td>
                    <td class="font-medium whitespace-no-wrap">
                        {{$item->user_id}}
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{route('view.single.order.status',$item->id)}}">
                                <i data-feather="eye"
                                   class="w-4 h-4 mr-1"></i> View
                            </a>
                            <a class="flex items-center text-theme-6 deleteOrder" href="javascript:;"
                               data-toggle="modal"
                               data-target="#delete-confirmation-modal"
                               data-value="{{$item->id}}"> <i data-feather="trash-2"
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
            <form method="POST" action="{{route('destroy.user.order')}}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="order_id" class="item_id">
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
        $(document).ready(function (){
           $('.deleteOrder').click(function (){
              let id = $(this).data('value');
              $('.item_id').val(id);
           });
        });
    </script>
@endsection
