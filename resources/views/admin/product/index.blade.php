@extends('admin.sidebar.sidebar')
@section('title','Product')
@section('pageName','Product')
@section('sidebar')
    @parent
@stop
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Product List
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{route('product.create')}}">
                <button class="button text-white bg-theme-1 shadow-md mr-2">Add New Product</button>
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
            <table class="table table-report -mt-2" id="example" style="width:100%">
                <thead>
                <tr>
                    <th class="text-center whitespace-no-wrap">S.N.</th>
                    <th class="text-center whitespace-no-wrap">TITLE</th>
                    <th class="text-center whitespace-no-wrap">PRICE</th>
                    <th class="text-center whitespace-no-wrap">CATEGORY</th>
                    <th class="text-center whitespace-no-wrap">SUB CATEGORY</th>
                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="intro-x">
                        <td class="text-center">
                            <a href="{{route('product.show',$product->id)}}" class="font-medium whitespace-no-wrap">
                                {{$loop->iteration}} </a></td>
                        <td class="text-center">{{ucfirst($product->title)}}</td>
                        <td class="text-center">{{'$ '. ucfirst($product->price)}}</td>
                        <td class="text-center">{{ucfirst($product->category->category_name)}}</td>
                        <td class="text-center">{{ucfirst($product->subCategory->sub_category_name)}}</td>

                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{route('product.edit',$product->id)}}"> <i
                                        data-feather="check-square"
                                        class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a class="flex items-center text-theme-6 deleteProduct" href="javascript:;"
                                   data-toggle="modal"
                                   data-value="{{$product->id}}" data-target="#delete-confirmation-modal"> <i
                                        data-feather="trash-2"
                                        class="w-4 h-4 mr-1"></i> Delete </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
            @if(count($products) > 0)
                <form method="POST" action="{{route('product.destroy',$product->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="product_id" id="product_id" class="productId">
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                            Cancel
                        </button>
                        <button type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.deleteProduct').click(function () {
                let id = $(this).data('value');
                $('.productId').val(id)
            });
        });
    </script>
@endsection
