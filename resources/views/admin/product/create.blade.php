@extends('admin.sidebar.sidebar')
@section('title','Product')
@section('pageName','Add Product')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            Add Product
        </h2>
    </div>
    <form method="POST" action="{{route('product.store')}}">
        @csrf
        <div class="grid  gap-6 mt-4">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label>Title</label>
                        <input type="text" class="input w-full border mt-2" name="title" placeholder="Input title">
                        @error('title')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Price</label>
                        <input type="number" step="any" class="input w-full border mt-2" name="price" placeholder="Input price">
                        @error('price')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Category</label>
                        <div class="mt-2">
                            <select data-placeholder="Select Category" id="category" class="tail-select w-full"
                                    name="category_id">
                                <option selected disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2">
                        <label>Sub Category</label>
                        <div class="mt-2">
                            <select data-placeholder="Select Sub Category"
                                    class="select2 subCategory"
                                    name="sub_category_id" id="subCategory">
                            </select>
                            @error('sub_category_id')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2">
                        <label>Product Feature</label>
                        <div class="mt-2 main_div">
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-12 xl:col-span-10">
                                    <input type="text" class="input w-full border mt-2 test-this" name="feature_title[]"
                                           placeholder="Input feature"></div>
                                <div class="col-span-12 xl:col-span-2 mt-3">
                                    <a class="button w-24 bg-theme-1 text-white mt-2" id="add-row">Add</a></div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div id="describe"></div>
                            @error('feature_title')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="text-right mt-5">
                        <button type="submit" id="button" class="button w-24 bg-theme-1 text-white">Save</button>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </div>
    </form>
    <div style="display: none">
        <div id="addRow">

            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-12 xl:col-span-10">
                    <input type="text" class="input w-full border mt-2 test-this" name="feature_title[]"
                           placeholder="Input feature"></div>
                <div class="col-span-12 xl:col-span-2 mt-3">
                    <a class="button w-24 bg-theme-6 text-white mt-2" id="remove-row">Remove</a></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            //for select2
            $('.select2').select2({
                'width': '100%'
            });

            //for searching subcategory according the category changes
            $('#category').change(function () {
                $('.subCategory').empty()
                let id = $(this).val();
                $.ajax({

                    method: 'GET',
                    dataType: 'json',
                    url: '/admin/find/subcategory/' + id,
                }).done(function (data) {
                    $.each(data, function (key, value) {
                        $('.subCategory')
                            .append($("<option class='ajaxValue'></option>")
                                .attr("value", value.id)
                                .text(value.sub_category_name));
                    });

                });
            });

            //for feature input fields

        });

        $(document).on('click', '#add-row', function () {
            var htmls = $('#addRow').clone();
            $('.main_div').append(htmls);
        });

        $(document).on('click', '#remove-row', function () {
            $(this).parent().parent().parent().remove();
        });
    </script>
@endsection

