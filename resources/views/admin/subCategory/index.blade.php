@extends('admin.sidebar.sidebar')
@section('title','Sub Category')
@section('pageName','Sub Category')
@section('sidebar')
    @parent
@stop
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Sub Category List
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{route('subcategory.create')}}">
                <button class="button text-white bg-theme-1 shadow-md mr-2">Add New SubCategory</button>
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
        @if(count($subCategories) > 0)
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2" id="example" style="width:100%">
                    <thead>
                    <tr>
                        <th class="whitespace-no-wrap">S.N.</th>
                        <th class="text-center whitespace-no-wrap">SUB CATEGORY NAME</th>
                        <th class="text-center whitespace-no-wrap">CATEGORY NAME</th>
                        <th class="text-center whitespace-no-wrap">SUB CATEGORY DESCRIPTION</th>
                        <th class="text-center whitespace-no-wrap">RATE PER THOUSAND</th>
                        <th class="text-center whitespace-no-wrap">MIN ORDER</th>
                        <th class="text-center whitespace-no-wrap">MAX ORDER</th>
                        <th class="text-center whitespace-no-wrap">ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subCategories as $subCategory)
                        <tr class="intro-x">
                            <td class="text-center font-medium whitespace-no-wrap">
                                {{$loop->iteration}}
                            </td>
                            <td class="text-center font-medium whitespace-no-wrap">
                                {{ucfirst($subCategory->sub_category_name)}}
                            </td>
                            <td class="text-center font-medium whitespace-no-wrap">
                                {{ucfirst($subCategory->category->category_name)}}
                            </td>
                            <td class="text-center font-medium whitespace-no-wrap">
                                {!! Str::limit(ucfirst($subCategory->sub_category_description),20) !!}
                            </td>
                            <td class="text-center font-medium whitespace-no-wrap">
                                {{'$'. $subCategory->rate_per_thousand}}
                            </td>
                            <td class="text-center font-medium whitespace-no-wrap">
                                {{$subCategory->min_order}}
                            </td>
                            <td class="text-center font-medium whitespace-no-wrap">
                                {{$subCategory->max_order}}
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 editSubCategory"
                                       href="{{route('subcategory.edit',$subCategory->id)}}">
                                        <i data-feather="check-square"
                                           class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-theme-6 deleteSubCategory" href="javascript:;"
                                       data-toggle="modal"
                                       data-value="{{$subCategory->id}}" data-target="#delete-confirmation-modal"> <i
                                            data-feather="trash-2"
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
                    <form method="POST" action="{{route('subcategory.destroy',$subCategory->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="px-5 pb-8 text-center">
                            <input type="hidden" name="subCategory_id" id="subCategory_id" class="subCategory">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                                Cancel
                            </button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->
        @endif
        @endsection
        @section('script')
            <script>
                $(document).ready(function () {
                    $('.deleteSubCategory').click(function () {
                        let id = $(this).data('value');
                        $('.subCategory').val(id);
                    });

                    /*$('.editSubCategory').click(function (){
                        let id = $(this).data('value');
                    })*/
                });
            </script>
@endsection


