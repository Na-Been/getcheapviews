@extends('users.dashboard.layouts.layout')
@section('title','News')
@section('content')
  <div class="container">
        @forelse($blogs as $blog)
 <div class="card">
       <div class="row">
        <div class="col-md-3"><img style=" width: 100%" src="{{asset(url('/').Storage::url($blog->image))}}" > </div>
       <div class="col-md-9 p-md-4">
              
        <h3>{{$blog->title}}</h3>
       
        <h6>{{$blog->added_by}}</h6>
        <p>{!! $blog->description !!}</p>

    
       </div>
   </div>
 </div>
 <br>
        @empty
        <h1>There Are No News Available For Now!!!</h1>
       @endforelse
  </div>
@endsection
