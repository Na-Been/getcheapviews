@extends('users.dashboard.layouts.layout')
@section('title','Services')
@section('content')
    <div class="services">
        <div class="container">

            <div class="card" style="    padding: 20px;
    background: #fff;
    border: none;
    box-shadow: 0 0 10px rgb(0 0 0 / 10%);">
                <table style="width:100%" id="example">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service</th>
                        <th>Rate Per 1000</th>
                        <th>Min Order</th>
                        <th>Max Order</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td>{{ucfirst($service->sub_category_name)}}</td>
                            <td>{{'$'.$service->rate_per_thousand}}</td>
                            <td>{{$service->min_order}}</td>
                            <td>{{$service->max_order}}</td>
                            <td>{!! ucfirst($service->sub_category_description) !!}</td>
                        </tr>
                    @empty
                        <td>No Services Available!!!</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
