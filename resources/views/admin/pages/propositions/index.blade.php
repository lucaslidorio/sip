@extends('adminlte::page')
@section('title', 'Propositura')
@section('content_header')
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Proposituras</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Proposituras</li>
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
            
            <a href="{{route('propositions.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Publicar nova ata" ><i
                class="fas fa-plus"></i> Novo</a>
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              {{-- <form action="{{route('propositions.search')}}" method="post" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Descrição">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form> --}}
            </div>
          </div>
        </div>
      </div>    
   
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tipo</th>
              <th scope="col">Número</th>  
              <th scope="col">Data</th>            
              <th scope="col">Situação</th>
              <th scope="col">Autor(s)</th>
              <th scope="col">Descrição</th>               
              <th scope="col">Arquivo</th>
              <th scope="col" width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($propositions as $proposition)               
           
            <tr >
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$proposition->type_proposition->nome}}</td>
              <td>{{$proposition->numero}}</td> 
              <td>{{\Carbon\Carbon::parse($proposition->data)->format('d/m/Y')}}</td>               
              <td>{{$proposition->situation->nome}}</td>              
              <td> 
                @foreach ($councilors as $councilor)
                
                    @isset($proposition)
                      @foreach ($proposition->author as $author)
                      {{$councilor->id == $author->id ? $councilor->nome : ''}}
                        @if ($councilor->id == $author->id)
                          <br>
                        @endif
                      @endforeach                      
                    @endisset
                  
                @endforeach
                
              </td>  
              <td>               
                 <button type="button" class="btn btn-outline-info popover-dismiss" 
                  data-container="body" data-toggle="popover" data-placement="top" 
                  data-content="{{$proposition->descricao}}">
                    Ver
                 </button> 
              </td>            
              <td>                
                  @foreach ($proposition->attachments as $attachment)                   
                  <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" 
                    target="_blank" class="mb-2 text-reset"
                    data-toggle="tooltip" data-placement="top" 
                        title={{$attachment->nome_original}} >
                      <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                  </a>                             
                  @endforeach                 
              </td> 

                <td class="text-center">
                <a href="{{route('propositions.edit', $proposition->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>

                {{-- <a href="{{route('propositions.show', $proposition->id)}}" data-id="{{$proposition->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Ver Detalhes">
                  <i class="fas fa-address-book" ></i>
                </a> --}}

                <a href="{{route('propositions.destroy', $proposition->id)}}" data-id="{{$proposition->id}}"
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
        {!!$propositions->appends($pesquisar)->links()!!}
        @else
        {!!$propositions->links()!!}
        @endif
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop
@section('js')
<script>
  //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()

        $('.popover-dismiss').popover({
            trigger: 'focus'
        })
    })  //Alert de confirmação de exclusão
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
@stop