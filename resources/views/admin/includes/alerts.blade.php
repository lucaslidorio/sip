@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Atenção!</h5>
    @foreach ($errors->all() as $error)
            <p>{{$error}}</p>    
    @endforeach
  </div>
       
@endif


