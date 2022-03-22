@extends('users.dashboard.layouts.layout')
@section('title','Add Funds')
@section('content')
    <div class="massOrder pt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="scene">
                        <div class="square y-axis  p-5"><h3 class="text-center text-white ">Add Funds</h3>
                            <img width="50%" src="
                                            https://image.flaticon.com/icons/png/512/216/216467.png  " alt=""></div>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="{{route('user.store.funds')}}" method="POST" class="order-form">
                        <input type="hidden" id="res_token">
                        <div class="form-group">
                            <label for="">Method</label>
                            <select class="form-control method" name="method">
                                <option value="stripe">Stripe</option>
                                <option value="paypal">Paypal</option>
                            </select>
                            @error('method')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Amount</label>
                            <select class="form-control amount" name="amount">
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                                <option value="750">750</option>
                                <option value="1000">1000</option>
                                <option value="2000">2000</option>
                            </select>
                            @error('amount')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <a class="btn btn-primary addFund">Pay</a>
                        </div>

                        <p class="pt-5 text-center"><i>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</i></p>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        $(document).on('click', '.addFund', function () {
            var amount = $('.amount').val();
            var method = $('.method').val();
            if (method === "stripe") {
                var handler = StripeCheckout.configure({
                    key: '{{env('STRIPE_TEST_KEY')}}', // your publisher key id
                    locale: 'auto',
                    token: function (token) {
                        $('#res_token').html(JSON.stringify(token));
                        $.ajax({
                            url: $('.order-form').attr('action'),
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                tokenId: token.id,
                                amount: amount,
                                method: method
                            },
                            success: () => {
                                window.location.reload();
                            },
                            error: () => {
                                alert('Oops! Something went wrong')
                            }
                        })
                    }
                });
                handler.open({
                    name: 'Get Cheap Views Payment',
                    description: 'NiceSnippets',
                    amount: amount * 100,
                    currency: 'AUD'
                });
            }
            else {
                $.ajax({
                    url: 'handle/payment',
                    method: 'get',
                    data: {
                        _token: '{{csrf_token()}}',
                        amount: amount,
                        method: method
                    },
                    success: (data) => {
                        console.log(data);
                        // window.location.reload();
                    },
                    error: () => {
                        alert('Oops! Something went wrong')
                    }
                })
            }
        });
    </script>
@endsection
