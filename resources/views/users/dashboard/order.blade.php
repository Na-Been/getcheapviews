@extends('users.dashboard.layouts.layout')
@section('title','Order')
@section('content')
    <div class="services pt-5">
        <div class="container">
            <ul class="order-header">
                <li class="order-item order-active orderStatus">
                    <a href="{{route('user.orders')}}">
                        All
                    </a>
                </li>
                <li class="order-item orderStatus" value="1">
                    <a href="#">
                        Pending
                    </a>
                </li>

                <li class="order-item orderStatus" value="2">
                    <a href="#">In Progress
                    </a>
                </li>

                <li class="order-item orderStatus" value="3"><a href="#">Completed
                    </a></li>

                <li class="order-item orderStatus" value="4"><a href="#">Partial
                    </a></li>

                <li class="order-item orderStatus" value="5"><a href="#">Processing
                    </a></li>

                <li class="order-item orderStatus" value="6"><a href="#">Canceled
                    </a></li>
            </ul>

            <div class="card" id="allOrder">
                <table id="example" style="width:100% ;padding-top:20px">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Link</th>
                        <th>Charge</th>
                        <th>Start Count</th>
                        <th>Quantity</th>
                        <th>Service</th>
                        <th>Remains</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    @foreach($orders as $order)
                        <tr class="tableData">
                            <td colspan="">{{$loop->iteration}}</td>
                            <td colspan="">{{$order->created_at->format('Y-m-d')}}</td>
                            <td>{{$order->link}}</td>
                            <td>{{$order->charge}}</td>
                            <td>100</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->services}}</td>
                            <td>100</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
            $(document).on('click','.orderStatus',function () {
                $('.tableData').remove();
                $(this).addClass('order-active');
                $('.orderStatus').not($(this)).removeClass('order-active');
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    dataType: 'json',
                    url: 'status/order/' + id,
                }).done(function (data) {
                    $.each(data, function (key, value) {
                        $('#tableBody').append('<tr class="tableData"> <td>' + value.id + '</td>' +
                            '  <td>' + value.created_at + '</td> <td>' + value.link + '</td>' +
                            ' <td>' + value.charge + '</td> <td>' + 100 + '</td>  <td>' + value.quantity + '</td> ' +
                            '<td>' + value.services + '</td><td>' + 100 + '</td></tr>');
                    });
                });
            });
    </script>
@endsection
