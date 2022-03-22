@extends('users.dashboard.layouts.layout')
@section('title','Ticket')
@section('content')
    <div class="massOrder pt-md-5">
        <div class="container">
            <div class="row">
                   <div class="col-md-3 "  >
                     <div class="scene">
                        <div class="square y-axis  p-5">   <h3 class="text-center text-white ">Tickets</h3>
                                                   <img width="100%" src="
                                           https://cdn0.iconfinder.com/data/icons/miscellaneousness-long-shadow-flat/33/ticket-512.png " alt=""></div>
                     </div>
           </div>
           <div class="col-md-9">
  <form action="{{route('user.store.ticket')}}" method="POST" class="order-form">
                @csrf
                <div class="form-group">
                    <label for="">Subject</label>
                    <input type="text" name="subject" class="form-control">
                    @error('subject')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Message</label>
                    <textarea type="text" rows="8" class="form-control" name="message"
                              placeholder="Your Message"></textarea>
                    @error('message')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
             <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit ticket</button>
             </div>
            </form>
           </div>
            </div>
          
        </div>
    </div>
@endsection
