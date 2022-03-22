
@if(session()->has('success'))
    <div class="alert alert-success" id="alert">
        <strong>{{session()->get('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif

@if(session()->has('failed'))
    <div class="alert alert-danger" id="alert">
        <strong>{{session()->get('failed')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
@endif
