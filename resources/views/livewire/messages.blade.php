<div>
    @if(session()->has('msg'))
        <div class="alert alert-{{session('msg')['type']}} alert-dismissible fade show" role="alert">
            <strong>Mensaje: </strong> {{session('msg')['msg']}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>