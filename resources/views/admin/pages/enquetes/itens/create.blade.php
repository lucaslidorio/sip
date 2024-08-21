@extends('adminlte::page')

@section('title', 'Cadastrar nova Enquete')

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Cadastrar novo intem para a enquete <strong>{{$enquete->nome}}</strong> </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('enquetes.index')}}">Enquetes </a></li>
        <li class="breadcrumb-item ">Nova Enquete</li>
      </ol>
    </div>
  </div>
</div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{route('enquetes.storeItem')}}" method="POST">
      @csrf
      @include('admin.pages.enquetes.itens.form')
    </form>

    <div class="row">
      <h4>Itens Cadastrados</h4>
      <table class="table table-sm  table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Item</th>
            <th scope="col">Votos</th>
            <th width="20%" class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($enquete->itens as $item)
          <tr>
            <th scope="row">{{1}}</th>
            <td>{{$item->nome}}</td>
            <td>{{$item->votos}}</td>
            <td class="text-center">
              @can('editar-enquete')
              <a href="{{route('enquetes.editItem', $item->id)}}" class="btn  bg-gradient-primary btn-flat  "
                data-toggle="tooltip" data-placement="top" title="Editar">
                <i class="fas fa-edit"></i>
              </a>
              @endcan
              @can('excluir-enquete')
              <a href="{{route('enquetes.destroyItem', $item->id)}}" data-id="{{$item->id}}"
                class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"
                title="Excluir">
                <i class="fas fa-trash-alt"></i>
              </a>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>

@stop
@section('js')
<script>
  $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  //Swal.fire('Any fool can use a computer');  
    //Inicia os tooltip
  $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })  
    //Alert de confirmação de exclusão
    $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');    
          Swal.fire({
          title: 'Deseja continuar?',
          text: "Este registro e seus detalhes serão excluídos permanentemente!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText:'Cancelar',
          confirmButtonText: 'Sim, Exclua!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        })  
});
</script>
@endsection