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
            <h1>Contact</h1>
        </div>
    </div>
    <div class="contact-form">
        <div class="container">
            <div class="row">
                 <div class="col-md-6">
    <h4>Get In Touch</h4>
                                <p style="line-height:1.3em !important">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit fugit eum obcaecati iure impedit quas, aspernatur similique deleniti consequuntur voluptates delectus, a dignissimos ad debitis odit quisquam porro, quos corrupti.
                                </p>
                    <ul class="mt-5">
                        <li>
                            <i class="las la-map-marker"></i>
                            {{$setting->address ?? 'Company Address'}}
                        </li>
                        <br>
                        <li>
                            <i class="las la-phone" ></i>
                            {{$setting->contact ?? 'Copany Number'}}
                         
                        </li>
                        <br>
                        <li>
                               <i class="las la-envelope" ></i>
                                 {{$setting->email ?? 'Company Email'}}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6" style="position:relative">
                    <form action="{{route('contact.create')}}" method="POST" class="" style="box-shadow:0 0 10px rgba(0,0,0,0.1)" >
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Your Name</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Your Email Address</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Your Phone No.</label>
                            <input type="number" name="number" class="form-control">
                            @error('number')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Your Subject</label>
                            <input type="text" name="subject" class="form-control">
                            @error('subject')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Your Message</label>
                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1"
                                      rows="4"></textarea>
                            @error('message')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                      <div class="text-end">
                            <button class="btn btn-primary " type="submit">Send Your Message</button>
                      </div>
                    </form>


                </div>
               
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection
