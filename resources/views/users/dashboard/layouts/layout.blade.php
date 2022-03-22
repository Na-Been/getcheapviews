<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">

    <!------ Include the above in your HEAD tag ---------->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('dist/css/dashboard.css')}}" rel="stylesheet">

    <title>@yield('title')</title>
    <style>
        header li{
            margin:5px
        }
        a{
            text-decoration:none;
        }
    </style>
</head>

<body>

<header class="">

        <div class="container">
            <h3 class=" mt-4 w-100 text-center" style="color:#000 !important" >
        <span>{{$setting->title ?? 'Company Name'}}</span></h3>
<br>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('user.neworder')?'active':''}}" aria-current="page"
                           href="{{route('user.neworder')}}">New Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('user.massorder')?'active':''}}"
                           href="{{route('user.massorder')}}">Mass Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->routeIs('user.services')?'active':''}}"
                           href="{{route('user.services')}}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->routeIs('user.orders')?'active':''}}"
                           href="{{route('user.orders')}}">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->routeIs('user.funds')?'active':''}}"
                           href="{{route('user.funds')}}">Add Funds</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->routeIs('user.faq')?'active':''}}"
                           href="{{route('user.faq')}}">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->routeIs('user.tickets')?'active':''}}"
                           href="{{route('user.tickets')}}">Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->routeIs('user.terms')?'active':''}}"
                           href="{{route('user.terms')}}">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->routeIs('user.news')?'active':''}}"
                           href="{{route('user.news')}}">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">{{'$'. auth()->user()->credits}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.account')}}">Account</a>
                    </li>
                       <li class="nav-item">
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="nav-link" >Logout</button>
                        </form>
                    </li>
                </ul>



        </div>


</header>

<div class="container mt-2">
        <hr>
    @include('users.message')
</div>
@yield('content')
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
<script src="{{asset('assets/js/tabs.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            language: {
                paginate: {
                    sNext: '<i class="fa fa-forward datatable-arrow"></i>',
                    sPrevious: '<i class="fa fa-backward datatable-arrow"></i>',
//    sFirst: '<i class="fa fa-step-backward"></i>',
//    sLast: '<i class="fa fa-step-forward"></i>'
                }
            }
        });
        $('.close').click(function () {
            $('#alert').hide();
        });
    });
     $('#tabWrap1').tabs();

</script>
@yield('script')
</html>

















