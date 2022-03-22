<!DOCTYPE html>
@if(modeSelector() == 0)
    <html lang="en" class="light">
    @else
        <html lang="en" class="dark">
        @endif
        <head>
            <meta charset="utf-8">
            @if($setting)
                @if($setting->logo != null)
                    <link href="{{url('/').Storage::url($setting->logo)}}" rel="shortcut icon">
                @else
                    <link rel="icon" href="{{asset('assets/image_placeholder.webp')}}">
                @endif
            @endif
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description"
                  content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
            <meta name="keywords"
                  content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
            <meta name="author" content="LEFT4CODE">
            <title>@yield('title')</title>
            <!-- BEGIN: CSS Assets-->
            <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}"/>
            <!-- END: CSS Assets-->
        </head>
        <body>
        @yield('content')

        <!-- BEGIN: Dark Mode Switcher-->
        <div data-url="{{route('update.dark.mode')}}"
             class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
            <div class="dark-mode-switcher__toggle border"></div>
        </div>
        <!-- END: Dark Mode Switcher-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
        </body>
        <script>
            $(document).ready(function () {
                $(".close").click(function () {
                    $("#notifyUser").hide();
                });
            });
        </script>
        </html>
