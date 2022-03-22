@extends('admin.sidebar.sidebar')
@section('title','Product')
@section('pageName','Show Product')
@section('sidebar')
    @parent
@stop
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Product Information
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{route('product.edit',$product->id)}}">
                <button class="button text-white bg-theme-1 shadow-md mr-2">Edit Product</button>
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
            <div class="mt-5"><h1>Product Title : </h1>
                <h3 style="margin-left: 5px">{{ucfirst($product->title)}}</h3></div>
            <div class="mt-5"><h1>Product Price : </h1>
                <h3 style="margin-left: 5px">{{ucfirst($product->price)}}</h3></div>
            <div class="mt-5"><h1>Product Category : </h1>
                <h3 style="margin-left: 5px">{{ucfirst($product->category->category_name)}}</h3></div>
            <div class="mt-5"><h1>Product Sub Category : </h1>
                <h3 style="margin-left: 5px">{{ucfirst($product->subCategory->sub_category_name)}}</h3></div>
            <div class="mt-5"><h1>Product Features : </h1>
                <h3 style="margin-left: 5px">
                    @foreach($product->features as $feature)
                       <ul>
                       <li> {{$feature->feature_title}} </li>
                       </ul>
                    @endforeach
                </h3></div>
        </div>
        <!-- END: Data List -->

    </div>

@endsection
