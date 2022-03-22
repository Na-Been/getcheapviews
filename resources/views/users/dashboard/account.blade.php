@extends('users.dashboard.layouts.layout')
@section('title','Account')
@section('content')
    <div class="account pt-md-5">
        <div class="container">
                <div class="row">
                    <div class="col-md-3" >
                     <div class="scene">
                        <div class="square y-axis  p-5" style="      display: flex;
    align-items: center;
    justify-content: center;">   
                            <div class="demo-wrap">
                            <ul class="tabs" id="tabWrap1">
                                <li rel="#tab1">View Profile</li>
                                <li rel="#tab1">Change Profile</li>
                                <li rel="#tab2">Change Password</li>
                            
                            </ul>
  
                    </div>
                    </div>
                     </div>
                    </div>
                    <div class="col-md-9">
                        <form id="tab1" action="{{route('user.update')}}" method="POST" class="order-form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Full Name</label>
                                            <input type="text" class="form-control charge" name="name" value="{{$user->name}}">
                                            @error('name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control charge" name="email" value="{{$user->email}}">
                                            @error('email')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    
                                        <div class="text-end">
                                                <button type="submit" class="btn btn-primary mt-3" >Update</button>
                                        </div>
                                    
                                    </form>
                                        <form id="tab2" class="order-form" method="POST" action="{{route('change.password')}}">
                            @csrf
                            <div class="form-group">
                                <label for="">Current Password</label>
                                <input type="password" class="form-control charge" name="current_password">
                                @error('current_password')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="password" class="form-control charge" name="new_password">
                                @error('new_password')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password">
                                @error('confirm_password')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary  mt-3" >Change Password
                                </button>
                            </div>
           
                         <p class="text-center pt-3" style="font-size:14px"><i>Changing the login password frequently prevents unauthorize users from modifying configuration</i></p>
                        </form>
           
                    </div>
                </div>
          
           
           
        </div>
    </div>

@endsection
