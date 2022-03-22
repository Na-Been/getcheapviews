@extends('users.dashboard.layouts.layout')
@section('title','New Order')
@section('content')
    <div class="newOrder pt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 " style=" filter: drop-shadow(7px  2px 10px rgba(50, 50, 0, 0.2))">
                    <div class="scene">
                        <div class="square y-axis p-5"><h3 class="text-center text-white mb-3">New Order</h3>
                            <img src="https://digitalmarketplace-sapcpprd.s3.eu-central-1.amazonaws.com/9t3nn8wkihKfMvIs3GiDK9_EiGd1GgkKej01vQ_o8O15bA-01LE2j3F2TaIBE8na.png"
                                 alt=""></div>
                    </div>
                </div>
                <div class="col-md-9 ">
                    <form action="{{route('user.store.neworder')}}" method="POST" class="order-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <option selected disabled>Please Select One</option>
                                        @foreach($subCategories as $subCategory)
                                            <option
                                                value="{{$subCategory->id}}">{{$subCategory->sub_category_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Services</label>
                                    <select class="form-control services" name="services">
                                        <option selected disabled>Please select One</option>
                                    </select>
                                    @error('services')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Description</label>
                                    <textarea class="form-control description" name="" id="" cols="10"
                                              rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="">Link</label>
                                    <input type="text" class="form-control" name="link">
                                    @error('link')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" id="quantity">
                                    @error('quantity')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Charge</label>
                                    <input type="text" class="form-control charge" name="charge" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary ">Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('change', '#category', function () {
            let id = $(this).val();
            $('.services').empty();
            $.ajax({
                method: 'GET',
                url: '/users/find/category/' + id,
                dataType: 'json',
            }).done(function (data) {

                $.each(data, function (key, value) {
                    $('.services')
                        .append($("<option class='ajaxValue'></option>")
                            .attr("value", value.title + ',' + value.price)
                            .text(value.title))
                });
            });
        });

        $('#quantity').keyup(function () {
            let product = $('.services').val();
            let price = product.split(',');
            let quantity = $(this).val();
            let final = price[1] * quantity;
            $('.charge').attr("value", final);
        });
    </script>
@endsection
