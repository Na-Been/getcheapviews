@extends('layouts.app')
@section('title','Login')
<link rel="stylesheet" href="{{asset('dist/css/style.css')}}">
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
            <h1>Log In</h1>
        </div>
    </div>

    <div class="wrapper fadeInDown p-0">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first my-5">
                <i class="fas fa-users" style="font-size: 70px"></i>
            </div>

            <!-- Login Form -->
            <form action="{{route('login')}}" method="POST" class="pb-5">
                @csrf
                <input type="text" id="login" class="fadeIn second" name="email" placeholder="Login">
                @error('email')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
                <br>
                <br>
                <input type="submit" class="fadeIn fourth" value="Log In">
                <br>
                 <a class="underlineHover" href="#">Forgot Password?</a>
                 <br>
                 <br>
                <p style="font-size:14px ">
                By Signing up, you agree to getcheapview <a href="" style="text-decoration :none">Terms and Condition & Privacy Policy</a></p>
            </form>

          

        </div>
    </div>
@endsection
