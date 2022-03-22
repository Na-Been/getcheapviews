@extends('users.dashboard.layouts.layout')
@section('title','Mass Order')
@section('content')
      <div class="massOrder pt-md-5">
      <div class="container">

      <div class="row">
      <div class="col-md-3 "  >
                     <div class="scene">
                        <div class="square y-axis p-5">   <h3 class="text-center text-white mb-3">Mass Order</h3>
                                                   <img width="100%" src="
                                               https://d2uars7xkdmztq.cloudfront.net/app_resources/5689/myAppIcon/img1672813182573601200.png" alt=""></div>
                     </div>
           </div>
           <div class="col-md-9">
              <form action="{{route('user.store.massorder')}}" method="POST" class="order-form">
            @csrf
        <div class="form-group mb-3">
        <label for="">One Order per line in format</label>
         <textarea type="text" rows="10" name="mass_order" class="form-control" placeholder="service_id | link | quantity"></textarea>
            @error('mass_order')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
           <div class="text-end">
              <button type="submit" class="btn btn-primary">Submit</button>
           </div>
        </form>
           </div>
      </div>
     
      </div>
    </div>
@endsection
