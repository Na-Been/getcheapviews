@extends('layouts.app')
@section('title',ucfirst($subcategory->category->category_name??null) ." Details")
@section('navbar')
    @parent
@stop
@section('content')
    <div class="contact ">
        @if($slider != null)
            <div class="banner-image"
                 style="background-image: url({{asset(url('/').Storage::url($slider->image))}})">
            </div>
        @else
            <div class="banner-image"
                 style="background-image: url({{asset('assets/bannerimage.png')}})">
            </div>
        @endif
        <div class="page-title">
            <h1>{{$subcategory->sub_category_name}}</h1>
        </div>
    </div>

    <div class="page" style="padding:60px 0px">
        <div class="container">
            <h3 class="mb-3" style="color:#777777"><b>{{$subcategory->sub_category_name}}</b></h3>
            <p>
                {!! $subcategory->sub_category_description !!}
            </p>
        </div>
        <section class="my-5">
            <div class="container ">
                <div class="row related-products">
                    <h6 class="text-center"><b>Related Youtube Products</b></h6>

                    <ul class="d-flex" style="flex-wrap:wrap ;">
                        @foreach($relatedProducts as $relatedProduct)
                            @foreach($relatedProduct->subCategory as $product)
                                <li>
                                    <a href="{{route('subcategory.page',['category'=>$relatedProduct->slug, 'subcategory'=>$product->slug])}}">
                                    {{$product->sub_category_name}}</a></li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
                <div class="row">
                    <h3 class="text-center"><b>Choose Best Package For Your Business</b></h3>
                    @foreach($subcategory->product as $product)
                        <div class="col-lg-4 my-3">
                            <div class="card package-card p-md-4">
                                <div class="card-top py-3 text-center ">
                                    <h4>
                                        {{$product->title}}</h4>
                                    <h3 class="package-price"><span
                                            style="font-size:28px !important">$</span>
                                        {{str_replace('.00', '', number_format($product->price, 2, '.', ','))}}</h3>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <ul class="float-start w-100">
                                        @foreach($product->features as $feature)
                                            <li class="text-start mb-2 pb-2"><i
                                                    class="las la-check"></i>&nbsp;{{$feature->feature_title}}</li>
                                        @endforeach
                                    </ul>
                                    <a href="{{route('buy.now',$product->slug)}}">
                                        <button class="btn btn-primary w-100">Buy Now</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    @include('layouts.footer')
@endsection
