@extends('layouts.app')
@section('title','Buy Now')
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
            <h1>Buy Now</h1>
        </div>
    </div>
    <div class="purchase">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 my-sm-5">
                    <form action="{{route('buy.now.purchase',$product->slug)}}" method="POST">
                        @csrf
                        <input type="text" class="form-control py-3" name="link"
                               placeholder="http://www.youtube.com/watch?v=XXXXXXXXXXXXX">
                        @error('link')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                        <br>
                        <input type="text" name="current_data" class="form-control py-3" placeholder="Current No. of Views">
                        @error('current_data')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                        <br>
                        <input type="email" name="contact_email" class="form-control py-3" placeholder="Contact Email">
                        @error('contact_email')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                        <br>
                        <button class="btn btn-success w-100" type="submit">Purchase {{$product->title}}</button>
                    </form>
                </div>
                <div class="col-lg-6 my-sm-5">
                    <ul class="features">
                        @foreach($product->features as $feature)
                            <li><i class="la la-check"></i> {{ucfirst($feature->feature_title)}}</li>
                            <hr>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
