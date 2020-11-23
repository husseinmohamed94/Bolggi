
         @if(Session::has('message'))
         <div class="alert alert-{{session('alert-type')}} alert-success fade show text-center"  id="alert-message"  role="alert">
            <strong> {{Session::get('message')}}</strong>   
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif

