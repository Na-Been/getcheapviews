@extends('layouts.app')
@section('title','Welcome')
@section('navbar')
    @parent
@stop
@section('content')

    <!-- content -->
    <div class="banner ">
        @if($slider != null)

            <div class="banner-image"
                 style="background-repeat:no-repeat;background-size:cover;background-image: url({{asset(url('/').Storage::url($slider->image))}})">
            </div>
        @else
            <div class="banner-image"
                 style="background-image: url({{asset('assets/bannerimage.png')}})">
            </div>
        @endif

        <div class="banner-content ">
            <h1 class="text-center"> {{$setting->title??'Setting Title Goes Here!'}}</h1>
            <p class="my-4 ">{{$setting->short_name ?? 'Setting Short Name Goes Here!'}}</p>
            <div class="banner-button text-center">
                <button class="btn btn-primary learn">Learn More</button>
                <a href="{{route('contact.index')}}">
                    <button class="btn btn-secondary">Contact Sales</button>
                </a>
            </div>
        </div>
    </div>

    <div class="ourPackages">
        <div class="container">
            <div class="row">
                <div class="col-12 ">
                    <h2 class="section-title">
                        {{$setting->short_name ?? 'Setting Short Name Goes Here!'}}
                    </h2>
                </div>
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-4">
                        <div class="card package-card my-sm-3 " data-aos="fade-up"
                             style="background-size:cover; background-image:url({{ asset('assets/cardback.jpg') }});background-repeat:no-repeat">

                            <div class="card-top py-3 px-4 text-center">

                                <h3 class="package-price">{{'$'.str_replace('.00', '', number_format($product->price, 2, '.', ','))}}</h3>
                                <h4>{{ucfirst($product->title)}}</h4>
                            </div>
                            <div class="card-body">
                                <ul class="float-start w-100">
                                    @foreach($product->features as $feature)
                                        <li class="text-start   mb-2"><i class="las la-check"
                                                                         style="font-size:14px;color:green"></i>&nbsp;{{ucfirst($feature->feature_title)}}
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="text-center">
                                    <a class="btn btn-primary " href="{{route('buy.now',$product->slug)}}"
                                       style="border-radius:13px">Buy Now</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="about">
        <div class="container">
            <h1 class="section-title text-white">What our client says about us?</h1>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim ipsa nemo
                            debitis dolorem nostrum nesciunt odit, iure sint sunt explicabo culpa amet eum ullam nam.
                            Eos corporis soluta voluptatibus libero!</p>
                        <p class="text-center author">Lorem Epsum , Kathmandu</p>

                    </div>
                    <div class="carousel-item">
                        <p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim ipsa nemo
                            debitis dolorem nostrum nesciunt odit, iure sint sunt explicabo culpa amet eum ullam nam.
                            Eos corporis soluta voluptatibus libero!</p>
                        <p class="text-center author">Lorem Epsum , Kathmandu</p>
                    </div>
                    <div class="carousel-item">
                        <p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim ipsa nemo
                            debitis dolorem nostrum nesciunt odit, iure sint sunt explicabo culpa amet eum ullam nam.
                            Eos corporis soluta voluptatibus libero!</p>
                        <p class="text-center author">Lorem Epsum , Kathmandu</p>
                    </div>
                </div>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="services">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title mb-3">
                        Checkout How We Provide You The Best Services!
                    </h2>
                    <p class="text-center mb-md-5 mt-md-4">Get Cheap Views Provides You The Best Services And Friendly
                        Interface Marketing.</p>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-6">
                    <div class="card text-start my-sm-3 my-xs-3 p-3" data-aos="fade-down">
                        <div class="row  ">
                            <div class="col-3 col-sm-3 col-md-3 p-3"><img style="width:100%"
                                                                          src="https://image.flaticon.com/icons/png/512/1495/1495118.png"
                                                                          alt=""></div>
                            <div class="col-9 col-sm-9 col-md-9 p-3">
                                <h4 class="service-card-title">Extremly Affordable</h4>
                                <p style="line-height:1.5rem">We provide quality fans at extremely affordable prices.
                                    Although we provide cheap rates to you .</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card text-start my-sm-3  my-xs-3 p-3" data-aos="fade-down">
                        <div class="row ">
                            <div class="col-3 col-sm-3 col-md-3 p-3"><img style="width:100%"
                                                                          src="https://lh3.googleusercontent.com/proxy/TW4EdQtQO4w-9Lm7lAocjpvR93_fR3qSpDADIxr6jZl4jPLPmpeFQrujcIt8_6XPpJ3ZPUtcG-uBYviXh_v81w-0WDsvpUUN_Ni6zWVT7WueRcNyYwI49FjgbA"
                                                                          alt=""></div>
                            <div class="col-9 col-sm-9 col-md-9 p-3">
                                <h4 class="service-card-title">Full Support Provide</h4>
                                <p style="line-height:1.5rem">We provide quality fans at extremely affordable prices.
                                    Although we provide cheap rates to you .</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card text-start my-sm-3  my-xs-3 p-3" data-aos="fade-down">
                        <div class="row  ">
                            <div class="col-3 col-sm-3 col-md-3 p-3"><img style="width:100%"
                                                                          src="https://findicons.com/files/icons/1994/vista_style_business_and_data/256/users.png"
                                                                          alt=""></div>
                            <div class="col-9 col-sm-9 col-md-9 p-3">
                                <h3 class="service-card-title">
                                    100% Real Users</h3>
                                <p style="line-height:1.5rem">We provide quality fans at extremely affordable prices.
                                    Although we provide cheap rates to you .</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card text-start my-sm-3  my-xs-3 p-3" data-aos="fade-down">
                        <div class="row">
                            <div class="col-3 col-sm-3 col-md-3 p-3"><img style="width:100%"
                                                                          src="https://www.baerpm.com/wp-content/uploads/2016/08/seo-icon-250.png"
                                                                          alt=""></div>
                            <div class="col-9 col-sm-9 col-md-9 p-3 ">
                                <h3 class="service-card-title">Perfect for SEO</h3>
                                <p style="line-height:1.5rem">We provide quality fans at extremely affordable prices.
                                    Although we provide cheap rates to you .</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection
