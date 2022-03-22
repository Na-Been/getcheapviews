@extends('users.dashboard.layouts.layout')
@section('title','FAQ')
@section('content')
    <div class="faq-content pt-md-5">
        <div class="container">

        <div class="row">
              <div class="row">
               <div class="col-md-3 "  >
                     <div class="scene">
                        <div class="square y-axis  p-5">   <h3 class="text-center text-white mb-3">FAQ</h3>
                                                   <img width="100%" src="
                                        https://lh3.googleusercontent.com/proxy/C6VPYEcyX7fWOrojQfpTHa4c2T8qipAkl4cEd84jT94uDimp8XpoBUsVsW6HVQyCiiVwhYLteyEg6-R0h5ynIQqOn3k6APP8TvVbeMtDmQ " alt=""></div>
                     </div>
           </div>
           <div class="col-md-9">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                            @forelse($questions as $question)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                aria-controls="flush-collapseOne">
                                            {{ucfirst($question->question)}}
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne"
                                        data-bs-parent="#accordionFlushExample">
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
           
        </div>
    </div>
@endsection


