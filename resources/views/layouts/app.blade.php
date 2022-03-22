<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$setting->title ?? ' '}} | @yield('title')</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
          <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Antic+Didone&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" type="text/css" media="screen"/>

    @if($setting)
        @if($setting->logo != null)
            <link rel="icon" href="{{url('/').Storage::url($setting->logo)}}">
        @else
            <link rel="icon" href="{{asset('assets/image_placeholder.webp')}}">
        @endif
    @endif
</head>

<body>
@section('navbar')
    <header id="header">
        @include('users.message')
        <div class="container-fluid ">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid ">
                    <a class="navbar-brand text-white" href="{{url('/')}}">FindCheapView</a>
                    <button class="navbar-toggler ms-auto" data-bs-toggle="collapse" data-bs-target="#navbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                            <li class="nav-item ">
                                <a class="nav-link active " aria-current="page " href="{{url('/')}}">Home</a>
                            </li>

                            @forelse($categories as $category)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ucfirst($category->category_name)}}
                                    </a>
                                    <ul class="dropdown-menu py-3" aria-labelledby="navbarDropdown">
                                        @foreach($category->subCategory as $subCategory)
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{route('subcategory.page',['category'=>$category->slug, 'subcategory'=>$subCategory->slug])}}">
                                                    {{$subCategory->sub_category_name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @empty
                            @endforelse


                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('home.question')}}">FAQ</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " href="{{route('contact.index')}}">Contact</a>
                            </li>
                            @auth
                                <li class="nav-item " style="display: flex; align-items: center; ">
                                    @if(auth()->user()->status == 0)
                                    <a class="  navbar-btn nav-link py-1"
                                       href="{{ route('user.neworder') }}">Dashboard</a>
                                    @else
                                        <a class=" " style=""
                                           href="{{ route('admin.index') }}">Dashboard</a>
                                    @endif
                                </li>
                            @endauth
                            @guest
                                <li class="nav-item " style="display: flex; align-items: center; ">
                                    <a class=" navbar-btn nav-link py-1"
                                       href="{{ route('login') }}">Login</a>
                                </li> &nbsp;
                                <li class="nav-item " style="display: flex; align-items: center;">
                                    <a class=" navbar-btn nav-link py-1"
                                       href="{{ route('user.register') }}">Signup</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
@show

@yield('content')

</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
<script type="text/javascript " src="{{ asset('assets/js/jquery.min.js') }} " charset="utf-8 "></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


<script>
    $(window).scroll(function () {
        if ($(window).scrollTop()) {
            $('header').addClass('header-white');
        } else {
            $('header').removeClass('header-white');
        }
    })
</script>

<script>
    AOS.init({
        duration: 1200,
    });
</script>
</html>
