@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')

@include('sweetalert::alert')


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Categorias</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Categorias</li>
      </ol>
    </div>
  </div>
</div>
<!--Alerta -->

@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8">
            
            <a href="{{route('categorias.create')}}" class="btn bg-gradient-primary  " data-toggle="tooltip" data-placement="top"
            title="Cadastrar nova categoria" ><i
                class="fas fa-plus"></i> Novo</a>
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('categorias.search')}}" method="post" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Descrição">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div> 

      </div>
     
   
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>URL</th>
              <th>Descrição</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categorias as $categoria)
      
            <tr >
              <td>{{$categoria->id}}</td>
              <td>{{$categoria->nome}}</td>
              <td>{{$categoria->url}}</td>
              <td>{{$categoria->descricao}}</td>
              <td>
                <a href="{{route('categorias.edit', $categoria->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>

                <a href="{{route('categorias.destroy', $categoria->id)}}" data-id="{{$categoria->id}}"
                  class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Excluir">
                  <i class="fas fa-trash-alt" ></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        @if (isset($pesquisar))
        {!!$categorias->appends($pesquisar)->links()!!}
        @else
        {!!$categorias->links()!!}
        @endif
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop


@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })  
    //Alert de confirmação de exclusão
    $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Deseja continuar',
        text: 'Este registro e seus detalhes serão excluídos permanentemente!',
        icon: 'warning',
        buttons: ["Cancelar", "Excluir!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});








  /*
    $('.excluir').on('click', function () {
        // return confirm('Are you sure want to delete?');
        event.preventDefault();//this will hold the url
        swal({
            title: "Are you sure?",
            text: "Once clicked, this will be softdeleted!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Done! category has been softdeleted!", {
                    icon: "success",
                    button: true,
                });
            location.reload(true);//this will release the event
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    });
*/
</script>


@stop