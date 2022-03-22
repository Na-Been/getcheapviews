@extends('admin.sidebar.sidebar')
@section('title','Sub Category')
@section('pageName','Edit Sub Category')
@section('sidebar')
    @parent
@stop
@section('content')
    <div class="intro-y flex items-center mt-5">
        <h2 class="text-lg font-medium mr-auto">
            Add Sub Category
        </h2>
    </div>
    <form method="POST" action="{{ route('subcategory.update',$subCategory->id) }}">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-12 gap-6 mt-4">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <div>
                        <label>Sub Category Title</label>
                        <input type="text" class="input w-full border mt-2" name="sub_category_name"
                              value="{{$subCategory->sub_category_name}}" placeholder="Input title">
                        @error('sub_category_name')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label> Category Name</label>
                        <div class="mt-2">
                            <select class="select2" name="category_id">
                                <option value="{{$subCategory->category_id}}">{{$subCategory->category->category_name}}</option>
                                <option disabled>Select Category If You Want To Change</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Rate Per 1000</label>
                        <input type="text" class="input w-full border mt-2" name="rate_per_thousand"
                               placeholder="Input rate per 1000" value="{{$subCategory->rate_per_thousand}}">
                        @error('rate_per_thousand')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>Min Order</label>
                        <input type="text" class="input w-full border mt-2" name="min_order"
                               placeholder="Input min order" value="{{$subCategory->min_order}}">
                        @error('min_order')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>Max Order</label>
                        <input type="text" class="input w-full border mt-2" name="max_order"
                               placeholder="Input max order" value="{{$subCategory->max_order}}">
                        @error('max_order')
                        <div class="text-theme-6">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label>Description</label>
                        <div class="mt-2">
                        <textarea class="form-control" id="summary-ckeditor"
                                  name="sub_category_description">{!! $subCategory->sub_category_description !!}</textarea>
                            @error('sub_category_description')
                            <div class="text-theme-6">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="submit" class="button w-24 bg-theme-1 text-white">Update</button>
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
        CKEDITOR.replace('summary-ckeditor');
    </script>
    <script>

        $(document).ready(function () {
            $('.select2').select2({
                'width': '100%'
            });
            /*$('.editSubCategory').click(function () {
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
            });*/
        });

    </script>
@endsection

