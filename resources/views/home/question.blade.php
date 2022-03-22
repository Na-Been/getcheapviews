@extends('layouts.app')
@section('title','F&Q')
@section('navbar')
    @parent
@stop
@section('content')
    <div class="contact ">
        @if($slider != null)
            <div class="banner-image"
                 style="background-image: url({{asset(url('/').Storage::url($slider->image))}})">
            </div>
        @else
            <div class="banner-image"
                 style="background-image: url({{asset('assets/bannerimage.png')}})">
            </div>
        @endif
        <div class="page-title">
            <h1>FAQ</h1>
        </div>
    </div>

    <div class="faq-content">
        <div class="container">
        
                <div class="accordion" id="accordionExample">
                      @forelse($questions as $question)
  <div class="accordion-item">
    <h2 class="accordion-header" id="heading{{$question->id}}">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$question->id}}" aria-expanded="false" aria-controls="collapse{{$question->id}}">
           {{ucfirst($question->question)}}
      </button>
    </h2>
    <div id="collapse{{$question->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$question->id}}" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="accordion-content">
                                    <p>
                                        {!! ucfirst($question->answer) !!}
                                    </p>
                                </div>
      </div>
    </div>
  </div>
    @empty
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                No Question And Answer Available!!!
                            </h2>
                        </div>
                    @endforelse
</div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
