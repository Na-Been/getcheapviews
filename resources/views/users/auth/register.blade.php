@extends('layouts.app')
@section('title','Register')
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
            <h1>Registration</h1>
        </div>
    </div>

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <i class="fas fa-users" style="font-size: 70px"></i>
            </div>
            <!-- Login Form -->
            <form action="{{route('register')}}" method="POST">
                @csrf
                <input type="text" id="name" class="fadeIn third" name="name" placeholder="Full Name" value="{{old('name')}}">
                @error('name')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <input type="text" id="login" class="fadeIn second" name="email" placeholder="Email" value="{{old('email')}}">
                @error('email')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                @error('password')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <input type="password" id="password" class="fadeIn third" name="password_confirmation" placeholder="confirm password">
                <input type="submit" class="fadeIn fourth" value="Register">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>
@endsection
