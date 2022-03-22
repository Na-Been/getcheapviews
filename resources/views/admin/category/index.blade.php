@extends('admin.sidebar.sidebar')
@section('title','Category')
@section('pageName','Category')
@section('sidebar')
    @parent
@stop
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Category List
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="javascript:;" data-toggle="modal" data-target="#add-new-category">
                <button class="button text-white bg-theme-1 shadow-md mr-2">Add New Category</button>
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
                        <th class="whitespace-no-wrap">S.N.</th>
                        <th class="text-center whitespace-no-wrap">CATEGORY NAME</th>
                        <th class="text-center whitespace-no-wrap">ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr class="intro-x">
                            <td class="font-medium whitespace-no-wrap">
                                {{$loop->iteration}}
                            </td>
                            <td class="font-medium whitespace-no-wrap">
                                {{ucfirst($category->category_name)}}
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 editCategory" data-toggle="modal"
                                       data-target="#edit-category" data-name="{{$category->category_name}}"
                                       data-value="{{$category->id}}">
                                        <i data-feather="check-square"
                                           class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-theme-6 deleteCategory" href="javascript:;"
                                       data-toggle="modal"
                                       data-target="#delete-confirmation-modal"
                                       data-value="{{$category->id}}"> <i data-feather="trash-2"
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
        @if($categories->isNotEmpty())
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
                    <form method="POST" action="{{route('category.destroy',$category->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="category_id" id="category_id" class="category_id">
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


            <!-- BEGIN: Edit Category Modal -->
            <div class="modal" id="edit-category">
                <div class="modal__content">
                    <form method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="p-5 text-center">
                            <p style="font-size:25px;">Update Category</p>
                            <div class="text-xl mt-5">
                                <div>
                                    <input type="hidden" name="category_id" id="category_id" class="category_id">
                                    <label>Category Name</label>
                                    <input type="text" class="input w-full border mt-2 categoryName" id="categoryName"
                                           name="category_name"
                                           placeholder="Input title">
                                    @error('category_name')
                                    <div class="text-theme-6">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                                Cancel
                            </button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white"
                                    formaction="{{route('category.update',$category->id)}}">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Edit Category Modal -->
        @endif

    <!-- BEGIN: Add Category Modal -->
        <div class="modal" id="add-new-category">
            <div class="modal__content">
                <form method="POST">
                    @csrf
                    <div class="p-5 text-center">
                        <p style="font-size:25px;">Add Category</p>
                        <div class="text-xl mt-5">
                            <div>
                                <label>Category Name</label>
                                <input type="text" class="input w-full border mt-2" name="category_name"
                                       placeholder="Input title" required>
                                @error('category_name')
                                <div class="text-theme-6">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                            Cancel
                        </button>
                        <button type="submit" class="button w-24 bg-theme-6 text-white"
                                formaction="{{route('category.store')}}">Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Add Category Modal -->
        @endsection
        @section('script')
            <script>
                $(document).ready(function () {
                    $('.editCategory').click(function () {
                        let id = $(this).data('value');
                        let name = $(this).data('name');
                        $('.category_id').val(id)
                        $('.categoryName').val(name);
                        // $('#edit-category').show();
                    });

                    $('.deleteCategory').click(function () {
                        let id = $(this).data('value');
                        $('.category_id').val(id);
                    });


                    /* $('#update').click(function () {
                         var id = $('#category_id').val();
                         var category_name = $('#categoryName').val();
                         alert(category_name);
                         $.ajax({
                             dataType: 'json',
                             url: 'category/' + id,
                             method: 'PATCH',
                             data: {category_name: category_name}
                         }).done(function (data) {
                             console.log(123);
                         });
                     });*/


                });
            </script>
@endsection
