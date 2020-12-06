
         @if(Session::has('message'))
         <div class="alert alert-{{session('alert-type')}} alert-success fade show text-center"  id="alert-message"  role="alert">
            <strong> {{Session::get('message')}}</strong>   
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif

@if (session('resent'))
<div class="alert alert-success  alert-success fade show text-center"  id="alert-message"  role="alert">
    {{ __('A fresh verification link has been sent to your email address.') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif



@if (session('status'))
<div class="alert alert-success  alert-success fade show text-center"  id="alert-message"  role="alert">
        {{Session::get('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif
