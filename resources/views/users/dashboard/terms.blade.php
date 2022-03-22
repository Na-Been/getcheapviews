@extends('users.dashboard.layouts.layout')
@section('title','Terms')
@section('content')
  
    <div class="container">
            <div class="termandcondition mt-5">
                <div class="row">
                    <div class="col-md-3" >
                     <div class="term-img m-auto" style="display:flex;justify-content:center">
                            <img width="" src="https://cdn.iconscout.com/icon/free/png-256/terms-condition-1795356-1522718.png" alt="">
                     </div>
                   
                
                </div>
                    <div class="col-md-9" style="position:relative">
                     
                 <div class="row">
                     <div class="col-md-2 pe-md-0" style="position:relative;display:flex;justify-content:center">           <div class="termleft">
                    <div class="termleft-shape">
                    </div>
                      <div class="termleft-shape2" >
                    </div>
                    </div></div>
                     <div class="col-md-10 ps-md-0">
                                <h3 class="term-title d-flex">
                     
                            <span class="">
                                Terms and Condition 
                            </span>
                        </h3>
                       

                     </div>
                 </div>
                 <br>
                 <br>
                        <ul>
                                @forelse($terms as $term)
                                <li>
                                    <div class="row" >
                                        <div class="col-2 pe-0"  style="display:flex;justify-content:center">
                                            <div class="term-no">
                                            <div> {{ucfirst($term->id)}}</div>
                                            </div>
                                        </div>  

                                        <div class="col-10 ps-0">
                                            <div class="term-content">
                                                <h6 class="mb-0">
                                                    
                                                
                                                {{ucfirst($term->condition_title)}}</h6>
                                                <p>
                                                    {!! ucfirst($term->condition_description) !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <div class="container">
                                    <div class="empty-terms">
                                    <h3 class="text-center">No Terms & Conditions Are Available!!! </h>
                                </div>
                                @endforelse
                            </ul>
                    </div>
                    
                </div>
                
            </div>
    </div>

@endsection
