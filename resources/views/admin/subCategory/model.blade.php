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
            <a href="javascript:;" data-toggle="modal" data-target="#add-new-category">
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
            <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        @if($subCategories->isNotEmpty())
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                    <tr>
                        <th class="whitespace-no-wrap">S.N.</th>
                        <th class="text-center whitespace-no-wrap">SUB CATEGORY NAME</th>
                        <th class="text-center whitespace-no-wrap">CATEGORY NAME</th>
                        <th class="text-center whitespace-no-wrap">SUB CATEGORY DESCRIPTION</th>
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

                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 editSubCategory" href="javascript:;"
                                       data-toggle="modal"
                                       data-target="#edit-category" data-value="{{$subCategory->id}}">
                                        <i data-feather="check-square"
                                           class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal"
                                       data-target="#delete-confirmation-modal"> <i data-feather="trash-2"
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
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                                Cancel
                            </button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->


            <!-- BEGIN: Edit SubCategory Modal -->
            <div class="modal" id="edit-category">
                <div class="modal__content">
                    <form method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="p-5 text-center">
                            <p style="font-size:25px;">Update Category</p>
                            <div class="text-lg mt-5">
                                <div class="mt-3">
                                    <label>Sub Category Name</label>
                                    <input type="text" class="input w-full border mt-2 subCategoryName"
                                           name="sub_category_name"
                                           placeholder="Input title">
                                </div>

                                <div class="mt-3">
                                    <label> Category Name</label>
                                    <div class="mt-2">
                                        <select class="select2 categorySelect" id="category_id" name="category_id">
                                            {{--                                            <option class="categorySelect" selected="selected"></option>--}}
                                            {{--                                            @foreach($categories as $category)--}}
                                            {{--                                                <option value="{{$category->id}}">{{$category->category_name}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label>Description</label>
                                    <div class="mt-2">
                                     <textarea class="form-control" id="summary-ckeditor"
                                               name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                                Cancel
                            </button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white"
                                    formaction="{{route('subcategory.update',$subCategory->id)}}">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Edit SubCategory Modal -->
        @endif

    <!-- BEGIN: Add SubCategory Modal -->
        <div class="modal" id="add-new-category">
            <div class="modal__content">
                <form method="POST">
                    @csrf
                    <div class="p-5 text-center">
                        <p style="font-size:25px;">Add SubCategory</p>
                        <div class="text-lg mt-5">
                            <div class="mt-3">
                                <input type="hidden" name="subCategory_id" class="subCategory_id">
                                <label>Sub Category Name</label>
                                <input type="text" class="input w-full border mt-2" name="sub_category_name"
                                       placeholder="Input title">
                            </div>

                            <div class="mt-3">
                                <label> Category Name</label>
                                <div class="mt-2">
                                    <select class="select2" name="category_id">
                                        <option selected disabled>Please Select One Category Name</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label>Description</label>
                                <div class="mt-2">
                                    <textarea data-simple-toolbar="true" class="editor" name="sub_category_description">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                            Cancel
                        </button>
                        <button type="submit" class="button w-24 bg-theme-6 text-white"
                                formaction="{{route('subcategory.store')}}">Create
                        </button>
                    </div>
                </form>
            </div>


        </div>
        <!-- END: Add SubCategory Modal -->
        @endsection
        @section('script')

            <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('summary-ckeditor');
            </script>
                        <script>

                            $(document).ready(function () {
                                $('.select2').select2({
                                    'width': '100%'
                                });
                                $('.editSubCategory').click(function () {
                                    var id = $(this).data('value');
                                    $('.categorySelect').empty()
                                    $.ajax({
                                        dataType: 'json',
                                        url: 'subcategory/' + id,
                                        method: 'GET',
                                    }).done(function (data) {
                                        $('.subCategory_id').val(data.id);
                                        $('.subCategoryName').val(data.sub_category_name);
                                        $('.categorySelect').val(data.category_id);
                                        var name = data.category.category_name;
                                        var id = data.category.id;
                                        $('#category_id').append('<option value="' + id + '"> ' + name + '</option>')
                                        var a = $('#description').text('dsadsADasdASDSadasDASASSSSSSSSSSSSSSSSSS');
                                    });
                                });
                            });

                        </script>
@endsection


