@extends('admin.sidebar.sidebar')
@section('title','Dashboard')
@section('pageName','Dashboard')
@section('sidebar')
    @parent
@stop
@section('content')
    <!-- BEGIN: Content -->
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                    <a href="{{route('admin.index')}}" class="ml-auto flex text-theme-1 dark:text-theme-10"> <i
                            data-feather="refresh-ccw"
                            class="w-4 h-4 mr-3"></i>
                        Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{$totalSales}}</div>
                                <div class="text-base text-gray-600 mt-1">Item Sales</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{route('all.orders')}}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                    </div>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{$newOrders}}</div>
                                    <div class="text-base text-gray-600 mt-1">New Orders</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{route('product.index')}}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                    </div>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{$products}}</div>
                                    <div class="text-base text-gray-600 mt-1">Total Products</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <a href="{{route('display.users')}}">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                    </div>
                                    <div class="text-3xl font-bold leading-8 mt-6">{{$users}}</div>
                                    <div class="text-base text-gray-600 mt-1">Registered Users</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->


            <!-- BEGIN: Weekly Top Products -->
            <div class="col-span-12 mt-6">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Latest Orders
                    </h2>
                </div>
                <table class="table table-report sm:mt-2">
                    <thead>
                    <tr>
                        <th class="whitespace-no-wrap">S.N.</th>
                        <th class="whitespace-no-wrap">SERVICE NAME</th>
                        <th class="whitespace-no-wrap">QUANTITY</th>
                        <th class="text-center whitespace-no-wrap">CHARGE</th>
                        <th class="text-center whitespace-no-wrap">STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="intro-x">
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <a href="" class="font-medium whitespace-no-wrap">{{$order->services}}</a>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{$order->user->email}}</div>
                            </td>
                            <td class="text-center">{{$order->quantity}}</td>
                            <td class="text-center">{{$order->charge}}</td>
                            <td class="w-40">
                                @if($order->status == 1)
                                    <div class="flex items-center justify-center text-theme-1"><i
                                            data-feather="pause-circle" class="w-4 h-4 mr-2"></i> <strong>Pending</strong>
                                    </div>
                                @elseif($order->status == 2)
                                    <div class="flex items-center justify-center text-theme-12"><i
                                            data-feather="activity" class="w-4 h-4 mr-2"></i> <strong>In Progress</strong>
                                    </div>
                                @elseif($order->status == 3)
                                    <div class="flex items-center justify-center text-theme-9"><i
                                            data-feather="check-square" class="w-4 h-4 mr-2"></i> <strong>Completed</strong>
                                    </div>
                                @elseif($order->status == 4)
                                    <div class="flex items-center justify-center text-theme-11"><i
                                            data-feather="bar-chart-2" class="w-4 h-4 mr-2"></i><strong>Partial</strong>
                                    </div>
                                @elseif($order->status == 5)
                                    <div class="flex items-center justify-center text-theme-13"><i
                                            data-feather="cpu" class="w-4 h-4 mr-2"></i> <strong>Processing</strong>
                                    </div>
                                @elseif($order->status == 6)
                                    <div class="flex items-center justify-center text-theme-6"><i
                                            data-feather="x-circle" class="w-4 h-4 mr-2"></i> <strong>Cancelled</strong>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center text-theme-1"><i
                                            data-feather="alert-circle" class="w-4 h-4 mr-2"></i><strong>No Status Yet</strong>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END: Weekly Top Products -->
        </div>
    </div>
    <!-- END: Content -->
@endsection
